<?php
namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;

class Auth extends Controller
{
    public function index()
    {
        $this->response->errorBadRequest();
    }
}
