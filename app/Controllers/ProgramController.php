<?php
    namespace App\Controllers;

use App\Models\Department_model;
use App\Models\Program_department_mapping_model;
use App\Models\Program_model;

    class ProgramController extends BaseController{
        public function program(){
            $program_model = new Program_model();
            $data = ['title' => 'Program'];
            if ($this->request->is("get")) {
                $data['program'] = $program_model->get();
                return view('admin/program/program',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $data = [
                    'name' => $this->request->getPost('program_title'),
                    'description' => $this->request->getPost('program_description'),
                    'status' => $this->request->getPost('status'),
                    'upload_by' => $loggeduserId
                ];

               $result = $program_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/program')->with('msg','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/program')->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
            
        }


        public function program_dept_mapping(){
            $program_department_mapping_model = new Program_department_mapping_model();
            $department_model = new Department_model();
            $program_model = new Program_model();
            $data = ['title' => 'Program Dept. Mapping'];
            if ($this->request->is("get")) {
                $data['department'] = $department_model->activeData();
                $data['program'] = $program_model->activeData();
                $data['program_dep_mapping'] = $program_department_mapping_model->get();
                return view('admin/program/program-dept-mapping',$data);
            }else if ($this->request->is("post")) {

            }
        }


    }
?>