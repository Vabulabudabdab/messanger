<?php

namespace App\Http\Controllers;

use App\Http\Service\AuthService;

class BaseController {

    protected $authService;

    public function __construct(AuthService $authService) {

        $this->authService = $authService;

    }

}
