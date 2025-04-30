<?php

namespace App\Controllers;

class AluminiController extends BaseController
{
    public function alumini_page_notification()
    {
        $data = ['title' => 'Page Notification Details'];
        if($this->request->is('get')) {
            return view('admin/alumini/alumini-page-notification',$data);
        } else if($this->request->is('post')){
            
        }
    }
    public function alumini_page_section()
    {
        $data = ['title' => 'Page Section Details'];
        if($this->request->is('get')) {
            return view('admin/alumini/alumini-page-section',$data);
        } else if($this->request->is('post')){
            
        }
    }

    public function alumini_page_gallery()
    {
        $data = ['title' => 'Page Image Gallery'];
        if($this->request->is('get')) {
            return view('admin/alumini/alumini-page-gallery',$data);
        } else if($this->request->is('post')){
            
        }
    }
    public function alumini_page_video()
    {
        $data = ['title' => '>Page Video Gallery'];
        if($this->request->is('get')) {
            return view('admin/alumini/alumini-page-video',$data);
        } else if($this->request->is('post')){
            
        }
    }
    public function alumini_education_detail()
    {
        $data = ['title' => 'Alumni Education Details'];
        if($this->request->is('get')) {
            return view('admin/alumini/alumini-education-detail',$data);
        } else if($this->request->is('post')){
            
        }
    }
    public function alumini_job_details()
    {
        $data = ['title' => 'Alumni Job Details'];
        if($this->request->is('get')) {
            return view('admin/alumini/alumini-job-details',$data);
        } else if($this->request->is('post')){
            
        }
    }
    
}