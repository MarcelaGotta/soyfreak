<?php

namespace App\Addons\Activity\Classes;

/**
*
*@author: Tiamiyu waliu kola
*@website : www.crea8social.com
*/
class ActivityRepository
{
    public function __construct(Activity $activity)
    {
        $this->model = $activity;
    }

    public function add($type, $typeId, $view, $view_data = [], $userid = null)
    {
        if (!\Auth::check()) return false;
        $userid = (empty($userid)) ? \Auth::user()->id : $userid;

        if (empty($type) or empty($typeId)) return false;

        //lets delete if this kind of data already exists to clean up things
        $this->model->where('type', '=', $type)
            ->where('type_id', '=', $typeId)
            ->where('user_id', '=', $userid)
            ->delete();

        $model = $this->model->newInstance();
        $model->user_id = $userid;
        $model->type = $type;
        $model->type_id = $typeId;
        $model->views = $view;
        $model->view_data = perfectSerialize($view_data);
        $model->save();
    }

    public function lists($type = 'all', $limit = 10, $offset = 0, $userid = null,$paginate = true)
    {
        $activities = $this->model->with(['user']);
        $userfriends = app('App\Repositories\ConnectionRepository')->getFriendsId();
        $userfriends[] = 0;
        $userid = (empty($userid)) ? \Auth::user()->id : $userid;

        if ($type == 'all') {
            $activities = $activities->where('user_id', '=', $userid)
                ->orWhereIn('user_id', $userfriends);
        } elseif($type == 'me') {
            $activities = $activities->where('user_id', '=', $userid);
        } elseif ($type == 'friends') {
            $activities = $activities->orWhereIn('user_id', $userfriends);
        }

        $activities = $activities->orderBy('id', 'desc');
        if (!$paginate) {
            return $activities = $activities->take($limit)->skip($offset)->get();
        } else {
            return $activities = $activities->paginate($limit);
        }
    }

    public function listByNewest($time)
    {
        $activities = $this->model->with(['user']);
        $userfriends = app('App\Repositories\ConnectionRepository')->getFriendsId();
        $userfriends[] = 0;
        $userid = (empty($userid)) ? \Auth::user()->id : $userid;
        $activities = $activities->where(function($activities) use($userid, $userfriends) {
            $activities->where('user_id', '=', $userid)
                ->orWhereIn('user_id', $userfriends);
        })->where('created_at', '>', $time);

        $activities = $activities->orderBy('id', 'desc');


            return $activities = $activities->get();
    }
}