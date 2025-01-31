<?php

namespace App\Controllers;

use App\Models\Committee_model;
use App\Models\Employee_model;
use App\Models\Patent_author_model;
use App\Models\Patent_model;

class PatentController extends BaseController
{
    public function patent_details(){
        $patent_model = new Patent_model();
        $employee_model = new Employee_model();
        $patent_author_model = new Patent_author_model();
        $data = ['title' => 'Patent Details'];
        if ($this->request->is("get")) {
            $data['employees'] = $employee_model->get();
            $data['patent'] = $patent_model->get();
            return view('admin/patent/patent-details',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $patent_photo = $this->request->getFile('patent_file');
            if ($patent_photo->isValid() && ! $patent_photo->hasMoved()) {
                $patentImageName = $patent_photo->getRandomName();
                $patent_photo->move(ROOTPATH . 'public/admin/uploads/patent', $patentImageName);    
            }else{
                $patentImageName = "";
            }
            $author_name = $this->request->getPost('author_name');
            $data =[
                'patent_title' => $this->request->getPost('patent_title'),
                'ipr_number' => $this->request->getPost('ipr_number'),
                'patent_type' => $this->request->getPost('patent_type'),
                'description' => $this->request->getPost('description'),
                'filling_date' => $this->request->getPost('filling_date'),
                'grant_date' => $this->request->getPost('grant_date'),
                'current_status' => $this->request->getPost('current_status'),
                'upload_file' => $patentImageName,
                'employee_id' => $this->request->getPost('emp_id'),
                'status' => $this->request->getPost('patent_status'),
                'upload_by' => $loggeduserId
            ];
            $result = $patent_model->add($data);
            if ($result === true) {
                $insertedId = $patent_model->getInsertID();
                foreach ($author_name as $key => $value) {
                    $data = [
                        'patent_id' => $insertedId,
                        'author_name' => $value
                    ];
                    $result = $patent_author_model->add($data);
                }
                return redirect()->to('admin/patent-details')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/patent-details')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }
}
