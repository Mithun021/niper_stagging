<?php

namespace App\Controllers;

class JobControllers extends BaseController
{
    public function job_category(){
        $data = ['title' => 'Job Category'];
        if ($this->request->is("get")) {
            return view('admin/jobs/job-category',$data);
        }else if ($this->request->is("post")) {

        }
    }
    public function job_details(){
        $data = ['title' => 'Job Details'];
        if ($this->request->is("get")) {
            return view('admin/jobs/job-details',$data);
        }else if ($this->request->is("post")) {

        }
    }
    public function job_result(){
        $data = ['title' => 'Job Result'];
        if ($this->request->is("get")) {
            return view('admin/jobs/job-result',$data);
        }else if ($this->request->is("post")) {

        }
    }
}
