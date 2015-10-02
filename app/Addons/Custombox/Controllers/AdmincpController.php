<?php

namespace App\Addons\Custombox\Controllers;
use App\Addons\Custombox\Classes\CustomBoxRepository;

/**
*
*@author: Christian Koenig
*@website : http://www.facebook.com/pages/MarvinToys/120541371391828
*/

class AdmincpController extends \App\Controllers\Admincp\AdmincpController
{
    public function __construct(CustomBoxRepository $customBoxRepository)
    {
        parent::__construct();
        $this->customRepository = $customBoxRepository;

        $this->activePage('custom-box');
    }

    public function index()
    {
        $this->setTitle('Custom Boxes');
        return $this->theme->view('custombox::admincp.index', [
            'lists' => $this->customRepository->lists()
        ])->render();
    }

    public function delete($slug)
    {
        $box = $this->customRepository->findBySlug($slug);

        if ($box) {
            $box->deleteIt();
        }

        return \Redirect::route('admincp-custom-boxes');
    }

    public function edit($slug)
    {
        $box = $this->customRepository->findBySlug($slug);
        $message = null;

        if (!$box) return \Redirect::route('admincp-custom-boxes');

        if ($val = \Input::get('val')) {

            $validate = \Validator::make($val, [
                'title' => 'required',
                'content' => 'required'
            ]);

            if (!$validate->fails()) {
                $box = $this->customRepository->save($val, $box);
                if ($box) {
                    return \Redirect::route('admincp-custom-boxes');
                } else {
                    $message = "Failed to add box: maybe box exists";
                }
            } else {
                $message = $validate->messages()->first();
            }

        }

        return $this->theme->view('custombox::admincp.edit', [
            'message' => $message,
            'box' => $box
        ])->render();
    }

    public function add()
    {
        $message = null;

        $this->setTitle('Add New Box');

        if ($val = \Input::get('val')) {

            $validate = \Validator::make($val, [
                'title' => 'required',
                'content' => 'required'
            ]);

            if (!$validate->fails()) {
                $box = $this->customRepository->add($val);
                if ($box) {
                    return \Redirect::route('admincp-custom-boxes');
                } else {
                    $message = "Failed to add box: maybe box exists";
                }
            } else {
                $message = $validate->messages()->first();
            }

        }

        return $this->theme->view('custombox::admincp.add', [
            'message' => $message
        ])->render();
    }
	
    public function addspecial()
    {
        $message = null;

        $this->setTitle('Add New Special Box');

        if ($val = \Input::get('val')) {

            $validate = \Validator::make($val, [
                'title' => 'required',
                'content' => 'required'
            ]);

            if (!$validate->fails()) {
                $box = $this->customRepository->add($val);
                if ($box) {
                    return \Redirect::route('admincp-custom-boxes');
                } else {
                    $message = "Failed to add box: maybe box exists";
                }
            } else {
                $message = $validate->messages()->first();
            }

        }

        return $this->theme->view('custombox::admincp.addimg', [
            'message' => $message
        ])->render();
    }
}