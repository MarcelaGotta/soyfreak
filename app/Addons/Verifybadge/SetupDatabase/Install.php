<?php

namespace App\Addons\Verifybadge\SetupDatabase;

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
        if (!\Schema::hasTable('verified_requests')) {
            \Schema::create('verified_requests', function(Blueprint $table) {
                $table->increments('id');
                $table->string('type');
                $table->integer('type_id');
                $table->longText('info');
                $table->timestamps();
            });
        }

        $this->addDefaultFields();
    }

    public function addDefaultFields()
    {
        $customField = app('App\\Repositories\\CustomFieldRepository');

        //for profile
        $customField->add([
            'name' => 'Your Title',
            'type' => 'user-form',
            'field_type' => 'text',
            'description' => 'Provide your title for example (Mr, Mrs, Miss e.t.c)'
        ]);
        $customField->add([
            'name' => 'FullName',
            'type' => 'user-form',
            'field_type' => 'text',
            'description' => 'Provide your correct full name containing your firstname and lastname'
        ]);

        $customField->add([
            'name' => 'Your Address',
            'type' => 'user-form',
            'field_type' => 'text',
            'description' => 'Provide your residential address'
        ]);

        $customField->add([
            'name' => 'Personal Website (Optional)',
            'type' => 'user-form',
            'field_type' => 'text',
            'description' => 'Provide your personal website if available'
        ]);

        //for pages
        $customField->add([
            'name' => 'Official Website',
            'type' => 'page-form',
            'field_type' => 'text',
            'description' => 'Provide the page official website if available'
        ]);

        $customField->add([
            'name' => 'Page Email Address',
            'type' => 'page-form',
            'field_type' => 'text',
            'description' => 'Provide the page personal email address'
        ]);
    }
}