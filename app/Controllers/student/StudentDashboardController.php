<?php

namespace App\Controllers\student;

use App\Controllers\BaseController;

class StudentDashboardController extends BaseController
{
    public function index()
    {
        echo "ok"; die;
        
        $data = ['title' =>'Student Dashboard'];
        return view('students/index',$data); 
    }
}
