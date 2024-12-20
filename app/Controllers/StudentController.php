<?php
    namespace App\Controllers;

use App\Models\Department_model;
use App\Models\Designation_model;
use App\Models\Employee_model;
use App\Models\Program_model;
use App\Models\Student_model;
use App\Models\UserModel;

    
    class StudentController extends BaseController{
        public function students(){
            $student_model = new Student_model();
            $data = ['title' => 'Students'];
            if ($this->request->is("get")) {
                return view('admin/student/students',$data);
            }else if ($this->request->is("post")) {
                // Prepare data for insertion
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $std_profile_image = $this->request->getFile('std_profile_image');
                if ($std_profile_image->isValid() && ! $std_profile_image->hasMoved()) {
                    $studentFileName = $std_profile_image->getRandomName();
                    $std_profile_image->move(ROOTPATH . 'public/admin/uploads/students', $studentFileName);    
                }
                $data = [
                    'first_name' => $this->request->getPost('std_first_name'),
                    'middle_name' => $this->request->getPost('std_middle_name'),
                    'last_name' => $this->request->getPost('std_last_name'),
                    'enrollment_no' => $this->request->getPost('Stdenrollid'),
                    'father_name' => $this->request->getPost('std_father_name'),
                    'mother_name' => $this->request->getPost('std_mother_name'),
                    'date_of_birth' => $this->request->getPost('std_date_of_birth'),
                    'blood_group' => $this->request->getPost('std_blood_group'),
                    'personal_mail' => $this->request->getPost('std_personal_mail'),
                    'official_mail' => $this->request->getPost('std_official_mail'),
                    'phone_no' => $this->request->getPost('std_official_mail'),
                    'gender' => $this->request->getPost('gender'),
                    'parmanent_Address' => $this->request->getPost('std_permanent_address'),
                    'corrospondance_address' => $this->request->getPost('std_corrospondence_address'),
                    'profile_image' => $studentFileName ?? '',
                    'upload_by' => $loggeduserId ?? ''
                ];

                // Save the data
                $result = $student_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/students')->with('status', '<div class="alert alert-success" role="alert">Student added successfully.</div>');
                } else {
                    return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
                }
            }
        }

        public function export_student(){
            $student_model = new Student_model();
            // CSV Header
            $csvData = "first_name,middle_name,last_name,enrollment_no,father_name,mother_name,date_of_birth,blood_group,personal_mail,official_mail,phone_no,gender,permanent_address,correspondence_address\n";

            // Sample data - this should be dynamically retrieved from the database or an input source
            $csvData .= implode(",", [
                'John',             // first_name
                'A',                // middle_name
                'Doe',              // last_name
                '123456',           // enrollment_no
                'Richard Doe',      // father_name
                'Jane Doe',         // mother_name
                '2000-01-01',       // date_of_birth
                'O+',               // blood_group
                'john.doe@example.com',  // personal_mail
                'john.doe@school.com',   // official_mail
                '9876543210',       // phone_no
                'Male',             // gender
                '123 Main St City', // permanent_address
                '456 Elm St City'   // correspondence_address
            ]) . "\n";

            $this->generateCSV($csvData, 'student_import_sample.csv');
        
        }
        private function generateCSV($csvData, $fileName){
            $response = $this->response->setContentType('text/csv')
                                        ->setHeader('Content-Disposition', 'attachment; filename="' . $fileName . '"')
                                        ->setBody($csvData)
                                        ->send();
                return $response;
        }

        public function upload_student_csv() {
            $student_model = new Student_model();
            $file = $this->request->getFile('csv_file');
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggedUserId = $sessionData['loggeduserId']; 
            } else {
                return redirect()->back()->with('status', '<div class="alert alert-danger" role="alert">Session expired. Please log in again.</div>');
            }
        
            // Check if a file is uploaded and is valid
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $fileContent = $file->getTempName();
        
                // Read the CSV data into an array
                $csvData = array_map('str_getcsv', file($fileContent));
                $header = array_map('trim', array_shift($csvData));
        
                // Loop through each row in the CSV
                foreach ($csvData as $row) {
                    $data = array_combine($header, $row);
        
                    if (empty($data['first_name']) || empty($data['enrollment_no'])) {
                        continue; // Skip if mandatory fields are missing
                    }
                    $studentData = [
                        'first_name'        => $data['first_name'],
                        'middle_name'       => $data['middle_name'] ?? '',
                        'last_name'         => $data['last_name'] ?? '',
                        'enrollment_no'     => $data['enrollment_no'],
                        'father_name'       => $data['father_name'],
                        'mother_name'       => $data['mother_name'],
                        'date_of_birth'     => date('Y-m-d', strtotime($data['date_of_birth'])),
                        'blood_group'       => $data['blood_group'],
                        'personal_mail'     => $data['personal_mail'],
                        'official_mail'     => $data['official_mail'],
                        'phone_no'          => $data['phone_no'],
                        'gender'            => $data['gender'],
                        'parmanent_Address' => $data['permanent_address'],
                        'corrospondance_address'     => $data['correspondence_address'],
                        'upload_by'         => $loggedUserId,
                    ];
        
                        // Debug output (remove in production)
                        // echo "<pre>"; print_r($experienceData);
        
                        // Insert the data into the database (uncomment to enable)
                        $student_model->insert($studentData);
                    
                }
        
                // Return success message
                return redirect()->back()->with('status', '<div class="alert alert-success" role="alert">Data uploaded and saved successfully!</div>');
        
            } else {
                // Return error message if the file is invalid
                return redirect()->back()->with('status', '<div class="alert alert-danger" role="alert">Failed to process the CSV file. Please ensure the file is valid and try again.</div>');
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