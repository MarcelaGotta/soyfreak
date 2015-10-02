<?php

namespace App\Addons\Verifybadge\Controllers;

/**
*
*@author: Tiamiyu waliu kola
*@website : www.crea8social.com
*/
class AccountController extends \App\Controllers\AccountController
{
    public function form()
    {
        return $this->render('verifybadge::request.user-form', [
            'title' => $this->setTitle(trans('verifybadge::global.get-verified-form'))
        ])->render();
    }
}