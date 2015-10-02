<?php

namespace App\Addons\Custombox\SetupDatabase;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema;

/**
*
*@author: Christian Koenig
*@website : http://www.facebook.com/pages/MarvinToys/120541371391828
*/

class Install
{
    public function database()
    {
        if (!\Schema::hasTable('custom_boxes')) {
            \Schema::create('custom_boxes', function(Blueprint $table) {
                $table->increments('id');
                $table->string('headline');
                $table->string('title');
                $table->text('content');
                $table->text('style_boxheader');
                $table->string('headerimg');
                $table->string('headercol');
                $table->string('icontype');
                $table->string('footer');
                $table->integer('privacy')->default(0);
                $table->integer('show_likes')->default(0);
                $table->string('slug');
                $table->integer('active')->default(1);
                $table->timestamps();
            });
        }


    }
}