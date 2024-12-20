<?php

namespace App\Http\Controllers;

use App\Http\Service\AuthService;
use App\Http\Service\UserService;

class BaseController {

    protected $authService;
    protected $userService;

    public function __construct(AuthService $authService, UserService $userService) {

        $this->authService = $authService;
        $this->userService = $userService;

    }

}
