<?php

namespace App\Controllers;

class CourseController extends BaseController
{
    public function employee_department(){
        $data = ['title' => 'Course Details'];
        if ($this->request->is("get")) {
            return view('admin/course/courseList',$data);
        }else if ($this->request->is("post")) {

        }
    }
}
