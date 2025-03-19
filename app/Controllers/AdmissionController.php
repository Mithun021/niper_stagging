<?php

namespace App\Controllers;

class AdmissionController extends BaseController
{
    public function admission_page(){
        $data = ['title' => 'Facility Section File'];
        if ($this->request->is("get")) {
            return view('admin/admission/admission-page',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }else{
                return redirect()->to(base_url('admin/login'));
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
