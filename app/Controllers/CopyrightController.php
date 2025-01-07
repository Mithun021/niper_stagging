<?php

namespace App\Controllers;

use App\Models\Copyright_model;
use App\Models\Employee_model;

class CopyrightController extends BaseController
{
    public function copyright_details(){
        $copyright_model = new Copyright_model();
        $employee_model = new Employee_model();
        $data = ['title' => 'Copyright Details'];
        if ($this->request->is("get")) {
            $data['employees'] = $employee_model->get();
            $data['copyright'] = $copyright_model->get();
            return view('admin/copyrights/copyright-details',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $copyright_photo = $this->request->getFile('Copyright_file');
            if ($copyright_photo->isValid() && ! $copyright_photo->hasMoved()) {
                $copyrightImageName = $copyright_photo->getRandomName();
                $copyright_photo->move(ROOTPATH . 'public/admin/uploads/copyright', $copyrightImageName);    
            }else{
                $copyrightImageName = "";
            }

            $data =[
                'copyright_title' => $this->request->getPost('Copyright_title'),
                'copyright_number' => $this->request->getPost('Copyright_number'),
                'copyright_description' => $this->request->getPost('description'),
                'copyright_start_date' => $this->request->getPost('copyright_start_date'),
                'copyright_start_time' => $this->request->getPost('copyright_start_time'),
                'copyright_end_date' => $this->request->getPost('copyright_end_date'),
                'copyright_end_time' => $this->request->getPost('copyright_end_time'),
                'upload_file' => $copyrightImageName,
                'employee_id' => $this->request->getPost('emp_id'),
                'author_name' => $this->request->getPost('author_name'),
                'status' => $this->request->getPost('Copyright_status'),
                'upload_by' => $loggeduserId
            ];
            $result = $copyright_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/copyright-details')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/copyright-details')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }
}
