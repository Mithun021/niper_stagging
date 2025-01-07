<?php

namespace App\Controllers;

use App\Models\Committee_model;
use App\Models\Employee_model;
use App\Models\Patent_model;

class PatentController extends BaseController
{
    public function patent_details(){
        $patent_model = new Patent_model();
        $employee_model = new Employee_model();
        $data = ['title' => 'Patent Details'];
        if ($this->request->is("get")) {
            $data['employees'] = $employee_model->get();
            $data['patent'] = $patent_model->get();
            return view('admin/patent-details',$data);
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

            $data =[
                'patent_title' => $this->request->getPost('patent_title'),
                'patent_number' => $this->request->getPost('patent_number'),
                'description' => $this->request->getPost('description'),
                'patent_date' => $this->request->getPost('patent_date'),
                'upload_file' => $patentImageName,
                'employee_id' => $this->request->getPost('emp_id'),
                'author_name' => $this->request->getPost('author_name'),
                'status' => $this->request->getPost('patent_status'),
                'upload_by' => $loggeduserId
            ];
            $result = $patent_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/patent-details')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/patent-details')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }
}
