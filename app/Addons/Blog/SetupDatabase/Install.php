<?php

namespace App\Addons\Blog\SetupDatabase;

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
        if (!\Schema::hasTable('blogs')) {
            \Schema::create('blogs', function(Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->integer('user_id');
                $table->text('content');
                $table->integer('category_id');
                $table->integer('privacy')->default(0);
                $table->integer('show_comments')->default(0);
                $table->integer('show_likes')->default(0);
                $table->string('slug');
                $table->integer('status')->default(1);
                $table->text('tags');
                $table->timestamps();
            });
        }

        try{
            @\DB::statement("ALTER TABLE blogs ADD INDEX `user_id`(`user_id`)");
            @\DB::statement("ALTER TABLE blogs ADD INDEX `title`(`title`)");
            @\DB::statement("ALTER TABLE blogs ADD INDEX `category_id`(`category_id`)");
            @\DB::statement("ALTER TABLE blogs ADD INDEX `status`(`status`)");
            @\DB::statement("ALTER TABLE blogs ADD INDEX `slug`(`slug`)");

        }catch (\Exception $e){}

        if (!\Schema::hasTable('blogs_category')) {
            \Schema::create('blogs_category', function(Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->timestamps();
            });
        }


        $blogCategoryRepository = app('App\\Addons\\Blog\\Classes\\BlogCategoryRepository');

        $blogCategoryRepository->add('Business');
        $blogCategoryRepository->add('Education');
        $blogCategoryRepository->add('Entertainment');
        $blogCategoryRepository->add('Family & Home');
        $blogCategoryRepository->add('Health');
        $blogCategoryRepository->add('Shopping');
        $blogCategoryRepository->add('Society');
        $blogCategoryRepository->add('Sports');
        $blogCategoryRepository->add('Technology');

    }
}