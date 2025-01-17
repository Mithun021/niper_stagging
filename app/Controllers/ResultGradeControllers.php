<?php

namespace App\Controllers;

use App\Models\Department_model;

class ResultGradeControllers extends BaseController
{
    public function result(){
        $department_model = new Department_model();
        $data = ['title' => 'Result'];
        if ($this->request->is("get")) {
            $data['department'] = $department_model->activeData();
            return view('admin/result_grade/result',$data);
        }else if ($this->request->is("post")) {

        }
    }

    public function grades(){
        $data = ['title' => 'Grades'];
        if ($this->request->is("get")) {
            return view('admin/result_grade/grades',$data);
        }else if ($this->request->is("post")) {

        }
    }
}
