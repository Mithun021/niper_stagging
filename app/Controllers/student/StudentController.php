<?php

namespace App\Controllers\student;

use App\Controllers\BaseController;
use App\Models\Employee_model;
use App\Models\Program_department_mapping_model;
use App\Models\State_city_model;
use App\Models\Student_academic_details_model;
use App\Models\Student_book_chapter_model;
use App\Models\Student_bookchapter_author_model;
use App\Models\Student_model;
use App\Models\Student_phd_details_model;
use App\Models\Student_prog_dept_mapping_model;
use App\Models\Student_publication_author_model;
use App\Models\Student_publication_model;

class StudentController extends BaseController
{
    public function index()
    {
        $data = ['title' =>'Student Dashboard'];
        return view('student/index',$data); 
    }

    public function student_profile()
    {
        $data = ['title' =>'Student Profile'];
        if ($this->request->is('get')) {
        return view('student/student-profile',$data);
        }else  if ($this->request->is('post')) {
            
        }
    }

    public function personal_details()
    {
        $employee_model = new Employee_model();
        $state_city_model = new State_city_model();
        $student_prog_dept_mapping_model = new Student_prog_dept_mapping_model();
        $student_model = new Student_model();
        $program_department_mapping_model = new Program_department_mapping_model();
        
        $data = ['title' =>'Personal Details'];
        $sessionData = session()->get('loggedStudentData');
        if ($sessionData) {
            $loggedstudentId = $sessionData['loggedstudentId'];
        }

        $data['studentData'] = $student_model->get($loggedstudentId);
        $data['studentDataCourses'] = $student_prog_dept_mapping_model->getStudentProgramDeptData($loggedstudentId);
        $data['batchName'] = $program_department_mapping_model->getBatchName($data['studentDataCourses']['program_id'],$data['studentDataCourses']['department_id']);
        $data['employeeData'] = $employee_model->get();
        $data['stateData'] = $state_city_model->get_state();
        if ($this->request->is('get')) {
            return view('student/personal-details',$data);
        }else  if ($this->request->is('post')) {
            $studentData = $student_model->get($loggedstudentId);

            $std_profile_image = $this->request->getFile('std_profile_image');
            $std_signature_image = $this->request->getFile('std_signature_image');

            $old_profile_image = $studentData['profile_image'];
            $old_signature_image = $studentData['signature'];

            if (empty($old_profile_image)) {
                if ($std_profile_image->isValid() && !$std_profile_image->hasMoved()) {
                    $new_profile_file = "profile" . $std_profile_image->getRandomName();
                    $std_profile_image->move(ROOTPATH . 'public/admin/uploads/students/', $new_profile_file);
                } else {
                    $new_profile_file = null;
                }
            } else {
                if ($std_profile_image->isValid() && !$std_profile_image->hasMoved()) {
                    if (file_exists("public/admin/uploads/students/" . $old_profile_image)) {
                        unlink("public/admin/uploads/students/" . $old_profile_image);
                    }
                    $new_profile_file = "profile" . $std_profile_image->getRandomName();
                    $std_profile_image->move(ROOTPATH . 'public/admin/uploads/students/', $new_profile_file);
                } else {
                    $new_profile_file = $old_profile_image;
                }
            }

            if (empty($old_signature_image)) {
                if ($std_signature_image->isValid() && !$std_signature_image->hasMoved()) {
                    $new_signature_file = "signature" . $std_signature_image->getRandomName();
                    $std_signature_image->move(ROOTPATH . 'public/admin/uploads/students/', $new_signature_file);
                } else {
                    $new_signature_file = null;
                }
            } else {
                if ($std_signature_image->isValid() && !$std_signature_image->hasMoved()) {
                    if (file_exists("public/admin/uploads/students/" . $old_signature_image)) {
                        unlink("public/admin/uploads/students/" . $old_signature_image);
                    }
                    $new_signature_file = "signature" . $std_signature_image->getRandomName();
                    $std_signature_image->move(ROOTPATH . 'public/admin/uploads/students/', $new_signature_file);
                } else {
                    $new_signature_file = $old_signature_image;
                }
            }

            $data = [
                // 'first_name' => $this->request->getPost('std_first_name'),
                'middle_name' => $this->request->getPost('std_middle_name'),
                'last_name' => $this->request->getPost('std_last_name'),
                // 'enrollment_no' => $this->request->getPost('Stdenrollid'),
                'father_name' => $this->request->getPost('std_father_name'),
                'mother_name' => $this->request->getPost('std_mother_name'),
                'date_of_birth' => $this->request->getPost('std_date_of_birth'),
                'blood_group' => $this->request->getPost('std_blood_group'),
                // 'personal_mail' => $this->request->getPost('std_personal_mail'),
                'official_mail' => $this->request->getPost('std_official_mail'),
                'phone_no' => $this->request->getPost('Stdphone'),
                'gender' => $this->request->getPost('gender'),
                'permanent_address' => $this->request->getPost('std_permanent_address'),
                'correspondence_address' => $this->request->getPost('std_corrospondence_address'),
                'category' => $this->request->getPost('category'),
                'ews' => $this->request->getPost('ews') ?? 0,
                'relegion' => $this->request->getPost('relegion'),
                'other_relegion' => $this->request->getPost('other_relegion'),
                'supervisor_name' => $this->request->getPost('supervisor'),
                'linkedin_id' => $this->request->getPost('linkedin_id'),
                'state' => $this->request->getPost('state'),
                'city' => $this->request->getPost('city'),
                'pincode' => $this->request->getPost('pincode'),
                'profile_image' => $new_profile_file ?? '',
                'signature' => $new_signature_file ?? '',
            ];
            $result = $student_model->add($data, $loggedstudentId);
            if ($result === true) {
                return redirect()->to('student/personal-details')->with('status', '<div class="alert alert-success" role="alert">Profile update successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        }
    }

    public function academic_details(){
        $student_academic_details_model = new Student_academic_details_model();
        $sessionData = session()->get('loggedStudentData');
        if ($sessionData) {
            $loggedstudentId = $sessionData['loggedstudentId'];
        }
        $data = ['title' =>'Academic Details'];
        if ($this->request->is('get')) {
            $data['studentAcademicDetails'] = $student_academic_details_model->getByStudent($loggedstudentId);
            return view('student/academic-details',$data);
        }else  if ($this->request->is('post')) {
            $upload_file = $this->request->getFile('upload_file');
            if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                $studentFileName = "acadmic".$upload_file->getRandomName();
                $upload_file->move(ROOTPATH . 'public/admin/uploads/students', $studentFileName);    
            }
            $data = [
                'student_id' => $loggedstudentId,
                'degree_type' => $this->request->getPost('degree_type'),
                'other_degree_name' => $this->request->getPost('other_degree_name') ?? '',
                'board_institute_name' => $this->request->getPost('board_institute_name'),
                'subject_studied' => $this->request->getPost('subject_studied'),
                'marks_type' => $this->request->getPost('marks_type'),
                'marks_obtained' => $this->request->getPost('marks_obtained'),
                'result_declaration_date' => $this->request->getPost('result_declaration_date')."-01",
                'degree_date' => $this->request->getPost('degree_date')."-01",
                'upload_file' => $studentFileName ?? '',
            ];
            // print_r($data);die;
            $result = $student_academic_details_model->add($data);
            if ($result === true) {
                return redirect()->to('student/academic-details')->with('status', '<div class="alert alert-success" role="alert">Academic details added successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        }
    }

    public function delete_academic_details($id){
        $student_academic_details_model = new Student_academic_details_model();
        $studentData = $student_academic_details_model->get($id);
        if ($studentData) {
            if (file_exists("public/admin/uploads/students/" . $studentData['upload_file'])) {
                unlink("public/admin/uploads/students/" . $studentData['upload_file']);
            }
            $result = $student_academic_details_model->delete($id);
            if ($result === true) {
                return redirect()->to('student/academic-details')->with('status', '<div class="alert alert-success" role="alert">Acadmic details deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('student/acadmic-details')->with('status', '<div class="alert alert-danger" role="alert">Acadmic details not found.</div>');
        }
    }

    public function phd_details()
    {
        $sessionData = session()->get('loggedStudentData');
        if ($sessionData) {
            $loggedstudentId = $sessionData['loggedstudentId'];
        }
        $student_phd_details_model = new Student_phd_details_model();
        $employee_model = new Employee_model();
        $data = ['title' =>'PHD Details'];
        if ($this->request->is('get')) {
            $data['employeeData'] = $employee_model->get();
            $data['studentData'] = $student_phd_details_model->getByStudent($loggedstudentId);
            return view('student/phd-details',$data);
        }else  if ($this->request->is('post')) {
            $upload_file = $this->request->getFile('file_upload');
            if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                $studentFileName = "phdfile".$upload_file->getRandomName();
                $upload_file->move(ROOTPATH . 'public/admin/uploads/students', $studentFileName);    
            }
            $data = [
                'student_id' => $loggedstudentId,
                'phd_title' => $this->request->getPost('phd_title'),
                'description' => $this->request->getPost('description') ?? '',
                'supervisor_name' => $this->request->getPost('supervisor_name'),
                'current_status' => $this->request->getPost('current_status'),
                'registration_date' => $this->request->getPost('registration_date'),
                'submission_date' => $this->request->getPost('submission_date'),
                'award_date' => $this->request->getPost('award_date'),
                'file_upload' => $studentFileName ?? '',
            ];
            // print_r($data);die;
            $result = $student_phd_details_model->add($data);
            if ($result === true) {
                return redirect()->to('student/phd-details')->with('status', '<div class="alert alert-success" role="alert">Academic details added successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        }
    }

    public function delete_phd_details($id){
        $student_phd_details_model = new Student_phd_details_model();
        $studentData = $student_phd_details_model->get($id);
        if ($studentData) {
            if (file_exists("public/admin/uploads/students/" . $studentData['file_upload'])) {
                unlink("public/admin/uploads/students/" . $studentData['file_upload']);
            }
            $result = $student_phd_details_model->delete($id);
            if ($result === true) {
                return redirect()->to('student/phd-details')->with('status', '<div class="alert alert-success" role="alert">PhD details deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('student/phd-details')->with('status', '<div class="alert alert-danger" role="alert">PhD details not found.</div>');
        }
    }

    public function publication_details()
    {
        $sessionData = session()->get('loggedStudentData');
        if ($sessionData) {
            $loggedstudentId = $sessionData['loggedstudentId'];
        }
        $student_publication_model = new Student_publication_model();
        $student_publication_author_model = new Student_publication_author_model();
        $data = ['title' =>'Publication Details'];
        if ($this->request->is('get')) {
            $data['studentData'] = $student_publication_model->getByStudent($loggedstudentId);
            // print_r($data);die;
            return view('student/publication-details',$data);
        }else  if ($this->request->is('post')) {
            $upload_file = $this->request->getFile('file_upload');
            if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                $studentFileName = "publication".$upload_file->getRandomName();
                $upload_file->move(ROOTPATH . 'public/admin/uploads/students', $studentFileName);    
            }
            $data = [
                'student_id' => $loggedstudentId,
                'publication_title' => $this->request->getPost('publication_title'),
                'publication_description' => $this->request->getPost('publication_description') ?? '',
                'journal_name' => $this->request->getPost('journal_name'),
                'volume_number' => $this->request->getPost('volume_number'),
                'page_number' => $this->request->getPost('page_number'),
                'publication_type' => $this->request->getPost('publication_type'),
                'issn_no' => $this->request->getPost('issn_no'),
                'isbn_no' => $this->request->getPost('isbn_no'),
                'doi' => $this->request->getPost('doi'),
                'impact_factor' => $this->request->getPost('impact_factor'),
                'publication_year' => $this->request->getPost('publication_year'),
                'file_upload' => $studentFileName ?? '',
            ];
            // print_r($data);die;
            $result = $student_publication_model->add($data);
            if ($result === true) {
                $publicationId = $student_publication_model->insertID();
                $authors = $this->request->getPost('author_name');
                if (!empty($authors)) {
                    foreach ($authors as $author) {
                        $authorData = [
                            'student_publication_id' => $publicationId,
                            'author_name' => $author,
                        ];
                        $student_publication_author_model->add($authorData);
                    }
                }
                return redirect()->to('student/publication-details')->with('status', '<div class="alert alert-success" role="alert">Academic details added successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        }
    }

    public function delete_publication_details($id){
        $student_publication_model = new Student_publication_model();
        $student_publication_author_model = new Student_publication_author_model();
        $studentData = $student_publication_model->get($id);
        if ($studentData) {
            if (file_exists("public/admin/uploads/students/" . $studentData['file_upload'])) {
                unlink("public/admin/uploads/students/" . $studentData['file_upload']);
            }
            $result = $student_publication_model->delete($id);
            if ($result === true) {
                $student_publication_author_model->where('student_publication_id', $id)->delete();
                return redirect()->to('student/publication-details')->with('status', '<div class="alert alert-success" role="alert">Publication details deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('student/publication-details')->with('status', '<div class="alert alert-danger" role="alert">Publication details not found.</div>');
        }
    }

    public function book_chapter_details()
    {
        $sessionData = session()->get('loggedStudentData');
        if ($sessionData) {
            $loggedstudentId = $sessionData['loggedstudentId'];
        }
        $student_book_chapter_model = new Student_book_chapter_model();
        $student_bookchapter_author_model = new Student_bookchapter_author_model();
        $data = ['title' =>'Book Chapter Details'];
        if ($this->request->is('get')) {
            $data['studentData'] = $student_book_chapter_model->getByStudent($loggedstudentId);
            return view('student/book-chapter-details',$data);
        }else  if ($this->request->is('post')) {
            $upload_file = $this->request->getFile('file_upload');
            if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                $studentFileName = "book".$upload_file->getRandomName();
                $upload_file->move(ROOTPATH . 'public/admin/uploads/students', $studentFileName);    
            }
            $data = [
                'student_id' => $loggedstudentId,
                'chapter_title' => $this->request->getPost('chapter_title'),
                'book_title' => $this->request->getPost('book_title'),
                'publication_description' => $this->request->getPost('publication_description') ?? '',
                'publisher_name' => $this->request->getPost('publisher_name'),
                'volume_number' => $this->request->getPost('volume_number'),
                'page_number' => $this->request->getPost('page_number'),
                'issn_no' => $this->request->getPost('issn_no'),
                'isbn_no' => $this->request->getPost('isbn_no'),
                'doi' => $this->request->getPost('doi'),
                'impact_factor' => $this->request->getPost('impact_factor'),
                'publication_year' => $this->request->getPost('publication_year'),
                'file_upload' => $studentFileName ?? '',
            ];
            // print_r($data);die;
            $result = $student_book_chapter_model->add($data);
            if ($result === true) {
                $publicationId = $student_book_chapter_model->insertID();
                $authors = $this->request->getPost('author_name');
                if (!empty($authors)) {
                    foreach ($authors as $author) {
                        $authorData = [
                            'student_bookchapter_id' => $publicationId,
                            'author_name' => $author,
                        ];
                        $student_bookchapter_author_model->add($authorData);
                    }
                }
                return redirect()->to('student/book-chapter-details')->with('status', '<div class="alert alert-success" role="alert">Academic details added successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        }
    }

    public function delete_book_chapter_details($id){
        $student_book_chapter_model = new Student_book_chapter_model();
        $student_bookchapter_author_model = new Student_bookchapter_author_model();
        $studentData = $student_book_chapter_model->get($id);
        if ($studentData) {
            if (file_exists("public/admin/uploads/students/" . $studentData['file_upload'])) {
                unlink("public/admin/uploads/students/" . $studentData['file_upload']);
            }
            $result = $student_book_chapter_model->delete($id);
            if ($result === true) {
                $student_bookchapter_author_model->where('student_bookchapter_id', $id)->delete();
                return redirect()->to('student/book-chapter-details')->with('status', '<div class="alert alert-success" role="alert">Book Chapter details deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('student/book-chapter-details')->with('status', '<div class="alert alert-danger" role="alert">Book Chapter details not found.</div>');
        }
    }

    public function patent_details()
    {
        $data = ['title' =>'Patent Details'];
        if ($this->request->is('get')) {
        return view('student/patent-details',$data);
        }else  if ($this->request->is('post')) {
            
        }
    }

    public function copyright_details()
    {
        $data = ['title' =>'Copyright Details'];
        if ($this->request->is('get')) {
        return view('student/copyright-details',$data);
        }else  if ($this->request->is('post')) {
            
        }
    }

    public function achievement_details()
    {
        $data = ['title' =>'Achievements Details'];
        if ($this->request->is('get')) {
        return view('student/achievement-details',$data);
        }else  if ($this->request->is('post')) {
            
        }
    }

    public function experience_details()
    {
        $data = ['title' =>'Experience Details'];
        if ($this->request->is('get')) {
        return view('student/experience-details',$data);
        }else  if ($this->request->is('post')) {
            
        }
    }

}
