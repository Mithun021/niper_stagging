<?php

namespace App\Controllers;

use App\Models\Department_model;
use App\Models\Job_category_model;
use App\Models\Job_detail_model;

class JobControllers extends BaseController
{
    public function job_category(){
        $job_category_model = new Job_category_model();
        $data = ['title' => 'Job Category'];
        if ($this->request->is("get")) {
            $data['job_category'] = $job_category_model->get();
            return view('admin/jobs/job-category',$data);
        }else if ($this->request->is("post")) {
            $data =[
                'name' => $this->request->getPost('category_name'),
            ];
            $result = $job_category_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/job-category')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/job-category')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }
    public function job_details(){
        $department_model = new Department_model();
        $job_category_model = new Job_category_model();
        $job_detail_model = new Job_detail_model();
        $data = ['title' => 'Job Details'];
        if ($this->request->is("get")) {
            $data['department'] = $department_model->activeData();
            $data['job_category'] = $job_category_model->get();
            $data['job_details'] = $job_detail_model->get();
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
