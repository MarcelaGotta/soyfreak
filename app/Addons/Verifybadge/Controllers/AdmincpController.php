<?php

namespace App\Addons\Verifybadge\Controllers;
use App\Addons\Verifybadge\Classes\VerifyBadgeRepository;
use App\Repositories\CustomFieldRepository;
use App\Repositories\PageRepository;
use App\Repositories\UserRepository;

/**
*
*@author: Tiamiyu waliu kola
*@website : www.crea8social.com
*/
class AdmincpController extends \App\Controllers\Admincp\AdmincpController
{
    public function __construct(
        CustomFieldRepository $customFieldRepository,
        UserRepository $userRepository,
        PageRepository $pageRepository,
        VerifyBadgeRepository $verifyBadgeRepository
    )
    {
        parent::__construct();
        $this->customFieldRepository = $customFieldRepository;
        $this->activePage('verify-badge');
        $this->userRepository = $userRepository;
        $this->pageRepository = $pageRepository;
        $this->verifyRepository = $verifyBadgeRepository;
    }

    public function requests()
    {
        $type = \Input::get('type', 'all');

        return $this->theme->view('verifybadge::admincp.requests', [
            'requests' => $this->verifyRepository->getAll($type),
            'type' => $type
        ])->render();
    }

    public function reject($id)
    {
        $this->verifyRepository->reject($id);
        return \Redirect::to(\URL::previous());
    }

    public function approve($id)
    {
        $this->verifyRepository->approve($id);
        return \Redirect::to(\URL::previous());
    }

    public function doVerify($which, $type, $id)
    {
        $this->verifyRepository->process($which, $type, $id);

        return \Redirect::to(\URL::previous());
    }

    public function customFields()
    {
        $type = \Input::get('type', 'user-form');

        return $this->theme->view('verifybadge::admincp.custom-fields', [
            'type' => $type,
            'fields' => $this->customFieldRepository->listAll($type)
        ])->render();
    }

    public function addCustomFields()
    {
        $message = "";

        if ($val = \Input::get('val')) {
            $this->customFieldRepository->add($val);
            $message = "Custom field added successfully";
        }
        return $this->theme->view('verifybadge::admincp.add-custom-fields', ['message' => $message])->render();
    }

    public function pages()
    {
        return $this->theme->view('verifybadge::admincp.pages', ['pages' => $this->pageRepository->lists(null, 20, \Input::get('term'))])->render();
    }

    public function users()
    {
        return $this->theme->view('verifybadge::admincp.users', ['users' => $this->userRepository->listAll(\Input::get('term'))])->render();
    }

    public function deleteCustomFields($id)
    {
        $this->customFieldRepository->delete($id);
        return \Redirect::to(\URL::previous());
    }

    public function editCustomFields($id)
    {
        $field = $this->customFieldRepository->get($id);

        if (!empty($field)) {

            if ($val = \Input::get('val')) {
                $this->customFieldRepository->save($val, $id);

                return \Redirect::route('verifybadge-custom-fields').'?='.$field->type;
            }
            return $this->theme->view('verifybadge::admincp.edit-custom-fields', ['field' => $field])->render();
        }
    }
}
 