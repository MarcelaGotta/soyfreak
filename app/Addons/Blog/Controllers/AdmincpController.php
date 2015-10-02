<?php
namespace App\Addons\Blog\Controllers;
use App\Addons\Blog\Classes\BlogCategoryRepository;
use App\Addons\Blog\Classes\BlogRepository;

/**
*
*@author: Tiamiyu waliu kola
*@website : www.crea8social.com
*/
class AdmincpController extends \App\Controllers\Admincp\AdmincpController
{
    public function __construct(BlogCategoryRepository $blogCategoryRepository,BlogRepository $blogRepository)
    {
        parent::__construct();
        $this->activePage('blog');
        $this->blogCategory = $blogCategoryRepository;
        $this->blogRepository = $blogRepository;
    }

    public function posts()
    {
        $this->setTitle('Blog Posts');

        return $this->theme->view('blog::admincp.posts', [
            'posts' => $this->blogRepository->adminLists(\Input::get('term'))
        ])->render();
    }

    public function editPost($id)
    {
        $blog = $this->blogRepository->findById($id);

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
                    return \Redirect::to(\URL::route('admincp-blog-posts'));
                } else {
                    $message = "Failed to create blog, maybe it already exists";
                }
            } else {
                $message = $validate->messages()->first();
            }
        }

        return $this->theme->view('blog::admincp.edit', [
            'blog' => $blog,
            'message' => $message
        ])->render();

    }

    public function addPost()
    {
        $message = null;

        if ($val = \Input::get('val')) {
            $validate = \Validator::make($val, [
                'title' => 'required',
                'post' => 'required',
            ]);

            if (!$validate->fails()) {
                $blog = $this->blogRepository->add($val);

                if ($blog) {
                    //go to blog page
                    return \Redirect::to(\URL::route('admincp-blog-posts'));
                } else {
                    $message = "Failed to create blog, maybe it already exists";
                }
            } else {
                $message = $validate->messages()->first();
            }
        }

        return $this->theme->view('blog::admincp.add', ['message' => $message])->render();
    }

    public function deletePost($id)
    {
        $blog = $this->blogRepository->findById($id);

        if (!$blog or !$blog->canEdit()) return $this->theme->section('error-page');

        $blog->deleteIt();

        return \Redirect::to(\URL::route('admincp-blog-posts'));
    }

    public function categories()
    {
        $this->setTitle('Blog Categories');

        return $this->theme->view('blog::admincp.categories.list', [
            'lists' => $this->blogCategory->getList()
        ])->render();
    }

    public function addCategory()
    {
        $message = null;
        $this->setTitle('Add New Blog Category');

        if ($title = \Input::get('title')) {
            $category = $this->blogCategory->add($title);
            if ($category) return \Redirect::route('admincp-blog-categories');

            $message = "Category already exists";
        }

        return $this->theme->view('blog::admincp.categories.add', [
            'message' => $message
        ])->render();
    }

    public function editCategory($id)
    {
        $message = null;
        $this->setTitle('Edit Blog Category');
        $category = $this->blogCategory->findById($id);

        if (!$category) return \Redirect::route('admincp-blog-categories');

        if ($title = \Input::get('title')) {
            $category = $this->blogCategory->edit($title, $category);
            if ($category) return \Redirect::route('admincp-blog-categories');

            $message = "Category already exists";
        }

        return $this->theme->view('blog::admincp.categories.edit', [
            'message' => $message,
            'category' => $category
        ])->render();
    }

    public function deleteCategory($id)
    {
        $this->blogCategory->delete($id);
        return \Redirect::route('admincp-blog-categories');
    }
}