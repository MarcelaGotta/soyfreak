<?php

namespace App\Addons\Verifybadge\Controllers;
use App\Addons\Verifybadge\Classes\VerifyBadgeRepository;

/**
*
*@author: Tiamiyu waliu kola
*@website : www.crea8social.com
*/
class RequestController extends \BaseController
{
    public function __construct(VerifyBadgeRepository $verifyBadgeRepository)
    {
        parent::__construct();
        $this->verifyRepository = $verifyBadgeRepository;
    }

    public function send()
    {
        $send = $this->verifyRepository->send(\Input::get('val'));

        if ($send) {
            return \Redirect::to(\URL::previous())->with('successmessage', trans('verifybadge::global.success-message'));
        } else {
            return \Redirect::to(\URL::previous())->with('errormessage', trans('verifybadge::global.error-message'));
        }
    }
}