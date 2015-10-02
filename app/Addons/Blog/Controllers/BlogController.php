<?php

namespace App\Addons\Blog\Controllers;
use App\Addons\Blog\Classes\BlogRepository;
use App\Controllers\Base\UserBaseController;

/**
*
*@author: Tiamiyu waliu kola
*@website : www.crea8social.com
*/
class BlogController extends UserBaseController
{
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
        parent::__construct();
    }

    public function index()
    {
        $this->theme->share('site_description', \Config::get('blog-meta-description', ''));
        $this->theme->share('site_keywords', \Config::get('blog-meta-keywords', ''));
        $this->theme->share('ogSiteName', \Config::get('site_title'));
        $this->theme->share('ogUrl', \URL::route('blogs'));
        $this->theme->share('ogTitle', trans('blog::global.blogs'));

        $blogs = $this->blogRepository->getLists(\Input::get('category', null), \Input::get('term', null));

        return $this->preRender($this->theme->section('blog::index', [
            'blogs' => $blogs
        ]), trans('blog::global.blogs'));
    }

    public function page($slug)
    {
        $blog = $this->blogRepository->findBySlug($slug);

        if (!$blog or !$blog->canView() or !$blog->isGood()) return $this->theme->section('error-page');

        $this->theme->share('site_description', \Str::limit(strip_tags($blog->content), 200));
        $this->theme->share('ogSiteName', \Config::get('site_title'));
        $this->theme->share('ogUrl', \URL::route('blogs'));
        $this->theme->share('ogTitle', $blog->title);
        $this->theme->share('ogImage', $blog->user->present()->getAvatar(100));

        return $this->render('blog::page', ['blog' => $blog], ['title' => $this->setTitle($blog->title)]);

    }

    public function edit($slug)
    {
        $blog = $this->blogRepository->findBySlug($slug);

        if (!$blog or !$blog->canEdit()) return $this->theme->section('error-page');
        $message = null;

        if ($val = \Input::get('val')) {
            $validate = \Validator::make($val, [
                'title' => 'required',
                'post' => 'required',
            ]);

            if (!$validate->fails()) {
                $blog = $this->blogRepository->add($val, $blog);

                if ($blog) {
                    //go to blog page
                    return \Redirect::to($blog->url());
                } else {
                    $message = "Failed to create blog, maybe it already exists";
                }
            } else {
                $message = $validate->messages()->first();
            }
        }

        return $this->preRender($this->theme->section('blog::edit', ['blog' => $blog, 'message' => $message]), $blog->title);

    }

    public function delete($slug)
    {
        $blog = $this->blogRepository->findBySlug($slug);

        if (!$blog or !$blog->canEdit()) return $this->theme->section('error-page');

        $blog->deleteIt();

        return \Redirect::route('blogs');
    }

    public function canAccess()
    {
        if (!\Auth::check()) return false;
        if (\Config::get('allow-non-admin-create-blog', true) or \Auth::user()->isAdmin()) return true;
        return false;
    }

    public function add()
    {
        $message = null;

        //redirect to blogs page if user can't access this page
        if (!$this->canAccess()) return \Redirect::route('blogs');

        if ($val = \Input::get('val')) {
            $validate = \Validator::make($val, [
                'title' => 'required',
                'post' => 'required',
            ]);

            if (!$validate->fails()) {
                $blog = $this->blogRepository->add($val);

                if ($blog) {
                    //go to blog page
                    return \Redirect::to($blog->url());
                } else {
                    $message = "Failed to create blog, maybe it already exists";
                }
            } else {
                $message = $validate->messages()->first();
            }
        }

        return $this->preRender($this->theme->section('blog::add', ['message' => $message]), trans('blog::global.add-new-blog'));
    }

    public function preRender($content, $title = null)
    {
        return $this->render('blog::layout', [
            'content' => $content
        ], ['title' => $this->setTitle($title)]);
    }
}