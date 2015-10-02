$(function() {
   $(document).on('mouseover', '.side-activity-list', function() {
       window.paginateActivity = false;

       $(this).scroll(function() {
           if ($(this).data('stop') == undefined && !window.paginateActivity) {

               if ($(this).scrollTop() + $(this).innerHeight() >= this.scrollHeight) {
                   var offset = $(this).data('offset');
                   window.paginateActivity = true;
                   var obj = $(this);

                   $.ajax({
                       url : baseUrl + 'activity/more',
                       type : 'POST',
                       data : {offset : offset},
                       success : function(data) {
                           data = jQuery.parseJSON(data);
                           window.pageInviteePaginationn = false;
                           if (data.content == '') {
                               obj.data('stop', true);
                           } else {

                               if (data.content != 'login') {
                                   obj.append(data.content);
                                   obj.data('offset', data.offset);
                                   $('.post-time span').timeago();
                               }
                           }
                       }
                   })

               }
           }
       })
   });

    window.activityLastCheck = false;
    setInterval(function() {
        if ($('.side-activity-list').length && !window.activityLastCheck) {
            var obj = $('.side-activity-list');
            var lastcheck = obj.data('lastcheck');
            window.activityLastCheck = true;
            $.ajax({
                url : baseUrl + 'activity/check',
                data : {lastcheck : lastcheck},
                type : 'POST',
                success : function(data) {
                    window.activityLastCheck = false;
                    data = jQuery.parseJSON(data);
                    obj.data('lastcheck', data.lastcheck);
                    obj.prepend(data.content);
                    $('.post-time span').timeago();
                }
            })
        }
    }, activityTime)
});