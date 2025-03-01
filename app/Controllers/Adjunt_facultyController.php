<?php

namespace App\Controllers;

use App\Models\Adjunt_other_faculty_model;
use App\Models\Designation_model;

class Adjunt_facultyController extends BaseController
{
    public function other_faculty()
    {
        $designation_model = new Designation_model();
        $adjunt_other_faculty_model = new Adjunt_other_faculty_model();
        $data = ['title' => 'Other Facuty Details'];
        if ($this->request->is("get")) {
            $data['designation'] = $designation_model->get();
            return view('admin/adjunt_faculty/other-faculty',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }

            $photo = $this->request->getFile('photo');
            if ($photo->isValid() && ! $photo->hasMoved()) {
                $photoNewName = "file".$photo->getRandomName();
                $photo->move(ROOTPATH . 'public/admin/uploads/adjunt_faculty', $photoNewName);    
            }else{
                $photoNewName = "";
            }

            $resume = $this->request->getFile('resume');
            if ($resume->isValid() && ! $resume->hasMoved()) {
                $resumeNewName = "file".$resume->getRandomName();
                $resume->move(ROOTPATH . 'public/admin/uploads/adjunt_faculty', $resumeNewName);    
            }else{
                $resumeNewName = "";
            }

            $data = [
                'annotation' => $this->request->getPost('annotation'),
                'first_name' => $this->request->getPost('first_name'),
                'middle_name' => $this->request->getPost('middle_name'),
                'last_name' => $this->request->getPost('last_name'),
                'designation' => $this->request->getPost('designation'),
                'organisation_name' => $this->request->getPost('organisation_name'),
                'organisation_address' => $this->request->getPost('organisation_address'),
                'personal_email' => $this->request->getPost('personal_email'),
                'official_email' => $this->request->getPost('official_email'),
                'mobile' => $this->request->getPost('mobile'),
                'linkedin' => $this->request->getPost('linkedin'),
                'twitter' => $this->request->getPost('twitter'),
                'facebook' => $this->request->getPost('facebook'),
                'research_interest' => $this->request->getPost('research_interest'),
                'description' => $this->request->getPost('description'),
                'photo' => $photoNewName,
                'resume' => $resumeNewName,
                'faculty_type' => $this->request->getPost('faculty_type'),
                'status' => $this->request->getPost('status'),
                'upload_by' => $loggeduserId
            ];

            $result = $adjunt_other_faculty_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/other-faculty')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/other-faculty')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }

        }
    }

    public function adjunt_faculty_webpage()
    {
        $data = ['title' => 'Adjunt Facuty Webpage'];
        if ($this->request->is("get")) {
            return view('admin/adjunt_faculty/adjunt-faculty-webpage',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
        }
    }

    public function adjunt_faculty_notification()
    {
        $data = ['title' => 'Adjunt Facuty Notification'];
        if ($this->request->is("get")) {
            return view('admin/adjunt_faculty/adjunt-faculty-notification',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
        }
    }

    public function adjunt_faculty_video()
    {
        $data = ['title' => 'Adjunt Facuty Video'];
        if ($this->request->is("get")) {
            return view('admin/adjunt_faculty/adjunt-faculty-video',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
        }
    }
}
