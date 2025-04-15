<?php

namespace App\Controllers\student;

use App\Controllers\BaseController;

class StudentController extends BaseController
{
    public function index()
    {
        $data['title'] = 'Student List';
        return view('students/index'); // points to app/Views/student/index.php
    }
}
