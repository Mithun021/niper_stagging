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
}
