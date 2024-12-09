<?php
    namespace App\Controllers;

use App\Models\Department_model;
use App\Models\Designation_model;
use App\Models\Employee_experience_model;
use App\Models\Employee_model;
use App\Models\Employee_projects_model;
use App\Models\Employee_publication_author_model;
use App\Models\Employee_publication_model;

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

        public function employee_experience(){
            $employee_model = new Employee_model();
            $employee_experience_model = new Employee_experience_model();
            $data = ['title' => 'Employee Experience'];
            if ($this->request->is("get")) {
                $data['employee'] = $employee_model->get();
                $data['employee_exp'] = $employee_experience_model->get();
                return view('admin/employee/employee-experience',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $data = [
                    'emplyee_id' => $this->request->getPost('Empid'),
                    'organization_name' => $this->request->getPost('orgname'),
                    'start_date' => $this->request->getPost('startdate'),
                    'end_date' => $this->request->getPost('enddate'),
                    'exp_description' => $this->request->getPost('expdesc'),
                    'org_type' => $this->request->getPost('orgtype'),
                    'work_nature' => $this->request->getPost('natureofwork'),
                    'upload_by' =>  $loggeduserId,
                ];

                // echo "<pre>";print_r($data);
                $result = $employee_experience_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/employee-experience')->with('msg','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/employee-experience')->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function employee_projects(){
            $employee_model = new Employee_model();
            $employee_projects_model = new Employee_projects_model();
            $data = ['title' => 'Employee Projects'];
            if ($this->request->is("get")) {
                $data['employee'] = $employee_model->get();
                $data['employee_projects'] = $employee_projects_model->get();
                return view('admin/employee/employee-projects',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $data = [
                    'emplyee_id' => $this->request->getPost('Empid'),
                    'project_title' => $this->request->getPost('projecttitle'),
                    'project_description' => $this->request->getPost('projectdesc'),
                    'start_date' => $this->request->getPost('project_start_date'),
                    'start_time' => $this->request->getPost('project_start_time'),
                    'end_date' => $this->request->getPost('project_end_date'),
                    'end_time' => $this->request->getPost('project_end_time'),
                    'project_status' => $this->request->getPost('projectstatus'),
                    'sponsored_by' => $this->request->getPost('projectsponseredby'),
                    'project_value' => $this->request->getPost('projectvalue'),
                    'upload_by' =>  $loggeduserId,
                ];

                // echo "<pre>";print_r($data);
                $result = $employee_projects_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/employee-projects')->with('msg','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/employee-projects')->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function employee_publication(){
            $employee_model = new Employee_model();
            $employee_publication_model = new Employee_publication_model();
            $employee_publication_author_model = new Employee_publication_author_model();
            $data = ['title' => 'Employee Publication'];
            if ($this->request->is("get")) {
                $data['employee'] = $employee_model->get();
                return view('admin/employee/employee-publication',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $publication_photo = $this->request->getFile('Pubphotoupload');
                if ($publication_photo->isValid() && ! $publication_photo->hasMoved()) {
                    $publicationimageName = $publication_photo->getRandomName();
                    $publication_photo->move(ROOTPATH . 'public/admin/uploads/publication', $publicationimageName);    
                }else{
                 $publicationimageName = "invalidImage.png";
                }

                $author_name = $this->request->getPost('author_name');

                $data = [
                    'emplyee_id' => $this->request->getPost('Empid'),
                    'title' => $this->request->getPost('Pubtitle'),
                    'description' => $this->request->getPost('description'),
                    'keywords' => $this->request->getPost('Pubkeyword'),
                    'publication_photo' => $publicationimageName,
                    'doi_details' => $this->request->getPost('DoIdetails'),
                    'publication_year' => $this->request->getPost('Pubyear'),
                    'publication_type' => $this->request->getPost('Pubtype'),
                    'status' => $this->request->getPost('Pubstatus'),
                    'upload_by' =>  $loggeduserId,
                ]; 

                // echo "<pre>";print_r($data);
                $result = $employee_publication_model->add($data);
                if ($result === true) {
                    foreach ($author_name as $value) {
                        $data2 = [
                            'author_name' => $value,
                            'emp_publication_id' => $result,
                        ];
                        $employee_publication_author_model->add($data2);
                    }
                    return redirect()->to('admin/employee-publication')->with('msg','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/employee-publication')->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }


            }
        }

        public function employee_awards(){
            $data = ['title' => 'Employee Awards'];
            if ($this->request->is("get")) {
                return view('admin/employee/employee-awards',$data);
            }else if ($this->request->is("post")) {

            }
        }


    }
?>