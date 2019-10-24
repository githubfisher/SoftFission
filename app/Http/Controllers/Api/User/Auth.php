<?php
namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;

class Auth extends Controller
{
    public function login()
    {
        $this->response->errorForbidden();
    }

    public function info()
    {
        $this->response->errorForbidden();
    }
}
