<?php

namespace App\Controllers;

class ResultGradeControllers extends BaseController
{
    public function result(){
        $data = ['title' => 'Result'];
        if ($this->request->is("get")) {
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
