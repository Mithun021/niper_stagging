<?php

namespace App\Controllers;

use App\Models\Tendor_corrigendum_model;
use App\Models\Tendor_model;
use App\Models\Tendor_page_model;

class TendorControllers extends BaseController
{
    public function tendor_details(){
        $tendor_model = new Tendor_model();
        $data = ['title' => 'Tendor Details'];
        if ($this->request->is("get")) {
            $data['tendors'] = $tendor_model->get();
            return view('admin/tendor/tendor-details',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $tendor_file = $this->request->getFile('file_upload');
            if ($tendor_file->isValid() && ! $tendor_file->hasMoved()) {
                $tendor_fileNewName = "tendor".$tendor_file->getRandomName();
                $tendor_file->move(ROOTPATH . 'public/admin/uploads/tendor', $tendor_fileNewName);    
            }else{
                $tendor_fileNewName = "";
            }
            $data = [
                'tendor_title' => $this->request->getPost('tendor_title'),
                'tendor_description' => $this->request->getPost('tendor_description'),
                'tendor_ref_no' => $this->request->getPost('tendor_ref_no'),
                'bidding_date' => $this->request->getPost('bidding_date'),
                'bidding_time' => $this->request->getPost('bidding_time'),
                'tendor_start_date' => $this->request->getPost('tendor_start_date'),
                'tendor_start_time' => $this->request->getPost('tendor_start_time'),
                'tendor_end_date' => $this->request->getPost('tendor_end_date'),
                'tendor_end_time' => $this->request->getPost('tendor_end_time'),
                'upload_file' => $tendor_fileNewName,
                'tendor_status' => $this->request->getPost('tendor_status'),
                'marquee_status' => $this->request->getPost('marquee_status'),
                'status' => $this->request->getPost('status'),
                'upload_by' => $loggeduserId
            ];
            $result = $tendor_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/tendor-details')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/tendor-details')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function edit_tendor_details($id){
        $tendor_model = new Tendor_model();
        $data = ['title' => 'Tendor Details','tendor_id' => $id];
        if ($this->request->is("get")) {
            $data['tendors'] = $tendor_model->get();
            $data['tendors_data'] = $tendor_model->get($id);
            return view('admin/tendor/edit-tendor-details',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $tendors_data = $tendor_model->get($id);
            $document = $this->request->getFile('file_upload');
            $old_document_file = $tendors_data['upload_file'];

            if (empty($old_document_file)) {
                if ($document->isValid() && !$document->hasMoved()) {
                    $document_name = "tendor" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/tendor/', $document_name);
                } else {
                    $document_name = null;
                }
            } else {
                if ($document->isValid() && !$document->hasMoved()) {
                    if (file_exists("public/admin/uploads/tendor/" . $old_document_file)) {
                        unlink("public/admin/uploads/tendor/" . $old_document_file);
                    }
                    $document_name = "tendor" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/tendor/', $document_name);
                } else {
                    $document_name = $old_document_file;
                }
            }

            $data = [
                'tendor_title' => $this->request->getPost('tendor_title'),
                'tendor_description' => $this->request->getPost('tendor_description'),
                'tendor_ref_no' => $this->request->getPost('tendor_ref_no'),
                'bidding_date' => $this->request->getPost('bidding_date'),
                'bidding_time' => $this->request->getPost('bidding_time'),
                'tendor_start_date' => $this->request->getPost('tendor_start_date'),
                'tendor_start_time' => $this->request->getPost('tendor_start_time'),
                'tendor_end_date' => $this->request->getPost('tendor_end_date'),
                'tendor_end_time' => $this->request->getPost('tendor_end_time'),
                'upload_file' => $document_name,
                'tendor_status' => $this->request->getPost('tendor_status'),
                'marquee_status' => $this->request->getPost('marquee_status'),
                'status' => $this->request->getPost('status'),
                'upload_by' => $loggeduserId
            ];
            $result = $tendor_model->add($data, $id);
            if ($result === true) {
                return redirect()->to('admin/edit-tendor-details/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/edit-tendor-details/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function delete_tendor_details($id){
        $tendor_model = new Tendor_model();
        $tendors_data = $tendor_model->get($id);
        $old_document_file = $tendors_data['upload_file'];
        $file_path = "public/admin/uploads/tendor/" . $old_document_file;
        if (!empty($old_document_file) && file_exists($file_path) && is_file($file_path)) {
            unlink($file_path);
        }
        $result = $tendor_model->delete($id);
        if ($result === true) {
            return redirect()->to('admin/tendor-details')->with('status','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/tendor-details')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
        }
    }

    public function tendor_page(){
        $tendor_model = new Tendor_model();
        $tendor_page_model= new Tendor_page_model();
        $data = ['title' => 'Tendor Page'];
        if ($this->request->is("get")) {
            $data['tendors'] = $tendor_model->get();
            $data['tendors_page'] = $tendor_page_model->get();
            return view('admin/tendor/tendor-page',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $tendor_file = $this->request->getFile('file_upload');
            if ($tendor_file->isValid() && ! $tendor_file->hasMoved()) {
                $tendor_fileNewName = "page".$tendor_file->getRandomName();
                $tendor_file->move(ROOTPATH . 'public/admin/uploads/tendor', $tendor_fileNewName);    
            }else{
                $tendor_fileNewName = "";
            }
            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'file_upload_description' => $this->request->getPost('file_description'),
                'file_upload' => $tendor_fileNewName,
                'upload_by' => $loggeduserId
            ];
            $result = $tendor_page_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/tendor-page')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/tendor-page')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function edit_tendor_page($id){
        $tendor_model = new Tendor_model();
        $tendor_page_model= new Tendor_page_model();
        $data = ['title' => 'Tendor Page'];
        if ($this->request->is("get")) {
            $data['tendors'] = $tendor_model->get();
            $data['tendors_page'] = $tendor_page_model->get();
            $data['tendors_page_data'] = $tendor_page_model->get($id);
            return view('admin/tendor/edit-tendor-page',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $tendors_page_data = $tendor_page_model->get($id);
            $document = $this->request->getFile('file_upload');
            $old_document_file = $tendors_page_data['file_upload'];

            if (empty($old_document_file)) {
                if ($document->isValid() && !$document->hasMoved()) {
                    $document_name = "page" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/tendor/', $document_name);
                } else {
                    $document_name = null;
                }
            } else {
                if ($document->isValid() && !$document->hasMoved()) {
                    if (file_exists("public/admin/uploads/tendor/" . $old_document_file)) {
                        unlink("public/admin/uploads/tendor/" . $old_document_file);
                    }
                    $document_name = "page" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/tendor/', $document_name);
                } else {
                    $document_name = $old_document_file;
                }
            }

            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'file_upload_description' => $this->request->getPost('file_description'),
                'file_upload' => $document_name,
                'upload_by' => $loggeduserId
            ];
            $result = $tendor_page_model->add($data, $id);
            if ($result === true) {
                return redirect()->to('admin/edit-tendor-page/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/edit-tendor-page/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function tendor_corrigendum(){
        $tendor_model = new Tendor_model();
        $tendor_corrigendum_model = new Tendor_corrigendum_model();
        $data = ['title' => 'Tendor corrigendum('];
        if ($this->request->is("get")) {
            $data['tendors'] = $tendor_model->get();
            $data['tendor_corrigendum'] = $tendor_corrigendum_model->get();
            return view('admin/tendor/tendor-corrigendum',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $tendor_file = $this->request->getFile('file_upload');
            if ($tendor_file->isValid() && ! $tendor_file->hasMoved()) {
                $tendor_fileNewName = "corrigendum".$tendor_file->getRandomName();
                $tendor_file->move(ROOTPATH . 'public/admin/uploads/tendor', $tendor_fileNewName);    
            }else{
                $tendor_fileNewName = "";
            }
            
            $data = [
                'tendor_id' => $this->request->getPost('tendor_id'),
                'corrigendum_number' => $this->request->getPost('corrigendum_number'),
                'corrigendum_date' => $this->request->getPost('corrigendum_date'),
                'file_decription' => $this->request->getPost('file_description'),
                'upload_file' => $tendor_fileNewName,
                'upload_by' => $loggeduserId
            ];
            $result = $tendor_corrigendum_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/tendor-corrigendum')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/tendor-corrigendum')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

}
