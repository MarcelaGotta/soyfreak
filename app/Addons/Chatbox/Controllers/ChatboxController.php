<?php

namespace App\Addons\Chatbox\Controllers;
use App\Repositories\MessageRepository;
use App\Repositories\RealTimeRepository;
use App\Repositories\UserRepository;

/**
*
*@author: Tiamiyu waliu kola
*@website : www.crea8social.com
*/
class ChatboxController extends \BaseController
{
    public function __construct(
        MessageRepository $messageRepository,
        UserRepository $userRepository,
        RealTimeRepository $realTimeRepository
    )
    {
        parent::__construct();
        $this->messageRepository = $messageRepository;
        $this->userRepository = $userRepository;
        $this->realTimeRepository = $realTimeRepository;
    }

    public function updateOpened()
    {
        $boxes = \Input::get('boxes');

        $this->userRepository->savePrivacy(['chatboxes' => $boxes]);
    }

    public function send()
    {
        $userid = \Input::get('userid');
        $text = \Input::get('text');
        $this->realTimeRepository->add($userid, 'typing');
        $this->userRepository->savePrivacy(['typing-'.$userid => 0]);
        $message = $this->messageRepository->send($userid, $text, \Input::file('image'));

        $content = '';

        if ($message) {
            $content .= $message->present()->text();

            if($message->image) {
                $img= "<img style='display:block' src='".\Image::url($message->image, 100)."'/>";
                $content .= "<a class='preview-image' rel='message-".$message->id."' href='".\Image::url($message->image, 600)."'>".$img.'</a>';
            }
        }

        return $content;
    }

    public function loadEmoticon()
    {
        return $this->theme->section('chatbox::emoticons');
    }

    public function loadOld()
    {
        $userid = \Input::get('userid');
        $messages = $this->messageRepository->getList($userid, 10);
        $this->messageRepository->markAllByUser($userid);

        $results = [

        ];

        $user = $this->userRepository->findById($userid);
        $oStatus = $user->present()->isOnline();
        $oStatusName = trans('message.online');
        if ($oStatus == 0) {
            $oStatusName = trans('message.offline');
        }elseif($oStatus == 2) {
            $oStatusName = trans('message.busy');
        }
        $results['status'] = $oStatus;
        $results['statustext'] = $oStatusName;
        $results['content'] = (String) $this->theme->section('chatbox::display-messages', ['messages' => $messages, 'user' => \Auth::user()]);

        return json_encode($results);
    }

    public function checkUpdate()
    {
        usleep(1000000);
        $boxes = \Input::get('ids', []);

        if (!\Auth::check()) {
            return json_encode([
                'error' => true
            ]);
        }
        $this->realTimeRepository->setType('chat');

        $results = ['message' => [], 'typing' => [], 'messageIds' => [], 'lastaccess' => $this->realTimeRepository->getLastAccess(\Auth::user()->id)];
        $results['newboxes'] = [];
        $currentTime = date('Y-m-d H:i:s', time());
        $continue = true;
        $results['lastaccess'] = $this->realTimeRepository->getLastAccess(\Auth::user()->id);

        if ($this->realTimeRepository->has(\Auth::user()->id, 'message', \Input::get('lastaccess'))) {

            $continue = false;
            $this->realTimeRepository->remove(\Auth::user()->id, 'message');
            foreach($boxes as $box) {
                $userid = $box[0];
                $lastcheck = $box[1];
                //$box[1] = $currentTime;
                $messageIds = \Input::get('messageIds', ['0']);
                $results['message'][$userid] = [];



                $results['message'][$userid]['userid'] = $userid;
                $results['message'][$userid]['lastcheck'] = $currentTime;
                $results['message'][$userid]['messages'] = '';

                $lastcheck = (!$lastcheck) ? 'nill' : $lastcheck;

                $messages = $this->messageRepository->getList($userid, 100, 0, $lastcheck, $messageIds);

                foreach($messages as $message) {
                    $results['messageIds'][] = $message->id;
                }

                $results['message'][$userid]['messages'] = (string) $this->theme->section('chatbox::display-messages', ['messages' => $messages, 'user' => \Auth::user()]);

            }

            //process message from non-open boxes
            $ignoreUserIds = \Input::get('boxes', ['0']);
            $messages = $this->messageRepository->getNewList($ignoreUserIds);

            foreach($messages as $message) {
                $results['newboxes'][$message->sender] = [
                    'name' => $message->senderUser->fullname,
                    'userid' => $message->sender,
                    'link' => $message->senderUser->present()->url()
                ];
            }
        }

        if ($this->realTimeRepository->has(\Auth::user()->id, 'typing', \Input::get('lastaccess'))) {
            $continue = false;
            $this->realTimeRepository->remove(\Auth::user()->id, 'typing');

            foreach($boxes as $box) {
                $userid = $box[0];
                $user = $this->userRepository->findById($userid);
                $results['typing'][$userid] =  [
                    'userid' => $userid,
                    'status' => $user->present()->privacy('typing-'.\Auth::user()->id , 1)
                ];
            }
        }




        clearstatcache(storage_path('realtime/'));

        //online members
        $onlineCount = $this->userRepository->countFriendsOnline();
        $results['onlinecount'] = $onlineCount;

        $results['onlinescontent'] = (string) $this->theme->section('messages.online', [
        'users' => $this->userRepository->listOnlineUsers()
        ]);

        //online status of boxes
        $results['boxesstatus'] = [];
        foreach($boxes as $box) {
            $userid = $box[0];
            $user = $this->userRepository->findById($userid);
            $oStatus = $user->present()->isOnline();
            $oStatusName = trans('message.online');
            if ($oStatus == 0) {
                $oStatusName = trans('message.offline');
            }elseif($oStatus == 2) {
                $oStatusName = trans('message.busy');
            }
            $results['boxesstatus'][$userid] =  [
                'userid' => $userid,
                'status' => $oStatus,
                'statustext' => $oStatusName
            ];
        }

        //unread message count
        $results['unreadcount'] = $this->messageRepository->countNew();

        return json_encode($results);

    }

    public function loadOlder()
    {
        $limit = 10 ;
        $userid = \Input::get('userid');
        $offset = \Input::get('offset');
        $offset = (empty($offset)) ? $limit : $offset;
        $newOffset = $offset  +  $limit;


        return json_encode([
            'offset' =>$newOffset,
            'content' => (String)  $this->theme->section('chatbox::display-messages', ['user' => \Auth::user(),'messages' => $this->messageRepository->getList($userid, $limit, $offset)])
        ]);
    }

    public function typing()
    {
        $this->realTimeRepository->add(\Input::get('id'), 'typing');
        $this->userRepository->savePrivacy(['typing-'.\Input::get('id') => 1]);
    }

    public function offtyping()
    {
        //$this->realTimeRepository->add(\Input::get('id'), 'typing');
        $this->userRepository->savePrivacy(['typing-'.\Input::get('id') => 0]);
    }

    public function countUnread()
    {
        return (String) $this->messageRepository->countNew();
    }
}