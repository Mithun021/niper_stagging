<?php
    namespace App\Controllers;

use App\Models\Department_model;
use App\Models\Designation_model;
use App\Models\Employee_model;

    class EmployeeController extends BaseController{
        public function employee(){
            $department_model = new Department_model();
            $designation_model = new Designation_model();
            $employee_model = new Employee_model();
            $data = ['title' => 'Employee Details'];
            if ($this->request->is("get")) {
                $data['departments'] = $department_model->get();
                $data['designations'] = $designation_model->get();
                $data['employee'] = $employee_model->get();
                return view('admin/employee/employee',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $profile_image = $this->request->getFile('profile_photo');
                if ($profile_image->isValid() && ! $profile_image->hasMoved()) {
                    $imageName = $profile_image->getRandomName();
                    $profile_image->move(ROOTPATH . 'public/admin/uploads/employee', $imageName);    
                }else{
                 $imageName = "invalidImage.png";
                }
                $resume_file = $this->request->getFile('resume_file');
                if ($resume_file->isValid() && ! $resume_file->hasMoved()) {
                    $resumeimageName = $resume_file->getRandomName();
                    $resume_file->move(ROOTPATH . 'public/admin/uploads/employee', $resumeimageName);    
                }else{
                 $resumeimageName = "invalidImage.png";
                }
                $password = "123456";
                $data = [
                    'first_name' => $this->request->getPost('first_name'),
                    'middle_name' => $this->request->getPost('middle_name'),
                    'last_name' => $this->request->getPost('last_name'),
                    'designation_id' => $this->request->getPost('designation_id'),
                    'department_id' => $this->request->getPost('department_id'),
                    'mobile_no' => $this->request->getPost('mobile_no'),
                    'landline_no' => $this->request->getPost('landline_no'),
                    'official_mail' => $this->request->getPost('official_mail'),
                    'personal_mail' => $this->request->getPost('personal_mail'),
                    'post_charge' => $this->request->getPost('post_charge'),
                    'employee_type' => $this->request->getPost('employee_type'),
                    'profile_photo' => $imageName,
                    'resume_file' => $resumeimageName,
                    'twitter' => $this->request->getPost('twitter'),
                    'facebook' => $this->request->getPost('facebook'),
                    'linkedin' => $this->request->getPost('linkedin'),
                    'research' => $this->request->getPost('research'),
                    'google_h_index' => $this->request->getPost('google_h_index'),
                    'i10_index' => $this->request->getPost('i10_index'),
                    'scopus_h_index' => $this->request->getPost('scopus_h_index'),
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'status' => $this->request->getPost('status'),
                    'upload_by' =>  $loggeduserId,
                    // 'first_name' => $this->request->getPost('first_name'),
                ];

                // echo "<pre>";print_r($data);
                $result = $employee_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/employee')->with('msg','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/employee')->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }

            }
        }
    }
?>