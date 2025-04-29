<?php

namespace App\Controllers;

class PlacementController extends BaseController
{
    public function company_details()
    {
        $data = ['title' => 'Company Details'];
        if($this->request->is('get')) {
            return view('admin/placement/company-details',$data);
        } else if($this->request->is('post')){
            
        }
    }

    public function company_contact_person()
    {
        $data = ['title' => 'Company Contact Person'];
        if($this->request->is('get')) {
            return view('admin/placement/company-contact-person',$data);
        } else if($this->request->is('post')){
            
        }
    }

    public function job_details()
    {
        $data = ['title' => 'Job Details'];
        if($this->request->is('get')) {
            return view('admin/placement/job-details',$data);
        } else if($this->request->is('post')){
            
        }
    }

    public function result_details()
    {
        $data = ['title' => 'Result Details'];
        if($this->request->is('get')) {
            return view('admin/placement/result-details',$data);
        } else if($this->request->is('post')){
            
        }
    }

    public function job_student_mapping()
    {
        $data = ['title' => 'Job Student Mapping'];
        if($this->request->is('get')) {
            return view('admin/placement/job-student-mapping',$data);
        } else if($this->request->is('post')){
            
        }
    }

    public function job_result_stage_mapping()
    {
        $data = ['title' => 'Job Result Stage Mapping'];
        if($this->request->is('get')) {
            return view('admin/placement/job-result-stage-mapping',$data);
        } else if($this->request->is('post')){
            
        }
    }

    public function student_result_mapping()
    {
        $data = ['title' => 'Student Result Mapping'];
        if($this->request->is('get')) {
            return view('admin/placement/student-result-mapping',$data);
        } else if($this->request->is('post')){
            
        }
    }

    public function page_notification_details()
    {
        $data = ['title' => 'Page Notification Details'];
        if($this->request->is('get')) {
            return view('admin/placement/page-notification-details',$data);
        } else if($this->request->is('post')){
            
        }
    }

    public function page_section_details()
    {
        $data = ['title' => 'Page Section Details'];
        if($this->request->is('get')) {
            return view('admin/placement/page-section-details',$data);
        } else if($this->request->is('post')){
            
        }
    }

    public function page_gallery()
    {
        $data = ['title' => 'Page Gallery'];
        if($this->request->is('get')) {
            return view('admin/placement/page-gallery',$data);
        } else if($this->request->is('post')){
            
        }
    }


}
