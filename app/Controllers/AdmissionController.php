<?php

namespace App\Controllers;

use App\Models\Admission_page_model;

class AdmissionController extends BaseController
{
    public function admission_page(){
        $admission_page_model = new Admission_page_model();
        $data = ['title' => 'Admission Page'];
        if ($this->request->is("get")) {
            $data['admission'] = $admission_page_model->get();
            return view('admin/admission/admission-page',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }else{
                return redirect()->to(base_url('admin/login'));
            }
            $userPhoto = $this->request->getFile('banner_image');
            if ($userPhoto->isValid() && ! $userPhoto->hasMoved()) {
                $userPhotoImageName = "page".$userPhoto->getRandomName();
                $userPhoto->move(ROOTPATH . 'public/admin/uploads/admission', $userPhotoImageName);    
            }else{
                $userPhotoImageName = "";
            }

            $data =[
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'banner_image' => $userPhotoImageName,
                'upload_by' => $loggeduserId,
            ];
            $result = $admission_page_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/admission-page')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/admission-page')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }


        }
    }

    public function admission_page_section(){
        $data = ['title' => 'Admission Page Section'];
        if ($this->request->is("get")) {
            return view('admin/admission/admission-page-section',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }else{
                return redirect()->to(base_url('admin/login'));
            }
        }
    }

    public function admission_section_image(){
        $data = ['title' => 'Admission Section Image'];
        if ($this->request->is("get")) {
            return view('admin/admission/admission-section-image',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }else{
                return redirect()->to(base_url('admin/login'));
            }
        }
    }

    public function admission_section_file(){
        $data = ['title' => 'Admission Section File'];
        if ($this->request->is("get")) {
            return view('admin/admission/admission-section-file',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }else{
                return redirect()->to(base_url('admin/login'));
            }
        }
    }
}
