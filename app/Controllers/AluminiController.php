<?php

namespace App\Controllers;

use App\Models\Alumini_page_notification_model;

class AluminiController extends BaseController
{
    public function alumini_page_notification(){
        $alumini_page_notification_model = new Alumini_page_notification_model();
        $data = ['title' => 'Page Notification Details'];
        if($this->request->is('get')) {
            $data['notification'] = $alumini_page_notification_model->get();
            return view('admin/alumini/alumini-page-notification',$data);
        } else if($this->request->is('post')){
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $file = $this->request->getFile('file_upload');
            if ($file->isValid() && ! $file->hasMoved()) {
                $fileNewName = "notify".$file->getRandomName();
                $file->move(ROOTPATH . 'public/admin/uploads/alumini', $fileNewName);    
            }else{
                $fileNewName = "";
            }
            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'marquee' => $this->request->getPost('marquee') ?? 0,
                'file_upload' => $fileNewName,
                'upload_by' => $loggeduserId
            ];
            $result = $alumini_page_notification_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/alumini-page-notification')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/alumini-page-notification')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function delete_alumini_page_notification($id){
        $alumini_page_notification_model = new Alumini_page_notification_model();
        $aluminiData = $alumini_page_notification_model->get($id);
        if ($aluminiData) {
            if (file_exists("public/admin/uploads/alumini/" . $aluminiData['file_upload'])) {
                unlink("public/admin/uploads/alumini/" . $aluminiData['file_upload']);
            }
            $result = $alumini_page_notification_model->delete($id);
            if ($result === true) {
                return redirect()->to('admin/alumini-page-notification')->with('status', '<div class="alert alert-success" role="alert">Data deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('admin/alumini-page-notification')->with('status', '<div class="alert alert-danger" role="alert">Data not found.</div>');
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