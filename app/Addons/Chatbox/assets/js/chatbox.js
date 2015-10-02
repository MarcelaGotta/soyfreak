
window.chatChecking = false;
var chatbox = {
    //Total possible boxes
    tBoxes : 3,

    //boxes
    boxes : [],

    //chatboxes container
    container : '',

    //cached emoticons
    emoticons : '',

    checking : false,

    //messagesIds
    messageIds : ['0'],

    checkAjax : '',

    lastAccess : '',

    oldTitle : '',

    init : function() {
        w = $(document).width();
        if (w > 500 && w < 800) {
            this.tBoxes = 1;
        } else if(w < 500) {
            this.tBoxes = 0;

        }
        this.oldTitle = document.title;
    },

    keepChecking : function() {
        clearInterval(window.chatChecking);
                ids = [];
                boxes = [];
                for(i=0;i < chatbox.boxes.length; i++){
                    var userid = chatbox.boxes[i];
                    boxes.push(userid);
                    var hisChatbox = $('#chatbox-' + userid);
                    var lastcheck = (hisChatbox.data('lastcheck') == undefined) ? 0 : hisChatbox.data('lastcheck');
                    var hisBoxTitle = hisChatbox.find('.head').find('.name');

                    ids[i] = [userid, lastcheck];
                }
                
                this.checkAjax = $.ajax({
                    url : baseUrl + 'chatbox/check',
                    type : 'POST',
                    data : {ids : ids, messageIds : chatbox.messageIds, lastaccess: this.lastAccess, boxes : boxes},
                    success : function(data) {
                        chatbox.checking = false;
                        var data = jQuery.parseJSON(data);

                        if (data.error != undefined) return false;

                        var needAlert = false;
                        var from = '';
                        chatbox.lastAccess = data.lastaccess;
                        if (data.message != undefined) {
                            $.each(data.message, function(i, e) {
                                var userid = e.userid;
                                var lastcheck = e.lastcheck;
                                var messages = e.messages;

                                var status = e.status;
                                var hisChatbox = $("#chatbox-" + userid);
                                var messagesContainer = hisChatbox.find('.chatbox-messages');
                                var boxTitle = hisChatbox.find('.head').find('.name');
                                from = boxTitle.data('name');
                                hisChatbox.data('lastcheck', lastcheck);
                                messagesContainer.append(messages);
                                if (messages != '') {
                                    needAlert = true;
                                    reloadPlugins();
                                    chatbox.scrollDown(messagesContainer);
                                }
                            });

                        }

                        //add all message Ids
                        $.each(data.messageIds, function(i, e) {
                           chatbox.messageIds.push(e);
                        });

                        if (data.typing != undefined) {

                            $.each(data.typing, function(i, e) {
                                var tUserid  = e.userid;
                                var tStatus = e.status;

                                var tHisChatbox = $("#chatbox-" + tUserid);
                                var tBoxTitle = tHisChatbox.find('.head').find('.name');

                                if (!tBoxTitle.find('span').length) {
                                    if (tStatus == 1) {
                                        tBoxTitle.append('<span> typing...</span>');
                                    } else {
                                        tBoxTitle.find('span').remove();
                                    }
                                } else {
                                    if (tStatus == 0) tBoxTitle.find('span').remove();
                                }

                            });

                        }

                        //set the onlines datas
                        $('.chat-list').html(data.onlinescontent);
                        $('.friends-online-count').html(data.onlinecount);

                        $.each(data.boxesstatus, function(i, e) {
                            var oUserid  = e.userid;
                            var oStatus = e.status;
                            var oStatusText = e.statustext;

                            var oHisChatbox = $("#chatbox-" + oUserid);
                            var oBoxTitle = oHisChatbox.find('.head').find('.name');
                            var oHisSubHead = oHisChatbox.find('.sub-head');
                            oHisSubHead.find('.online-status').html(oStatusText);
                            if (oStatus == 0) {
                                oBoxTitle.find('i').hide();
                            } else {
                                var theI = oBoxTitle.find('i');
                                if (oStatus == 1) {
                                    theI.css('color', '#26C281')
                                } else {
                                    theI.css('color', '#E38826')
                                }
                                theI.show();
                            }

                        });

                        $.each(data.newboxes, function(i, e) {
                            var nName = e.name;
                            var nUserid = e.userid;
                            var nLink = e.link;

                                if (chatbox.boxes.length < chatbox.tBoxes) {
                                    needAlert = true;
                                    c = chatbox.create(nUserid, nName, nLink);
                                    f =  c.find('.head').find('.name').data('name');
                                    if (f != undefined) from = f;
                                }
                        });

                        chatbox._updateUnreadCount(data.unreadcount);


                        //on every check we make sure our chat online lists is update
                        if (!document.hasFocus() && needAlert) {

                            document.getElementById('update-sound').play();

                            if (from) chatbox.toogleTitle(from);
                        }


                        window.chatChecking = setInterval(function() {
                            chatbox.keepChecking();
                        }, chatSpeed);
                    },

                    complete : function() {
                        //chatbox.keepChecking();
                    },
                    error : function() {
                        chatbox.keepChecking();
                    }

                })


    },

    _updateUnreadCount : function(count) {
        var mT = $('#new-messages-trigger');
        var cmT = $('.new-messages-trigger');

            if(count != 0) {
                if (!mT.find('span').length) {
                    cmT.append('<span></span>');
                }
                var mTSpan = mT.find('span');
                if (mTSpan.html() != '') {
                    if (mTSpan.html() != count) {
                        needAlert = true;
                    }
                } else {
                    needAlert = true;
                }

                cmT.find('span').html(count).show()
            } else {
                cmT.find('span').html('').hide();
            }

    },

    //refresh chat list
    refreshChatList : function() {
        var container = $('.chat-list');
        $.ajax({
            url : baseUrl + 'messages/online',
            success : function(data) {
                container.html(data);
            }
        });
    },

    updateUnread : function() {
        $.ajax({
            url : baseUrl + 'chatbox/unread/count',
            success : function(data) {
                chatbox._updateUnreadCount(data);
            }
        });
    },

    canCreate : function() {
        if (this.tBoxes > 0) return true;

        return false;
    },

    create : function(id, name, link, donotForce, makeSound) {

        if (jQuery.inArray(id, this.boxes) != -1) {
            //this.show(id);
            //alert('this is twalo');
        } else {

            if (this.boxes.length < this.tBoxes) {
                this.boxes.push(id);

                if (makeSound != undefined) document.getElementById('update-sound').play();
                return this.__create(id, name, link);
            } else {
                if (donotForce != undefined) return true;
                var lastIndex = this.boxes[this.boxes.length - 1];

                if (lastIndex != id) {



                    this.destroy($('#chatbox-' + lastIndex),lastIndex);
                    this.boxes.push(id);
                    return this.__create(id, name, link);
                }
            }


        }
    },

    scrollDown : function(o) {
        //alert(o.prop('scrollHeight'));
        o.animate({ scrollTop: o.prop('scrollHeight')}, 1000);
    },


    toogleTitle : function(from) {

        var newTitle = "New Message from " + from;

        var intevalChangeTitle = setInterval(function() {

            if (document.hasFocus()) {
                document.title = chatbox.oldTitle;
                clearInterval(intevalChangeTitle);
                return false;
            }
            if (document.title == chatbox.oldTitle) {
                document.title = newTitle;
            } else {
                document.title = chatbox.oldTitle;
            }
        }, 1000);
    },

    updateOpenedBoxes: function() {
        $.ajax({
            url : baseUrl + 'chatbox/update/opened',
            data : {boxes : this.boxes}
        })
    },

    __create : function(id, name, link) {

        //update this user opend boxes
        this.updateOpenedBoxes();
        var uniqueId = 'chatbox-' + this.boxes.length;

        var c = $("<div class='chatbox "+uniqueId+"' id='chatbox-"+id+"'></div>");
        c.append("<div class='head'><a data-name='"+name+"' class='name' data-ajaxify='true' href='"+link+"'><i class='icon ion-record' style='color: #26C281;font-size: 11px'></i> "+name+" </a> <span class='pull-right'><a class='minimize' href=''><i class='icon ion-minus'></i></a> <a class='delete' href=''><i class='icon ion-close'></i></a></span></div> ");
        var subHead = $("<div class='sub-head'><span class='online-status'></span></div> ")
        subHead.append("<div class='chatbox-setting dropdown'><a data-ajaxify='true'  href='"+link+"'><i class='icon ion-android-social-user'></i></a>\n" +
            " </div> ");
        c.append(subHead);
        c.append("<div class='chatbox-messages clearfix'></div>");
        var emoIcon = baseUrl + 'app/Addons/Chatbox/assets/images/emoticon.png';
        c.append('<form id="chatbox-form-'+id+'" class="clearfix" action="" enctype="multipart/form-data"><textarea id="post-textarea" data-id="'+id+'" data-off="true" autocomplete="off"  name="text" placeholder="Send a message"></textarea><div class="chatbox-editor-right"><div class="emoticons-container"></div> <a href="" class="emoticon-trigger"><img src="'+emoIcon+'"/></a> <span style="position:relative;top: 10px; overflow: hidden;display: inline-block"   class=" fileupload fileupload-exists" data-provides="fileupload"><a   class="btn-file"><span class="fileupload-new"><i class="icon ion-android-camera"></i></span><span class="fileupload-exists"><i class="icon ion-android-camera"></i></span><input   class="" type="file" name="image"></a></span></div></form></div>');

        $('body').append(c);

        //load there old conversions in
        var chatMessages = c.find('.chatbox-messages');
        $.ajax({
            url : baseUrl + 'chatbox/load/old?userid=' + id,
            success : function(data) {
                var data = jQuery.parseJSON(data);
                chatMessages.html(data.content);

                //set online status details
                var oStatus = data.status;
                var oStatusText = data.statustext;
                var oBoxTitle = c.find('.head').find('.name');
                var oHisSubHead = c.find('.sub-head');
                oHisSubHead.find('.online-status').html(oStatusText);
                if (oStatus == 0) {
                    oBoxTitle.find('i').hide();
                } else {
                    var theI = oBoxTitle.find('i');
                    if (oStatus == 1) {
                        theI.css('color', '#26C281')
                    } else {
                        theI.css('color', '#E38826')
                    }
                    theI.show();
                }

                //correct time
                $('.post-time span').timeago();
                chatbox.scrollDown(chatMessages);
                chatbox.updateUnread();
                reloadPlugins();
            }
        });

        //attach event to this chat messages container when the scroll is about to reach top to load old messages
        chatMessages.scroll(function() {
            var cM = $(this);
            var scrTop = $(this).prop('scrollTop');
            if (scrTop == 0) {
                //load old messages
                if ($(this).attr('old-finish') == undefined && cM.attr('old-working') == undefined){
                    var offset = (cM.attr('offset') == undefined) ? 0 : cM.attr('offset');
                    $.ajax({
                        url : baseUrl + 'chatbox/load/older?userid=' + id + '&offset=' + offset,
                        success : function(data) {
                            var data = jQuery.parseJSON(data);

                            if (data.content != '') {
                                chatMessages.prepend(data.content).attr('offset', data.offset);

                                reloadPlugins();
                            } else {
                                cM.attr('old-finish', 'true');
                            }

                            //cM.removeAttr('old-working').animate({ scrollTop: 160}, 1000);
                        }
                    });
                }

            }
        });
        //attach event to minimize button
        c.find('.head').click(function() {
            chatbox.minimize(c);
        });
        c.find('.minimize').click(function() {
            chatbox.minimize(c);
            return false;
        });

        //attach event to close button
        c.find('.delete').click(function() {
            chatbox.destroy(c, id);
            return false;
        });


        //attach event to emoticon trigger
        c.find('.emoticon-trigger').click(function() {
            var emoContainer = c.find('.emoticons-container');

            if (emoContainer.html() == '') {
                if (chatbox.emoticons == '') {
                    //load the emoticon in
                    $.ajax({
                        url : baseUrl + 'chatbox/load/emoticon',
                        success : function(data) {
                            chatbox.emoticons = data;
                            emoContainer.html(data);
                        }
                    });
                }

                emoContainer.html(chatbox.emoticons);
            }

            if (emoContainer.css('display') == 'none') {
                emoContainer.fadeIn('slow');

            } else {
                emoContainer.fadeOut('slow');
            }
            return false;
        });

        //if user has started type lets update user that is typing
        c.find('form').find('textarea').keyup(function(e) {
           if ($(this).data('typing') == undefined || $(this).data('typing') == '0') {
               if ($(this).val() != '' && $(this).val().length > 0) {
                   $(this).data('typing', 1);
                   $.ajax({
                       url : baseUrl + 'chatbox/typing',
                       data : {id : id}
                   });
               }
           }

            //submit the form if the keyboard press is enter
            if (e.which == 13 && ! e.shiftKey) {
                var theForm = $('#chatbox-form-' + $(this).data('id'));
                theForm.submit();
            }
        }).focusout(function() {
            if ($(this).val() == '') {
                $(this).data('typing', 0);
                $.ajax({
                    url : baseUrl + 'chatbox/offtyping',
                    data : {id : id}
                });
            }
        });

        //attach event to sending message
        c.find('form').submit(function(e) {
            e.preventDefault();

            //to prevent multiple send message

            var tf = $(this);
            var input = tf.find('textarea');
            var fI = tf.find('input[type=file]');
            var iV = input.val();
            var hasAttach = false;

            //if both textfield and image field is empty return false
            if ((input.val() == '' || input.val().length == 1) && fI.val() == '') {
                input.val('');
                return false;
            }

            var m = $("<div class='message pull-right'><span class='content'></span><span class='arrow-right'></span></div>");
            m.find('.content').html(iV);
            chatMessages.append(m);
            if (fI.val() != '') {
                //tf.css('opacity', '0.6');
                hasAttach = true;
                var sImage = $("<div style='margin: 5px 2px;color: #808080'>Sending image..</div>");
                m.find('.content').append(sImage);
            }

            chatbox.scrollDown(chatMessages);


            $.ajax({
                url : baseUrl + 'chatbox/send?userid=' + id,
                type : 'POST',
                data : new FormData(this),
                contentType : false,
                cache : false,
                processData : false,
                success : function(data) {
                    //tf.css('opacity', 1);
                    //remove typing event from the input
                    input.data('typing', '0');
                    m.find('.content').html(data);

                    if (hasAttach) {

                        sImage.remove();
                    }
                    reloadPlugins();
                    chatbox.scrollDown(chatMessages);

                }
            });
            input.val('');
            fI.val('');
        })

        //////this.keepChecking();
        this.checkAjax.abort();
        return c;
    },

    ensureContainerCreated : function() {

        if (!$('#chatbox-container').length) {
            $('body').append($('<div id="chatbox-container"></div>'))
            this.container = $('#chatbox-container');
        }
    },

    minimize : function(c) {
        var m = c.find('.chatbox-messages');
        var f = c.find('form');
        var s = c.find('.sub-head');

        if (m.css('display') == 'none') {
            m.slideDown();
            s.slideDown();
            f.slideDown();
        } else {
            s.slideUp();
            m.slideUp();
            f.slideUp();

        }
    },

    destroy : function(c, id) {

        var index = this.boxes.indexOf(id);
        c.remove();
        this.boxes.splice(index, 1);
        this.reposition();

        this.updateOpenedBoxes();
    },

    reposition : function() {
        for(i = 1;i <= this.boxes.length; i++) {
            var index = i - 1;
            var chatbox = $('#chatbox-' + this.boxes[index]);
            chatbox.removeClass('chatbox-1 chatbox-2 chatbox-3').addClass('chatbox-' + i);

        }
    },

    userReponed : function() {

        for(i=0;i <= userBoxes.length;i++) {
            var theBox = userBoxes[i];
            if (userBoxes[i]) this.create(theBox[0], theBox[1], theBox[2]);
        }
    }
};

$(function() {

   if (isLogin == 'true'&& chatDo == 1) {
       //initiate chatbox
       chatbox.init();
       //chatbox.refreshChatList();
        //alert('this twalo');
       chatbox.keepChecking();

       chatbox.userReponed();
   }



    //attach event to each emoticon
    $(document).on('click', '.chatbox-emoticon-selector', function() {
        var emoCode = $(this).data('code');
        var p = $(this).parent().parent().parent();
        var input = p.find('textarea');

        input.select().val(input.val() + ' ' + emoCode + ' ').focus();
        $(this).parent().fadeOut();
        return false;
    });

    $(document).on('click', '.chat-list a', function() {
        //ensure initiation of chatbox chat
        chatbox.init();

        if(!chatbox.canCreate()) return true;

        chatbox.create($(this).data('userid'), $(this).data('name'), $(this).data('link'));
        return false;
    });

    $(document).on('click', '.message-dropdown-link', function() {
        //ensure initiation of chatbox chat
        chatbox.init();
        $('.message-dropdown').fadeOut();
        if(!chatbox.canCreate()) return true;

        chatbox.create($(this).data('userid'), $(this).data('name'), $(this).data('link'));

        return false;
    });


});