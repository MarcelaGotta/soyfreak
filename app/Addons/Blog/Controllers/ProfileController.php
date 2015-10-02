<?php
namespace App\Addons\Blog\Controllers;
use App\Addons\Blog\Classes\BlogRepository;
use App\Controllers\Base\ProfileBaseController;

/**
*
*@author: Tiamiyu waliu kola
*@website : www.crea8social.com
*/
class ProfileController extends ProfileBaseController
{
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
        parent::__construct();
    }

    public function lists()
    {
        if (!$this->exists()) {
            return $this->profileNotFound();
        }

        return $this->render('blog::profile', [
            'blogs' => $this->blogRepository->getMyList($this->profileUser->id)
        ]);
    }
}