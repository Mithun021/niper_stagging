<?php

namespace App\Controllers;

use App\Models\Form_details_model;

class DynamicformControllers extends BaseController
{
    public function form_details(){
        $form_details_model = new Form_details_model();
        $data = ['title' => 'Form Details'];
        if ($this->request->is("get")) {
            $data['form_details'] = $form_details_model->get();
            return view('admin/dymanic_form/form-details',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $upload_file = $this->request->getFile('upload_file');
            if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                $upload_fileNewName = 'photo_' .$upload_file->getRandomName();
                $upload_file->move(ROOTPATH . 'public/admin/uploads/dynamicForm', $upload_fileNewName);    
            }else{
                $upload_fileNewName = "";
            }

            $data = [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'publish_date' => $this->request->getPost('publish_date'),
                'status' => $this->request->getPost('status'),
                'upload_file' => $upload_fileNewName,
                'upload_by' => $loggeduserId,
            ];
            $result = $form_details_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/form-details')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/form-details')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function form_section(){
        $data = ['title' => 'Form Section'];
        if ($this->request->is("get")) {
            return view('admin/dymanic_form/form-section',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
        }
    }
}
