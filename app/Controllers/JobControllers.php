<?php

namespace App\Controllers;

use App\Models\Department_model;
use App\Models\Job_category_model;
use App\Models\Job_detail_model;
use App\Models\Job_result_model;

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
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $ext_notice_file = $this->request->getFile('ext_notice_file');
            if ($ext_notice_file->isValid() && ! $ext_notice_file->hasMoved()) {
                $ext_notice_fileImageName = "ext".$ext_notice_file->getRandomName();
                $ext_notice_file->move(ROOTPATH . 'public/admin/uploads/jobs', $ext_notice_fileImageName);    
            }else{
                $ext_notice_fileImageName = "";
            }

            $adv_file = $this->request->getFile('adv_file');
            if ($adv_file->isValid() && ! $adv_file->hasMoved()) {
                $adv_fileImageName = "adv".$adv_file->getRandomName();
                $adv_file->move(ROOTPATH . 'public/admin/uploads/jobs', $adv_fileImageName);    
            }else{
                $adv_fileImageName = "";
            }

            $syllabus_file = $this->request->getFile('syllabus_file');
            if ($syllabus_file->isValid() && ! $syllabus_file->hasMoved()) {
                $syllabus_fileImageName = "syllabus".$syllabus_file->getRandomName();
                $syllabus_file->move(ROOTPATH . 'public/admin/uploads/jobs', $syllabus_fileImageName);    
            }else{
                $syllabus_fileImageName = "";
            }

            $data =[
                'title' => $this->request->getPost('job_title'),
                'description' => $this->request->getPost('description'),
                'adv_reference_no' => $this->request->getPost('reference_no'),
                'adv_apply_link' => $this->request->getPost('apply_link'),
                'job_type_id' => $this->request->getPost('adv_type'),
                'department_id' => $this->request->getPost('department'),
                'application_start_date' => $this->request->getPost('application_start_date'),
                'application_start_time' => $this->request->getPost('application_start_time'),
                'application_end_date' => $this->request->getPost('application_end_date'),
                'application_end_time' => $this->request->getPost('application_end_time'),
                'hardcopy_last_date' => $this->request->getPost('hardcopy_last_date'),
                'hardcopy_last_time' => $this->request->getPost('hardcopy_last_time'),
                'ext_notice_title' => $this->request->getPost('ext_notice_title'),
                'ext_notice_file' => $ext_notice_fileImageName,
                'revised_app_last_date' => $this->request->getPost('revised_app_last_date'),
                'revised_app_last_time' => $this->request->getPost('revised_app_last_time'),
                'revised_copy_last_date' => $this->request->getPost('revised_copy_last_date'),
                'revised_copy_last_time' => $this->request->getPost('revised_copy_last_time'),
                'payment_link' => $this->request->getPost('payment_link'),
                'adv_file' => $adv_fileImageName,
                'syllabus_file' => $syllabus_fileImageName,
                'status' => $this->request->getPost('status'),
                'upload_by' => $loggeduserId
            ];
            $result = $job_detail_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/job-details')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/job-details')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }
    public function job_result(){
        $job_detail_model = new Job_detail_model();
        $job_result_model = new Job_result_model();
        $data = ['title' => 'Job Result'];
        if ($this->request->is("get")) {
            $data['job_details'] = $job_detail_model->get();
            $data['job_result'] = $job_result_model->get();
            return view('admin/jobs/job-result',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $resultfile = $this->request->getFile('resultfile');
            if ($resultfile->isValid() && ! $resultfile->hasMoved()) {
                $resultfileImageName = "ext".$resultfile->getRandomName();
                $resultfile->move(ROOTPATH . 'public/admin/uploads/jobs', $resultfileImageName);    
            }else{
                $resultfileImageName = "";
            }

            $data = [
                'jobs_id' => $this->request->getPost('resultitle'),
                'result_title' => $this->request->getPost('resultdesc'),
                'result_description' => $this->request->getPost(''),
                'file_upload' => $resultfileImageName,
                'result_type' => $this->request->getPost('resulttype'),
                'status' => $this->request->getPost('result_status'),
                'upload_by' => $loggeduserId
            ];
            $result = $job_result_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/job-result')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/job-result')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }
}
