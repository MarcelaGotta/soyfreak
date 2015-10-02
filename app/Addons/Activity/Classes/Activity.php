<?php

namespace App\Addons\Activity\Classes;
use Illuminate\Database\Eloquent\Model;

/**
*
*@author: Tiamiyu waliu kola
*@website : www.crea8social.com
*/
class Activity extends Model
{
    protected $table = "user_activities";

    protected $presenter = "App\\Addons\\Activity\\Classes\\ActivityPresenter";

    public function user()
    {
        return $this->belongsTo('App\\Models\\User', 'user_id');
    }

    public function time()
    {
        return str_replace(' ', 'T', $this->created_at).'Z';
    }

    public function page()
    {
        return $this->belongsTo('App\\Models\\Page', 'type_id');
    }

    public function post()
    {
        return $this->belongsTo('App\\Models\\Post', 'type_id');
    }

    public function game()
    {
        return $this->belongsTo('App\\Models\\Game', 'type_id');
    }

    public function community()
    {
        return $this->belongsTo('App\\Models\\Community', 'type_id');
    }

    public function album()
    {
        return $this->belongsTo('App\\Models\\PhotoAlbum', 'type_id');
    }

    public function like()
    {
        return $this->belongsTo('App\\Models\\Like', 'type_id');
    }

    public function photo()
    {
        return $this->belongsTo('App\\Models\\Photos', 'type_id');
    }

    public function comment()
    {
        return $this->belongsTo('App\\Models\\Comment', 'type_id');
    }

    public function deleteIt()
    {
        $this->delete();
    }
}