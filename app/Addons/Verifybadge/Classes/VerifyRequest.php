<?php

namespace App\Addons\Verifybadge\Classes;
use Illuminate\Database\Eloquent\Model;

/**
*
*@author: Tiamiyu waliu kola
*@website : www.crea8social.com
*/
class VerifyRequest extends Model
{
    protected $table = "verified_requests";

    public function user()
    {
        return $this->belongsTo('App\\Models\\User', 'type_id');
    }

    public function page()
    {
        return $this->belongsTo('App\\Models\\Page', 'type_id');
    }

    public function listsFields($type)
    {
        return app('App\\Repositories\\CustomFieldRepository')->listAll($type);
    }

    public function fieldValue($name)
    {
        $details = (!empty($this->info)) ? perfectUnserialize($this->info) : [];


        if (empty($name)) return $details;

        if (isset($details[$name])) return $details[$name];

        return null;
    }
}
 