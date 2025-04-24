<?php

namespace App\Controllers\student;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function login()
    {
        $data = ['title' =>'Student Login'];
        if ($this->request->is('get')) {
            return view('student/login',$data);
        }else if ($this->request->is('post')) {
            echo "ok";
        }
         
    }
}
