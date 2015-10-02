<?php

namespace App\Addons\Activity\SetupDatabase;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema;

/**
*
*@author: Tiamiyu waliu kola
*@website : www.crea8social.com
*/
class Install
{
    public function database()
    {
        if (!\Schema::hasTable('user_activities')) {
            \Schema::create('user_activities', function(Blueprint $table) {
                $table->increments('id');
                $table->string('user_id');
                $table->string('type');
                $table->string('type_id');
                $table->text('views');
                $table->text('view_data');
                $table->timestamps();
            });
        }


    }
}