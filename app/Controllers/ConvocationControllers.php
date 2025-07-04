<?php

namespace App\Controllers;

use App\Models\Convocation_model;
use App\Models\Convocation_session_model;

class ConvocationControllers extends BaseController
{
    public function convocation(){
        $convocation_session_model = new Convocation_session_model();
        $convocation_model = new Convocation_model();
        $data = ['title' => 'Convocation'];
        if ($this->request->is("get")) {
            $data['convocation'] = $convocation_model->get();
            return view('admin/convocation/convocation',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $conv_file = $this->request->getFile('upload_file');
            if ($conv_file->isValid() && ! $conv_file->hasMoved()) {
                $conv_fileNewName = rand(0,9999).$conv_file->getRandomName();
                $conv_file->move(ROOTPATH . 'public/admin/uploads/convocation', $conv_fileNewName);    
            }else{
                $conv_fileNewName = "";
            }
            $academic_start_year = $this->request->getPost('academic_start_year');
            $data = [
                'title' => $this->request->getPost('conv_title'),
                'upload_file' => $conv_fileNewName,
                'upload_by' => $loggeduserId
            ];

            $result = $convocation_model->add($data);
            if ($result === true) {
                $insertedId = $convocation_model->getInsertID();
                if (!empty($academic_start_year)) {
                    foreach ($academic_start_year as $key => $value) {
                        $data = [
                            'convocation_id' => $insertedId,
                            'session_start' => $value,
                            'session_end' => $this->request->getPost('academic_end_year')[$key]
                        ];
                        $convocation_session_model->add($data);
                    }
                }
                return redirect()->to('admin/convocation')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/convocation')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }

        }
    }

    public function edit_convocation($id){
        $convocation_session_model = new Convocation_session_model();
        $convocation_model = new Convocation_model();
        $data = ['title' => 'Convocation', 'convocation_id' => $id];
        if ($this->request->is("get")) {
            $data['convocation'] = $convocation_model->get();
            $data['convocation_data'] = $convocation_model->get($id);
            $data['convocation_session'] = $convocation_session_model->get_by_conv_id($id);
            return view('admin/convocation/edit-convocation',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $convocation_data = $convocation_model->get($id);
            $document = $this->request->getFile('upload_file');
            $old_document_file = $convocation_data['upload_file'];

            if (empty($old_document_file)) {
                if ($document->isValid() && !$document->hasMoved()) {
                    $document_name = rand(0,9999).$document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/convocation/', $document_name);
                } else {
                    $document_name = null;
                }
            } else {
                if ($document->isValid() && !$document->hasMoved()) {
                    if (file_exists("public/admin/uploads/convocation/" . $old_document_file)) {
                        unlink("public/admin/uploads/convocation/" . $old_document_file);
                    }
                    $document_name = rand(0,9999).$document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/convocation/', $document_name);
                } else {
                    $document_name = $old_document_file;
                }
            }

            $data = [
                'title' => $this->request->getPost('conv_title'),
                'upload_file' => $document_name,
                'upload_by' => $loggeduserId
            ];

            $result = $convocation_model->add($data, $id);
            if ($result === true) {
                return redirect()->to('admin/edit-convocation/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/edit-convocation/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }

        }
    }
    public function add_convocation_session($id){
        $convocation_session_model = new Convocation_session_model();
        $data = [
            'convocation_id' => $id,
            'session_start' => $this->request->getPost('academic_start_year'),
            'session_end' => $this->request->getPost('academic_end_year')
        ];
        $convocation_session_model->add($data);
        return redirect()->to('admin/edit-convocation/'.$id)->with('status','<div class="alert alert-success" role="alert"> Session Added Successful </div>');
    }

    public function delete_convocation($id){
        $convocation_model = new Convocation_model();
        $convocation_session_model = new Convocation_session_model();
        $convocation_data = $convocation_model->get($id);
        if ($convocation_data) {
            if (file_exists("public/admin/uploads/convocation/" . $convocation_data['upload_file'])) {
                unlink("public/admin/uploads/convocation/" . $convocation_data['upload_file']);
            }
            $result = $convocation_model->delete($id);
            if ($result) {
                $convocation_session_model->where('convocation_id', $id)->delete();
                return redirect()->to('admin/convocation')->with('status','<div class="alert alert-success" role="alert"> Data Deleted Successful </div>');
            } else {
                return redirect()->to('admin/convocation')->with('status','<div class="alert alert-danger" role="alert"> Data Not Deleted </div>');
            }
        } else {
            return redirect()->to('admin/convocation')->with('status','<div class="alert alert-danger" role="alert"> Convocation Not Found </div>');
        }
    }

}
