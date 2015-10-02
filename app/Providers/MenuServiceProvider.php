<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
*
*@author : Tiamiyu waliu
*@website : http://www.iDocrea8.com
*/
class MenuServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        /*if (\Config::get('system.installed') and \Auth::check()) {
            $this->app['menu']->add('site-menu', 'pages', [
                'name' => trans('photo.photos'),
                'link' => \URL::to(\Auth::user()->username.'/photos'),
                'ajaxify' => true,
                'icon' => '<i class="icon ion-ios7-photos-outline"></i>'
            ]);
        }*/

        $this->app['menu']->add('menu-barra', '#discover', [
            'link' => \URL::to('discover/post'),
            'ajaxify' => true,
            'icon' => '<i class="icon ion-pound"></i>',
            'title' => 'Descubre lo que ocurre a tu alrededor'
        ]);

        $this->app['menu']->add('menu-barra', '@mention', [
            'link' => \URL::to('discover/mention'),
            'ajaxify' => true,
            'icon' => '<i class="icon ion-at"></i>',
            'title' => 'Menciones que has recibido'
        ]);

        $this->app['menu']->add('site-menu', 'communities', [
            'name' => trans('community.communities'),
            'link' => \URL::to('communities'),
            'ajaxify' => true,
            'icon' => '<i class="icon ion-android-favorite"></i>'
        ]);
        if (!\Config::get('disable-game', 0)) {
            $this->app['menu']->add('site-menu', 'games', [
                'name' => trans('game.games'),
                'link' => \URL::to('games'),
                'ajaxify' => true,
                'icon' => '<i class="icon ion-game-controller-b"></i>'
            ]);
        }

        /*$this->app['menu']->add('site-menu', 'invite', [
            'name' => trans('user.invite'),
            'link' => \URL::to('invite'),
            'ajaxify' => true,
            'icon' => '<i class="icon ion-android-contacts"></i>'
        ]);*/

        $this->app['menu']->add('site-menu', 'page', [
            'name' => trans('page.pages'),
            'link' => \URL::to('pages'),
            'ajaxify' => true,
            'icon' => '<i class="icon ion-pound"></i>'
        ]);
    }

}