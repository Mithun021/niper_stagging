<?php

namespace App\Controllers;

use App\Models\Committee_model;

class CommitteeController extends BaseController
{
    public function committee_details(){
        $committee_model = new Committee_model();
        $data = ['title' => 'Committee Details'];
        if ($this->request->is("get")) {
            $data['committee'] = $committee_model->get();
            return view('admin/committee/committee-details',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $committee_photo = $this->request->getFile('Committeefileupload');
            if ($committee_photo->isValid() && ! $committee_photo->hasMoved()) {
                $committeeImageName = $committee_photo->getRandomName();
                $committee_photo->move(ROOTPATH . 'public/admin/uploads/committee', $committeeImageName);    
            }else{
                $committeeImageName = "";
            }

            $data =[
                'title' => $this->request->getPost('Committeetitle'),
                'sub_committee' => $this->request->getPost('subcommitteeid'),
                'description' => $this->request->getPost('description'),
                'upload_file' => $committeeImageName,
                'status' => $this->request->getPost('committee_status'),
                'start_date' => $this->request->getPost('comm_start_date'),
                'end_date' => $this->request->getPost('comm_end_date'),
                'upload_by' => $loggeduserId
            ];
            $result = $committee_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/committee-details')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/committee-details')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
        }
    }

    public function edit_committee_details($id){
        $committee_model = new Committee_model();
        $data = ['title' => 'Committee Details', 'comm_id' => $id];
        if ($this->request->is("get")) {
            $data['committee'] = $committee_model->get();
            $data['committee_data'] = $committee_model->get($id);
            return view('admin/committee/edit-committee-details',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $committee_data = $committee_model->get($id);
            $document = $this->request->getFile('Committeefileupload');
            $old_document_file = $committee_data['upload_file'];

            if (empty($old_document_file)) {
                if ($document->isValid() && !$document->hasMoved()) {
                    $document_name = $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/committee/', $document_name);
                } else {
                    $document_name = null;
                }
            } else {
                if ($document->isValid() && !$document->hasMoved()) {
                    if (file_exists("public/admin/uploads/committee/" . $old_document_file)) {
                        unlink("public/admin/uploads/committee/" . $old_document_file);
                    }
                    $document_name = $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/committee/', $document_name);
                } else {
                    $document_name = $old_document_file;
                }
            }

            $data =[
                'title' => $this->request->getPost('Committeetitle'),
                'sub_committee' => $this->request->getPost('subcommitteeid'),
                'description' => $this->request->getPost('description'),
                'upload_file' => $document_name,
                'status' => $this->request->getPost('committee_status'),
                'start_date' => $this->request->getPost('comm_start_date'),
                'end_date' => $this->request->getPost('comm_end_date'),
                'upload_by' => $loggeduserId
            ];
            $result = $committee_model->add($data, $id);
            if ($result === true) {
                return redirect()->to('admin/edit-committee-details/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/edit-committee-details/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }
}
