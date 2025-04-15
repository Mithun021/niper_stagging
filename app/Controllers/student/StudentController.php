<?php

namespace App\Controllers\student;

use App\Controllers\BaseController;

class StudentController extends BaseController
{
    public function index()
    {
        $data = ['title' =>'Student Dashboard'];
        return view('students/index',$data); 
    }
}
