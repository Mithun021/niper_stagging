<?php

namespace App\Controllers;

use App\Models\Form_details_model;
use App\Models\Form_section_model;
use App\Models\Manage_question_model;
use App\Models\Question_type_model;

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
        $form_details_model = new Form_details_model();
        $form_section_model = new Form_section_model();
        $data = ['title' => 'Form Section'];
        if ($this->request->is("get")) {
            $data['form_details'] = $form_details_model->get();
            $data['form_section'] = $form_section_model->get();
            return view('admin/dymanic_form/form-section',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $data = [
                'form_detail_id' => $this->request->getPost('form_detail_id'),
                'name' => $this->request->getPost('section_name'),
                'description' => $this->request->getPost('description'),
                'upload_by' => $loggeduserId,
                
            ];
            $result = $form_section_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/form-section')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/form-section')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function question_type(){
       $question_type_model =  new Question_type_model();
        $data = ['title' => 'Question Type'];
        if ($this->request->is("get")) {
            $data['question'] = $question_type_model->get();
            return view('admin/dymanic_form/question-type',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }

            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'status' => $this->request->getPost('status'),
                'upload_by' => $loggeduserId,
            ];
            $result = $question_type_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/question-type')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/question-type')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function manage_questions($form_id){
        $question_type_model = new Question_type_model();
        $manage_question_model = new Manage_question_model();
        $data = ['title' => 'Manage Questions','form_id' => $form_id];
        if ($this->request->is("get")) {
            $data['question'] = $question_type_model->getActiveQuestion();
            $data['question_details'] = $question_type_model->get($form_id);
            $data['manage_question'] = $manage_question_model->getBYformId($form_id);
            return view('admin/dymanic_form/manage-questions',$data);
        }else if ($this->request->is("post")) {
            $data = [
                'form_section_id' => $form_id,
                'question_type' => $this->request->getPost('question_type'),
                'question_details_id' => implode(",",  $this->request->getPost('question_details')),
            ];
            $result = $manage_question_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/manage-questions/'.$form_id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/manage-questions/'.$form_id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }


}
