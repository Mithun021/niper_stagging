<?php
    namespace App\Controllers;

use App\Models\Department_model;
use App\Models\Designation_model;
use App\Models\Employee_awards_model;
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
                $orgname = $this->request->getPost('orgname');
                foreach ($orgname as $key => $value) {
                    $data = [
                        'emplyee_id' => $this->request->getPost('Empid'),
                        'organization_name' => $value,
                        'start_date' => $this->request->getPost('startdate')[$key],
                        'end_date' => $this->request->getPost('enddate')[$key],
                        'exp_description' => $this->request->getVar('expdesc')[$key],
                        'org_type' => $this->request->getPost('orgtype')[$key],
                        'work_nature' => $this->request->getPost('natureofwork')[$key],
                        'upload_by' =>  $loggeduserId,
                    ];
    
                    // echo "<pre>";print_r($data);
                    $result = $employee_experience_model->add($data);
                }
                // die;
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
                $project_start_date = $this->request->getPost('project_start_date');
                foreach ($project_start_date as $key => $value) {
                    $data = [
                        'emplyee_id' => $this->request->getPost('Empid'),
                        'project_title' => $this->request->getPost('projecttitle')[$key],
                        'project_description' => $this->request->getPost('projectdesc')[$key],
                        'start_date' => $value,
                        'start_time' => $this->request->getPost('project_start_time')[$key],
                        'end_date' => $this->request->getPost('project_end_date')[$key],
                        'end_time' => $this->request->getPost('project_end_time')[$key],
                        'project_status' => $this->request->getPost('projectstatus')[$key],
                        'sponsored_by' => $this->request->getPost('projectsponseredby')[$key],
                        'project_value' => $this->request->getPost('projectvalue')[$key],
                        'upload_by' =>  $loggeduserId,
                    ];

                    // echo "<pre>";print_r($data);
                    $result = $employee_projects_model->add($data);
                }
                // die;
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
                $data['publication'] = $employee_publication_model->get();
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
            $employee_model = new Employee_model();
            $employee_awards_model = new Employee_awards_model();
            $data = ['title' => 'Employee Awards'];
            if ($this->request->is("get")) {
                $data['employee'] = $employee_model->get();
                $data['awards'] = $employee_awards_model->get();
                return view('admin/employee/employee-awards',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $awards_photo = $this->request->getFileMultiple('Awardphotoupload');
                $awards_titles = $this->request->getPost('Awardtitle');
                foreach ($awards_titles as $key => $title) {    
                    $photo = $awards_photo[$key];
                    $photoName = "";
                    if ($photo->isValid() && !$photo->hasMoved()) {
                        $photoName = $photo->getRandomName();
                        $photo->move(ROOTPATH . 'public/admin/uploads/awards', $photoName);
                    }
                    $data = [
                        'emplyee_id' => $this->request->getPost('Empid'),
                        'award_title' => $title,
                        'award_photo' => $photoName,
                        'award_year' => $this->request->getPost('Awardyear')[$key],
                        'award_date_time' => $this->request->getPost('Awarddatetime')[$key],
                        'award_agency_type' => $this->request->getPost('Awardingagencytype')[$key],
                        'award_agency_name' => $this->request->getPost('Awardingagencyname')[$key],
                        'upload_by' =>  $loggeduserId,
                    ]; 

                    // echo "<pre>";print_r($data);
                    $result = $employee_awards_model->add($data);
                }
                if ($result === true) {
                    return redirect()->to('admin/employee-awards')->with('msg','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/employee-awards')->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }

            }
        }


        // Export Employee Sample Controller function ============================

        public function export_emp_experience_sample(){
            $employee_model = new Employee_model();
            $empIds = $this->request->getPost('emp_id');
            //echo "<pre>"; print_r($empIds); die;
            if (empty($empIds) || !is_array($empIds)) {
                return redirect()->to('admin/employee-experience')->with('msg','<div class="alert alert-danger" role="alert"> No Employee Selected </div>');
            }
            //echo "<pre>"; print_r($employees); die;
            if ($empIds) {
                $employeeDetails = $employee_model->getEmployeeDetailsByIds($empIds);
                $csvData = "emp_name,email,emp_phone,organization_name,start_date,end_date,description,organization_type,nature_of_work\n";
                foreach ($employeeDetails as $employee) {
                    $csvData .= implode(",", [
                        $employee['first_name'] . ' ' . $employee['middle_name'] . ' ' . $employee['last_name'],
                        $employee['official_mail'],
                        $employee['mobile_no'],
                        'Sample Organization',
                        '2024-01-01',
                        '2024-12-31',
                        'Sample Description',
                        'Private',
                        'Development'
                    ]) . "\n";
                }
                // Generate CSV file
                $this->generateCSV($csvData, 'employee_experience_sample.csv');
            }
        }

        public function export_emp_project_sample(){
            $employee_model = new Employee_model();
            $empIds = $this->request->getPost('emp_id');
            //echo "<pre>"; print_r($empIds); die;
            if (empty($empIds) || !is_array($empIds)) {
                return redirect()->to('admin/employee-projects')->with('msg','<div class="alert alert-danger" role="alert"> No Employee Selected </div>');
            }
            //echo "<pre>"; print_r($employees); die;
            if ($empIds) {
                $employeeDetails = $employee_model->getEmployeeDetailsByIds($empIds);
                $csvData = "emp_name,email,emp_phone,project_title,project_description,start_date,start_time,end_date,end_time,project_status,sponsored_by,project_value\n";
                foreach ($employeeDetails as $employee) {
                    $csvData .= implode(",", [
                        $employee['first_name'] . ' ' . $employee['middle_name'] . ' ' . $employee['last_name'],
                        $employee['official_mail'],
                        $employee['mobile_no'],
                        'Project title',
                        'Project Description',
                        '2024-01-01',
                        '06:10.00',
                        '2024-12-31',
                        '08:30.00',
                        'Not Started',
                        'Sponsored name',
                        '10000'
                    ]) . "\n";
                }
                // Generate CSV file
                $this->generateCSV($csvData, 'employee_project_sample.csv');
            }
        }

        private function generateCSV($csvData, $fileName){
        $response = $this->response->setContentType('text/csv')
                                    ->setHeader('Content-Disposition', 'attachment; filename="' . $fileName . '"')
                                    ->setBody($csvData)
                                    ->send();
            return $response;
        }



        // Import CSV File of Employees

        public function upload_emp_experience_csv(){
            $employeeModel = new \App\Models\Employee_model();
            $experienceModel = new \App\Models\Employee_experience_model();
            $file = $this->request->getFile('csv_file');
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }

            // Check if a file is uploaded and is valid
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $fileContent = $file->getTempName();
                $csvData = array_map('str_getcsv', file($fileContent));
                $header = array_map('trim', array_shift($csvData)); // Extract and trim header row

                foreach ($csvData as $row) {
                    $data = array_combine($header, $row); // Combine header with row values

                    // Validate mandatory fields
                    if (empty($data['email']) || empty($data['emp_phone']) || empty($data['organization_name'])) {
                        continue; // Skip if mandatory fields are missing
                    }

                    // Find the employee_id based on email and phone
                    $employee = $employeeModel
                        ->where('official_mail', $data['email'])
                        ->where('mobile_no', $data['emp_phone'])
                        ->first();

                    if ($employee) {
                        // Prepare data for insertion
                        $experienceData = [
                            'emplyee_id'       => $employee['id'],
                            'organization_name' => $data['organization_name'],
                            'start_date'        => date('Y-m-d', strtotime($data['start_date'])),
                            'end_date'          => date('Y-m-d', strtotime($data['end_date'])),
                            'exp_description'   => $data['description'],
                            'org_type'          => $data['organization_type'],
                            'work_nature'       => $data['nature_of_work'],
                            'upload_by'         => $loggeduserId,
                        ];

                        // echo "<pre>"; print_r($experienceData);
                        // Validate and insert
                        $experienceModel->insert($experienceData);
                    }
                }

                return redirect()->back()->with('msg', '<div class="alert alert-success" role="alert">Data uploaded and saved successfully!</div>');
            }

            return redirect()->back()->with('msg', '<div class="alert alert-danger" role="alert">Failed to process the CSV file. Please ensure the file is valid and try again.</div>');
        }

        public function upload_emp_project_csv() {
            $employeeModel = new \App\Models\Employee_model();
            $employeeProjectsModel = new Employee_projects_model();
            $file = $this->request->getFile('csv_file');
            $sessionData = session()->get('loggedUserData');
        
            // Check if session is valid and if user ID is available
            if ($sessionData) {
                $loggedUserId = $sessionData['loggeduserId']; 
            } else {
                return redirect()->back()->with('msg', '<div class="alert alert-danger" role="alert">Session expired. Please log in again.</div>');
            }
        
            // Check if a file is uploaded and is valid
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $fileContent = $file->getTempName();
        
                // Read the CSV data into an array
                $csvData = array_map('str_getcsv', file($fileContent));
                $header = array_map('trim', array_shift($csvData)); // Extract and trim the header row
        
                // Loop through each row in the CSV
                foreach ($csvData as $row) {
                    $data = array_combine($header, $row); // Combine header with row values
        
                    // Validate mandatory fields (email, emp_phone, and organization_name)
                    if (empty($data['email']) || empty($data['emp_phone']) || empty($data['organization_name'])) {
                        continue; // Skip if mandatory fields are missing
                    }
        
                    // Find the employee by email and phone
                    $employee = $employeeModel
                        ->where('official_mail', $data['email'])
                        ->where('mobile_no', $data['emp_phone'])
                        ->first();
        
                    if ($employee) {
                        // Prepare data for insertion
                        $experienceData = [
                            'emplyee_id'        => $employee['id'],
                            'project_title'     => $data['project_title'],
                            'project_description' => $data['project_description'],
                            'start_date'        => date('Y-m-d', strtotime($data['start_date'])),
                            'start_time'        => $data['start_time'],
                            'end_date'          => date('Y-m-d', strtotime($data['end_date'])),
                            'end_time'          => $data['end_time'],
                            'project_status'    => $data['project_status'],
                            'sponsored_by'      => $data['sponsored_by'],
                            'project_value'     => $data['project_value'],
                            'upload_by'         => $loggedUserId,
                        ];
        
                        // Debug output (remove in production)
                        // echo "<pre>"; print_r($experienceData);
        
                        // Insert the data into the database (uncomment to enable)
                        // $employeeProjectsModel->insert($experienceData);
                    }
                }
        
                // Return success message
                return redirect()->back()->with('msg', '<div class="alert alert-success" role="alert">Data uploaded and saved successfully!</div>');
        
            } else {
                // Return error message if the file is invalid
                return redirect()->back()->with('msg', '<div class="alert alert-danger" role="alert">Failed to process the CSV file. Please ensure the file is valid and try again.</div>');
            }
        }        



    }
?>