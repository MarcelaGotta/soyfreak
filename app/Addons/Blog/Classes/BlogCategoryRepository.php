<?php
namespace App\Addons\Blog\Classes;
/**
*
*@author: Tiamiyu waliu kola
*@website : www.crea8social.com
*/
class BlogCategoryRepository
{
    public function __construct(BlogCategory $blogCategory)
    {
        $this->model = $blogCategory;
    }

    /**
     * Method to add
     */
    public function add($name)
    {
        if (!$this->exists($name)) {
            $category = $this->model->newInstance();
            $category->title = $name;
            $category->save();

            return true;
        }

        return false;
    }

    public function edit($name, $category)
    {
        $category->title = $name;
        $category->save();
        return true;
    }

    public function delete($id)
    {
        $category = $this->findById($id);
        if ($category) $category->delete();

        return true;
    }

    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function exists($id)
    {
        return $this->model->where('title', $id)->first();
    }

    public function getList()
    {
        return $this->model->get();
    }
}