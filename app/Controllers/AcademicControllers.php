<?php

namespace App\Controllers;

class AcademicControllers extends BaseController
{
    public function academic_details(){
        $data = ['title' => 'Academic Details'];
        if ($this->request->is("get")) {
            return view('admin/academics/academic-details',$data);
        }else if ($this->request->is("post")) {

        }
    }

    public function accouncement(){
        $data = ['title' => 'Accouncement'];
        if ($this->request->is("get")) {
            return view('admin/academics/accouncement',$data);
        }else if ($this->request->is("post")) {

        }
    }

    public function rules_regulations(){
        $data = ['title' => 'Rules & Regulations'];
        if ($this->request->is("get")) {
            return view('admin/academics/rules-regulations',$data);
        }else if ($this->request->is("post")) {

        }
    }

    public function research_publication(){
        $data = ['title' => 'Research Publication'];
        if ($this->request->is("get")) {
            return view('admin/academics/research-publication',$data);
        }else if ($this->request->is("post")) {

        }
    }

}
