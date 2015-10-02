<?php

namespace App\Addons\Activity\Classes;
use Laracasts\Presenter\Presenter;

/**
*
*@author: Tiamiyu waliu kola
*@website : www.crea8social.com
*/
class ActivityPresenter extends Presenter
{

    public function render()
    {
        $type = $this->entity->type;

        //return \Theme::section($this->entity->views, ['activity' => $this->entity]);
        return '';
    }
}