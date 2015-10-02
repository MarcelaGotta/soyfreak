<?php
namespace App\Addons\Activity\Controller;
use App\Addons\Activity\Classes\ActivityRepository;
use App\Controllers\Base\UserBaseController;

/**
*
*@author: Tiamiyu waliu kola
*@website : www.crea8social.com
*/
class ActivityController extends UserBaseController
{
    public function __construct(ActivityRepository $activityRepository)
    {
        parent::__construct();
        $this->activityRepository = $activityRepository;
    }

    public function index()
    {
        $type = \Input::get('type', 'all');

        return $this->render('activity::index', [
            'lists' => $this->activityRepository->lists($type, 10, 0, null, false),
            'type' => $type
        ], ['title' => $this->setTitle(trans('activity::global.activities'))]);
    }

    public function loadMore()
    {
        $offset = \Input::get('offset');
        $limit = \Config::get('activities-per-page', 10);
        $lists = $this->activityRepository->lists('all', $limit, $offset, null, false);

        $results = [
            'content' => '',
            'offset' => (int) $offset  + (int) $limit
        ];

        foreach($lists as $list) {
            $results['content'] .= \Theme::section($list->views, array_merge(['activity' => $list], perfectUnserialize($list->view_data)));
        }

        return json_encode($results);
    }

    public function check()
    {
        $currentTime = date('Y-m-d H:i:s', time());
        $lastcheck = \Input::get('lastcheck');
        $results = [
            'content' => '',
            'lastcheck' => $currentTime
        ];

        if (empty($lastcheck) or !\Auth::check())  return json_encode($results);
        $lists = $this->activityRepository->listByNewest($lastcheck);

        foreach($lists as $list) {
            $results['content'] .= \Theme::section($list->views, array_merge(['activity' => $list], perfectUnserialize($list->view_data)));
        }

        return json_encode($results);
    }
}