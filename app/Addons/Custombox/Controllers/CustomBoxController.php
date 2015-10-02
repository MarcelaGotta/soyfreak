<?php
namespace App\Addons\Custombox\Controllers;
use App\Addons\Custombox\Classes\CustomBoxRepository;
use App\Controllers\Base\UserBaseController;

/**
*
*@author: Christian Koenig
*@website : http://www.facebook.com/pages/MarvinToys/120541371391828
*/

class CustomBoxController extends UserBaseController
{
    public function __construct(CustomBoxRepository $customBoxRepository)
    {
        parent::__construct();
        $this->customRepository = $customBoxRepository;
        $this->theme->share('customRepository', $this->customRepository);
    }
}