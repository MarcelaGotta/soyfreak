<?php
namespace App\Addons\Custombox\Classes;

/**
*
*@author: Christian Koenig
*@website : http://www.facebook.com/pages/MarvinToys/120541371391828
*/

class CustomBoxRepository
{
    public function __construct(CustomBox $customBox)
    {
        $this->model = $customBox;
    }

    public function add($val)
    {
        $expected = [
			'headline' => '',
			'title' => '',
            'privacy' => 0,
            'likes' => 1,
            'active' => 1,
            'style_boxheader' => '',
            'headerimg' => '',
            'headercol' => '',
            'icontype' => '',
            'content' => '',
            'footer' => ''
        ];

        /**
         * @var $headline
         * @var $title
         * @var $privacy
         * @var $likes
         * @var $active
         * @var $style_boxheader
         * @var $headerimg
         * @var $headercol
         * @var $icontype
         * @var $content
         * @var $footer
         */
        extract(array_merge($expected, $val));

        $slug = hash('crc32', $title.time());
        $slug = $slug.'-'.\Str::slug($title);

        if (!$this->exists($title)) {
            $box = $this->model->newInstance();
            $box->headline = $headline;
            $box->title = $title;
            $box->privacy = $privacy;
            $box->content = lawedContent($content);
            $box->style_boxheader = lawedContent($style_boxheader);
            $box->headerimg = $headerimg;
            $box->headercol = $headercol;
            $box->icontype = $icontype;
            $box->footer = $footer;
            $box->slug = $slug;
            $box->show_likes = $likes;
            $box->content = $content;
            $box->active = $active;
            $box->save();

            return true;
        }

        return false;
    }

    public function save($val, $box)
    {
        $expected = [
            'headline' => '',
            'title' => '',
            'privacy' => 0,
            'likes' => 1,
            'active' => 1,
            'style_boxheader' => '',
            'headerimg' => '',
            'headercol' => '',
            'icontype' => '',
            'content' => '',
            'footer' => ''
        ];

        /**
         * @var $headline
         * @var $title
         * @var $privacy
         * @var $likes
         * @var $active
         * @var $style_boxheader
         * @var $headerimg
         * @var $headercol
         * @var $icontype
         * @var $content
         */
        extract(array_merge($expected, $val));

            $box->headline = $headline;
            $box->title = $title;
            $box->privacy = $privacy;
            $box->style_boxheader = lawedContent($style_boxheader);
            $box->headerimg = $headerimg;
            $box->headercol = $headercol;
            $box->icontype = $icontype;
            $box->footer = $footer;
            $box->content = lawedContent($content);
            $box->show_likes = $likes;
            $box->content = $content;
            $box->active = $active;
            $box->save();

            return true;

    }

    public function exists($title)
    {
        return $this->model->where('title', $title)->first();
    }

    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function lists($limit = 20)
    {
        return $this->model->paginate($limit);
    }

    public function getList($limit = 20, $all = false, $menu = true)
    {
        $lists = $this->model->where('active', 1)
            ->where(function($lists) {
                $lists->where('privacy', 0);

                if (\Auth::check() and \Auth::user()->isAdmin()) {
                    $lists->orWhere('privacy', 1)->orWhere('privacy', 2);
                }

                if (\Auth::check()) {
                    $lists->orWhere('privacy', 1);
                }
            });

        if ($all) return $lists = $lists->get();

        return $lists = $lists->paginate($limit);
    }
}
 