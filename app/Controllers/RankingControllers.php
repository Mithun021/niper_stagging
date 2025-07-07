<?php

namespace App\Controllers;

use App\Models\Ranking_model;

class RankingControllers extends BaseController
{
    public function ranking(){
        $ranking_model = new Ranking_model();
        $data = ['title' => 'Ranking'];
        if ($this->request->is("get")) {
            $data['ranking'] = $ranking_model->get();
            return view('admin/ranking/ranking',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $ranking_file = $this->request->getFile('upload_file');
            if ($ranking_file->isValid() && ! $ranking_file->hasMoved()) {
                $ranking_fileNewName = rand(0,9999).$ranking_file->getRandomName();
                $ranking_file->move(ROOTPATH . 'public/admin/uploads/ranking', $ranking_fileNewName);    
            }else{
                $ranking_fileNewName = "";
            }

            $data_submitted_file = $this->request->getFile('data_submitted_file');
            if ($data_submitted_file->isValid() && ! $data_submitted_file->hasMoved()) {
                $data_submitted_fileNewName = "submitted".$data_submitted_file->getRandomName();
                $data_submitted_file->move(ROOTPATH . 'public/admin/uploads/ranking', $data_submitted_fileNewName);    
            }else{
                $data_submitted_fileNewName = "";
            }
            $data_submitted_overall_file = $this->request->getFile('data_submitted_overall_file');
            if ($data_submitted_overall_file->isValid() && ! $data_submitted_overall_file->hasMoved()) {
                $data_submitted_overall_fileNewName = "overall".$data_submitted_overall_file->getRandomName();
                $data_submitted_overall_file->move(ROOTPATH . 'public/admin/uploads/ranking', $data_submitted_overall_fileNewName);    
            }else{
                $data_submitted_overall_fileNewName = "";
            }

            $data = [
                'ranking_type' => $this->request->getPost('ranking_type'),
                'other_ranking' => $this->request->getPost('other_ranking'),
                'description' => $this->request->getPost('description'),
                'ranking_year' => $this->request->getPost('ranking_year'),
                'ranking_category' => $this->request->getPost('ranking_category'),
                'other_ranking_category' => $this->request->getPost('other_ranking_category'),
                'ranking_number' => $this->request->getPost('ranking_number'),
                'upload_file' => $ranking_fileNewName,
                'datasubmittedpharmacy' => $this->request->getPost('datasubmittedpharmacy'),
                'datasubmittedoverall' => $this->request->getPost('datasubmittedoverall'),
                'pharmacy_file' => $data_submitted_fileNewName,
                'overall_file' => $data_submitted_overall_fileNewName,
                'upload_by' => $loggeduserId
            ];

            $result = $ranking_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/ranking')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/ranking')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }


        }
    }

    public function edit_ranking($id){
        $ranking_model = new Ranking_model();
        $data = ['title' => 'Ranking', 'ranking_id' => $id];
        if ($this->request->is("get")) {
            $data['ranking'] = $ranking_model->get();
            $data['ranking_data'] = $ranking_model->get($id);
            return view('admin/ranking/edit-ranking',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $ranking_data = $ranking_model->get($id);
            $document = $this->request->getFile('upload_file');

            $old_document_file = $ranking_data['upload_file'];
            if (empty($old_document_file)) {
                if ($document->isValid() && !$document->hasMoved()) {
                    $document_name = rand(0,9999). $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/ranking/', $document_name);
                } else {
                    $document_name = null;
                }
            } else {
                if ($document->isValid() && !$document->hasMoved()) {
                    if (file_exists("public/admin/uploads/ranking/" . $old_document_file)) {
                        unlink("public/admin/uploads/ranking/" . $old_document_file);
                    }
                    $document_name = rand(0,9999). $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/ranking/', $document_name);
                } else {
                    $document_name = $old_document_file;
                }
            }

            $document2 = $this->request->getFile('data_submitted_file');
            $old_document_pharmacyfile = $ranking_data['pharmacy_file'];
            if (empty($old_document_pharmacyfile)) {
                if ($document2->isValid() && !$document2->hasMoved()) {
                    $document2_name = "submitted". $document2->getRandomName();
                    $document2->move(ROOTPATH . 'public/admin/uploads/ranking/', $document2_name);
                } else {
                    $document2_name = null;
                }
            } else {
                if ($document2->isValid() && !$document2->hasMoved()) {
                    if (file_exists("public/admin/uploads/ranking/" . $old_document_pharmacyfile)) {
                        unlink("public/admin/uploads/ranking/" . $old_document_pharmacyfile);
                    }
                    $document2_name = "submitted". $document2->getRandomName();
                    $document2->move(ROOTPATH . 'public/admin/uploads/ranking/', $document2_name);
                } else {
                    $document2_name = $old_document_pharmacyfile;
                }
            }

            $document3 = $this->request->getFile('data_submitted_overall_file');
            $old_document_overallfile = $ranking_data['overall_file'];
            if (empty($old_document_overallfile)) {
                if ($document3->isValid() && !$document3->hasMoved()) {
                    $document3_name = "overall". $document3->getRandomName();
                    $document3->move(ROOTPATH . 'public/admin/uploads/ranking/', $document3_name);
                } else {
                    $document3_name = null;
                }
            } else {
                if ($document3->isValid() && !$document3->hasMoved()) {
                    if (file_exists("public/admin/uploads/ranking/" . $old_document_overallfile)) {
                        unlink("public/admin/uploads/ranking/" . $old_document_overallfile);
                    }
                    $document3_name = "overall". $document3->getRandomName();
                    $document3->move(ROOTPATH . 'public/admin/uploads/ranking/', $document3_name);
                } else {
                    $document3_name = $old_document_overallfile;
                }
            }

            $data = [
                'ranking_type' => $this->request->getPost('ranking_type'),
                'other_ranking' => $this->request->getPost('other_ranking'),
                'description' => $this->request->getPost('description'),
                'ranking_year' => $this->request->getPost('ranking_year'),
                'ranking_category' => $this->request->getPost('ranking_category'),
                'other_ranking_category' => $this->request->getPost('other_ranking_category'),
                'ranking_number' => $this->request->getPost('ranking_number'),
                'upload_file' => $document_name,
                'datasubmittedpharmacy' => $this->request->getPost('datasubmittedpharmacy'),
                'datasubmittedoverall' => $this->request->getPost('datasubmittedoverall'),
                'pharmacy_file' => $document2_name,
                'overall_file' => $document3_name,
                'upload_by' => $loggeduserId
            ];

            $result = $ranking_model->add($data, $id);
            if ($result === true) {
                return redirect()->to('admin/edit-ranking/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/edit-ranking/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }

        }
    }


    public function delete_ranking($id){
        $ranking_model = new Ranking_model();
        $ranking_data = $ranking_model->get($id);
        if ($ranking_data) {
            if (!empty($ranking_data['upload_file']) && file_exists('public/admin/uploads/ranking/' . $ranking_data['upload_file'])) {
                unlink('public/admin/uploads/ranking/' . $ranking_data['upload_file']);
            }
            if (!empty($ranking_data['pharmacy_file']) && file_exists('public/admin/uploads/ranking/' . $ranking_data['pharmacy_file'])) {
                unlink('public/admin/uploads/ranking/' . $ranking_data['pharmacy_file']);
            }
            if (!empty($ranking_data['overall_file']) && file_exists('public/admin/uploads/ranking/' . $ranking_data['overall_file'])) {
                unlink('public/admin/uploads/ranking/' . $ranking_data['overall_file']);
            }
            $result = $ranking_model->delete($id);
            if ($result === true) {
                return redirect()->to('admin/ranking')->with('status','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
            } else {
                return redirect()->to('admin/ranking')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        } else {
            return redirect()->to('admin/ranking')->with('status','<div class="alert alert-danger" role="alert"> Data Not Found </div>');
        }
    }

}
