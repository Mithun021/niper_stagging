<?php

namespace App\Controllers;

use App\Models\Department_model;
use App\Models\Grade_model;
use App\Models\Result_model;

class ResultGradeControllers extends BaseController
{
    public function result(){
        $department_model = new Department_model();
        $result_model = new Result_model();
        $data = ['title' => 'Result'];
        if ($this->request->is("get")) {
            $data['department'] = $department_model->activeData();
            $data['result'] = $result_model->get();
            return view('admin/result_grade/result',$data);
        }else if ($this->request->is("post")) {
            $result_file = $this->request->getFile('file_upload');
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            if ($result_file->isValid() && ! $result_file->hasMoved()) {
                $result_fileNewName = "result".$result_file->getRandomName();
                $result_file->move(ROOTPATH . 'public/admin/uploads/result', $result_fileNewName);    
            }else{
                $result_fileNewName = "";
            }

            $data = [
                'resultdesc' => $this->request->getVar('resultdesc'),
                'department_id' => $this->request->getVar('Deptid'),
                'program_id' => $this->request->getVar('Progid'),
                'academic_start_year' => $this->request->getVar('academic_start_year'),
                'academic_end_year' => $this->request->getVar('academic_end_year'),
                'semester' => $this->request->getVar('semester'),
                'notification_date' => $this->request->getVar('notification_date'),
                'file_upload' => $result_fileNewName,
                'upload_by' => $loggeduserId,
            ];

            $result = $result_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/result')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/result')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }


        }
    }

    public function grades(){
        $grade_model = new Grade_model();
        $data = ['title' => 'Grades'];
        if ($this->request->is("get")) {
            $data['grade'] = $grade_model->get();
            return view('admin/result_grade/grades',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $data = [
                'grade' => $this->request->getPost(''),
                'grade_point' => $this->request->getPost(''),
                'performance' => $this->request->getPost(''),
                'upload_by' => $loggeduserId ?? '',
            ];
            $result = $grade_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/grades')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/grades')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }
}
