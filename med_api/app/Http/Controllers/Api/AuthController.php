<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OperationService;
use App\Services\AuthService;
class AuthController extends Controller
{
    //
    protected AuthService $_authService;
    protected OperationService $_operationService;

    public function __construct(AuthService $authService, OperationService $operationService )
    {
        $this->_authService = $authService;
        $this->_operationService = $operationService;
    }
}
