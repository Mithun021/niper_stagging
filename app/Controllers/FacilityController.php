<?php

namespace App\Controllers;

use App\Models\Department_model;
use App\Models\Facility_banner_model;
use App\Models\Facility_instruments_model;
use App\Models\Facility_notification_model;
use App\Models\Facility_page_model;
use App\Models\Facility_section_file_model;
use App\Models\Facility_section_image_model;
use App\Models\Facility_section_model;
use App\Models\Facility_services_model;

class FacilityController extends BaseController
{
    public function facility_page(){
        $department_model = new Department_model();
        $facility_page_model = new Facility_page_model();
        $data = ['title' => 'Facility Page'];
        if ($this->request->is("get")) {
            $data['departments'] = $department_model->get();
            $data['facility_page'] = $facility_page_model->get();
            return view('admin/facility/facility-page',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }else{
                return redirect()->to(base_url('admin/login'));
            }

            $data =[
                'name' => $this->request->getVar('name'),
                'description' => $this->request->getVar('description'),
                'department_id' => $this->request->getVar('department_id'),
                'status' => $this->request->getVar('status'),
                'upload_by' => $loggeduserId
            ];
            $result = $facility_page_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/facility-page')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/facility-page')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function edit_facility_page($id){
        $facility_page_model = new Facility_page_model();
        $data = ['title' => 'Facility Page','facilty_page_id' => $id];
        $data['facility_page_detail'] = $facility_page_model->get($id);
        if ($this->request->is("get")) {
            $data['facility_page'] = $facility_page_model->get();
            return view('admin/facility/edit-facility-page',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }else{
                return redirect()->to(base_url('admin/login'));
            }

            $data =[
                'name' => $this->request->getVar('name'),
                'description' => $this->request->getVar('description'),
                'status' => $this->request->getVar('status'),
                'upload_by' => $loggeduserId
            ];
            $result = $facility_page_model->add($data,$id);
            if ($result === true) {
                return redirect()->to('admin/edit-facility-page/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/edit-facility-page/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function delete_facility_page($id){
        $facility_page_model = new Facility_page_model();
        $result = $facility_page_model->delete($id);
        if ($result === true) {
            return redirect()->to('admin/facility-page')->with('status','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/facility-page')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
        }
    }

    public function facilty_services(){
        $facility_page_model = new Facility_page_model();
        $facility_services_model = new Facility_services_model();
        $data = ['title' => 'Facility Services'];
        if ($this->request->is("get")) {
            $data['facility_page'] = $facility_page_model->get();
            $data['facility_services'] = $facility_services_model->get();
            return view('admin/facility/facilty-services',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }else{
                return redirect()->to(base_url('admin/login'));
            }
            $userPhoto = $this->request->getFile('upload_photo');
            if ($userPhoto->isValid() && ! $userPhoto->hasMoved()) {
                $userPhotoImageName = "service".$userPhoto->getRandomName();
                $userPhoto->move(ROOTPATH . 'public/admin/uploads/facilities', $userPhotoImageName);    
            }else{
                $userPhotoImageName = "";
            }

            $data =[
                'facility_id' => $this->request->getVar('facility_id'),
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'upload_file' => $userPhotoImageName,
                'upload_by' => $loggeduserId,
            ];
            $result = $facility_services_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/facilty-services')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/facilty-services')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }
    public function facility_notification(){
        $facility_page_model = new Facility_page_model();
        $facility_notification_model = new Facility_notification_model();
        $data = ['title' => 'Facility Notification'];
        if ($this->request->is("get")) {
            $data['facility_page'] = $facility_page_model->get();
            $data['facility_notification'] = $facility_notification_model->get();
            return view('admin/facility/facility-notification',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }else{
                return redirect()->to(base_url('admin/login'));
            }
            $data = [
                'facility_id' => $this->request->getVar('facility_id'),
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'puslish_date' => $this->request->getVar('publish_date'),
                'upload_by' => $loggeduserId,
            ];
            $result = $facility_notification_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/facility-notification')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/facility-notification')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function facility_banner(){
        $facility_page_model = new Facility_page_model();
        $facility_banner_model = new Facility_banner_model();
        $data = ['title' => 'Facility Banner'];
        if ($this->request->is("get")) {
            $data['facility_page'] = $facility_page_model->get();
            $data['facility_banner'] = $facility_banner_model->get();
            return view('admin/facility/facility-banner',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }else{
                return redirect()->to(base_url('admin/login'));
            }
            $gallery_file = $this->request->getFiles();
            if ($gallery_file) {
                foreach ($gallery_file['gallery_file'] as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $newName = "banner".$file->getRandomName();
                        $file->move(ROOTPATH . 'public/admin/uploads/facilities', $newName);
            
                        $data = [
                            'facility_id' => $this->request->getPost('facility_id'),
                            'upload_file' => $newName,
                            'upload_by' => $loggeduserId,
                        ];
            
                        $result = $facility_banner_model->save($data);
                    }
                }
            }
            if ($result === true) {
                return redirect()->to('admin/facility-banner')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/facility-banner')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function facility_instruments(){
        $facility_page_model = new Facility_page_model();
        $facility_instruments_model = new Facility_instruments_model();
        $data = ['title' => 'Facility Instruments'];
        if ($this->request->is("get")) {
            $data['facility_page'] = $facility_page_model->get();
            $data['facility_instruments'] = $facility_instruments_model->get();
            return view('admin/facility/facility-instruments',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }else{
                return redirect()->to(base_url('admin/login'));
            }

            $userPhoto = $this->request->getFile('upload_photo');
            if ($userPhoto->isValid() && ! $userPhoto->hasMoved()) {
                $userPhotoImageName = "instrument".$userPhoto->getRandomName();
                $userPhoto->move(ROOTPATH . 'public/admin/uploads/facilities', $userPhotoImageName);    
            }else{
                $userPhotoImageName = "";
            }

            $data =[
                'facility_id' => $this->request->getVar('facility_id'),
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'upload_file' => $userPhotoImageName,
                'upload_by' => $loggeduserId,
            ];
            $result = $facility_instruments_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/facility-instruments')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/facility-instruments')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function facility_section(){
        $facility_page_model = new Facility_page_model();
        $facility_section_model = new Facility_section_model();
        $data = ['title' => 'Facility Section'];
        if ($this->request->is("get")) {
            $data['facility_page'] = $facility_page_model->get();
            $data['facility_section'] = $facility_section_model->get();
            return view('admin/facility/facility-section',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }else{
                return redirect()->to(base_url('admin/login'));
            }
            $data =[
                'facility_id' => $this->request->getVar('facility_id'),
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'priority' => $this->request->getVar('priority'),
                'upload_by' => $loggeduserId,
            ];
            $result = $facility_section_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/facility-section')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/facility-section')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function facility_section_file(){
        $facility_section_file_model = new Facility_section_file_model();
        $facility_page_model = new Facility_page_model();
        $data = ['title' => 'Facility Section File'];
        if ($this->request->is("get")) {
            $data['facility_page'] = $facility_page_model->get();
            $data['facility_section_file'] = $facility_section_file_model->get();
            return view('admin/facility/facility-section-file',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }else{
                return redirect()->to(base_url('admin/login'));
            }
            $userPhoto = $this->request->getFile('upload_file');
            if ($userPhoto->isValid() && ! $userPhoto->hasMoved()) {
                $userPhotoImageName = "section_file".$userPhoto->getRandomName();
                $userPhoto->move(ROOTPATH . 'public/admin/uploads/facilities', $userPhotoImageName);    
            }else{
                $userPhotoImageName = "";
            }

            $data =[
                'facility_id' => $this->request->getVar('facility_id'),
                'section_id' => $this->request->getVar('section_id'),
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'upload_file' => $userPhotoImageName,
                'upload_by' => $loggeduserId,
            ];
            $result = $facility_section_file_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/facility-section-file')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/facility-section-file')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function facility_section_image(){
        $facility_section_image_model = new Facility_section_image_model();
        $facility_page_model = new Facility_page_model();
        $data = ['title' => 'Facility Section Image'];
        if ($this->request->is("get")) {
            $data['facility_page'] = $facility_page_model->get();
            $data['facility_section_image'] = $facility_section_image_model->get();
            return view('admin/facility/facility-section-image',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }else{
                return redirect()->to(base_url('admin/login'));
            }

            $userPhoto = $this->request->getFile('upload_file');
            if ($userPhoto->isValid() && ! $userPhoto->hasMoved()) {
                $userPhotoImageName = "section_image".$userPhoto->getRandomName();
                $userPhoto->move(ROOTPATH . 'public/admin/uploads/facilities', $userPhotoImageName);    
            }else{
                $userPhotoImageName = "";
            }

            $data =[
                'facility_id' => $this->request->getVar('facility_id'),
                'section_id' => $this->request->getVar('section_id'),
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'upload_file' => $userPhotoImageName,
                'gallery' => $this->request->getVar('gallery') ?? '',
                'carousal' => $this->request->getVar('carousal') ?? '',
                'upload_by' => $loggeduserId,
            ];
            $result = $facility_section_image_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/facility-section-image')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/facility-section-image')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    
}
