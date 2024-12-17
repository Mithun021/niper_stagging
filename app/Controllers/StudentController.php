<?php
    namespace App\Controllers;

use App\Models\Department_model;
use App\Models\Designation_model;
use App\Models\Employee_model;
use App\Models\Program_model;
use App\Models\UserModel;

    
    class StudentController extends BaseController{
        public function students(){
            $data = ['title' => 'Students'];
            if ($this->request->is("get")) {
                return view('admin/student/students',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function program_dept_std_mapping(){
            $department_model = new Department_model();
            $program_model = new Program_model();
            $data = ['title' => 'Program Dept. Std. Mapping'];
            if ($this->request->is("get")) {
                $data['department'] = $department_model->activeData();
                $data['program'] = $program_model->activeData();
                return view('admin/student/program-dept-std-mapping',$data);
            }else if ($this->request->is("post")) {

            }
        }
    }
?>