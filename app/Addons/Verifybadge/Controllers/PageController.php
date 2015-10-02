<?php

namespace App\Addons\Verifybadge\Controllers;
use App\Addons\Verifybadge\Classes\VerifyBadgeRepository;
use App\Controllers\Base\PageBaseController;

/**
*
*@author: Tiamiyu waliu kola
*@website : www.crea8social.com
*/
class PageController extends PageBaseController
{
    public function __construct(VerifyBadgeRepository $verifyBadgeRepository)
    {
        parent::__construct();
        $this->verifyRepository = $verifyBadgeRepository;
    }

    public function form()
    {
        if(!$this->exists()) {
            return $this->notFound();
        }

        if ($this->page->verified == 1) return \Redirect::to($this->page->present()->url());

        return $this->render('verifybadge::request.page-form')->render();
    }
}