<?php

namespace App\Addons\Verifybadge\Classes;
use App\Repositories\NotificationRepository;

/**
*
*@author: Tiamiyu waliu kola
*@website : www.crea8social.com
*/
class VerifyBadgeRepository
{
    public function __construct(VerifyRequest $request, NotificationRepository $notificationRepository)
    {
        $this->model = $request;
        $this->notification  = $notificationRepository;
    }

    public function process($which, $type, $id)
    {

        switch($which) {
            case 'verify':
                    if ($type == 'user') {
                        $user = app('App\\Repositories\\UserRepository')->findById($id);
                        if ($user) {
                            //lets award the user
                            $user->verified = 1;
                            $user->save();

                            //lets send this user a notification user here
                            if ($user->id != \Auth::user()->id) {
                                $this->notification->send($user->id, [
                                    'path' => 'verifybadge::notification.user'
                                ]);
                            }
                        }
                    } else {

                        $page = app('App\\Repositories\\PageRepository')->get($id);
                        if ($page) {
                            $page->verified = 1;
                            $page->save();

                            //award send a notification to the page owner
                            if ($page->user->id != \Auth::user()->id) {
                                $this->notification->send($page->user->id, [
                                    'path' => 'verifybadge::notification.page',
                                    'page' => $page
                                ]);
                            }


                        }
                    }
                break;
            default:
                if ($type == 'user') {
                    $user = app('App\\Repositories\\UserRepository')->findById($id);
                    if ($user) {
                        //lets award the user
                        $user->verified = 0;
                        $user->save();

                    }
                } else {

                    $page = app('App\\Repositories\\PageRepository')->get($id);
                    if ($page) {
                        $page->verified = 0;
                        $page->save();

                    }
                }
                break;
        }
    }

    public function send($val)
    {
        $expected = [
            'type' => '',
            'type_id' => '',
            'info' => ''
        ];

        /**
         * @var $type
         * @var $type_id
         * @var $info
         */
        extract(array_merge($expected, $val));

        if ($this->exists($type, $type_id)) return false;
        $request = $this->model->newInstance();
        $request->type = $type;
        $request->type_id = $type_id;
        $request->info = perfectSerialize($info);
        $request->save();

        return true;
    }

    public function exists($type, $typeId)
    {
        return $this->model->where('type', '=', $type)
            ->where('type_id', '=', $typeId)->first();
    }

    public function getAll($type)
    {
        $lists = $this->model;

        if ($type != 'all') {
            $lists = $lists->where('type', '=', $type);
        }

        return $lists = $lists->orderBy('id', 'desc')->paginate(10);
    }

    public function findById($id)
    {
        return $this->model->where('id', '=', $id)->first();
    }

    public function reject($id)
    {

        $request = $this->findById($id);

        if ($request) {
            $user = ($request->type == 'user') ? $request->user : $request->page->user;
            //send notification that request is rejected
            if ($user->id != \Auth::user()->id) {
                $this->notification->send($user->id, [
                    'path' => 'verifybadge::notification.reject',
                    'type' => $request->type,
                    'type_id' => $request->type_id
                ]);
            }
            $request->delete();
            return true;
        }

        return false;
    }

    public function approve($id)
    {

        $request = $this->findById($id);

        if ($request) {
            $user = ($request->type == 'user') ? $request->user : $request->page->user;

            $this->process('verify', $request->type, $request->type_id);
            $request->delete();
            return true;
        }

        return false;
    }
}