<?php

namespace App\Controllers;

use App\Models\Awards_recognition_model;
use App\Models\Courses_model;
use App\Models\Department_model;
use App\Models\Designation_model;
use App\Models\Employee_model;
use App\Models\Faculty_awards_gallery_model;
use App\Models\Faculty_awards_mapping_model;
use App\Models\Faculty_awards_model;
use App\Models\Program_model;
use App\Models\Student_achievement_mapping_model;
use App\Models\Student_achievement_model;
use App\Models\Student_prog_dept_mapping_model;

class AchievementsController extends BaseController
{
    public function faculty_awards()
    {
        $faculty_awards_mapping_model = new Faculty_awards_mapping_model();
        $department_model = new Department_model();
        $designation_model = new Designation_model();
        $faculty_awards_model = new Faculty_awards_model();
        $faculty_awards_gallery_model = new Faculty_awards_gallery_model();
        $data = ['title' => 'Faculty Awards'];
        if ($this->request->is("get")) {
            $data['departments'] = $department_model->get();
            $data['designations'] = $designation_model->get();
            $data['faculty_awards'] = $faculty_awards_model->get();
            return view('admin/awards_achievement/faculty-awards', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $upload_file = $this->request->getFile('upload_file');
            if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                $upload_file_new_name = 'faculty' . $upload_file->getRandomName();
                $upload_file->move(ROOTPATH . 'public/admin/uploads/achievements', $upload_file_new_name);
            } else {
                $upload_file_new_name = "";
            }
            $data = [
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'thumbnail' => $upload_file_new_name,
                'award_date' => $this->request->getVar('awards_date'),
                'agency_name' => $this->request->getVar('agency_name'),
                'upload_by' => $loggeduserId,
            ];
            $faculty_name = $this->request->getVar('faculty_name');
            $result = $faculty_awards_model->add($data);
            if ($result) {
                $insert_id = $faculty_awards_model->getInsertID();

                foreach ($faculty_name as $key => $value) {
                    $data2 = [
                        'faculty_award_id' => $insert_id,
                        'faculty_name' => $value,
                        'department_id' => $this->request->getVar('department')[$key],
                        'designation_id' => $this->request->getVar('designation')[$key],
                    ];
                    $faculty_awards_mapping_model->add($data2);
                }

                $file_gallery = $this->request->getFiles();
                if ($file_gallery && isset($file_gallery['file_gallery'])) {
                    foreach ($file_gallery['file_gallery'] as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = $insert_id . "gallery" . $file->getRandomName();
                            $file->move(ROOTPATH . 'public/admin/uploads/achievements', $newName);

                            $file_data = [
                                'faculty_award_id' => $insert_id,
                                'gallery_file' => $newName,
                            ];
                            // echo "<pre>"; print_r($file_data);
                            $faculty_awards_gallery_model->add($file_data);
                        }
                    }
                }
                return redirect()->to('admin/faculty-awards')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/faculty-awards')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function edit_faculty_awards($id)
    {
        $faculty_awards_mapping_model = new Faculty_awards_mapping_model();
        $department_model = new Department_model();
        $designation_model = new Designation_model();
        $faculty_awards_model = new Faculty_awards_model();
        $faculty_awards_gallery_model = new Faculty_awards_gallery_model();
        $data = ['title' => 'Faculty Awards', 'awards_id' => $id];
        if ($this->request->is("get")) {
            $data['departments'] = $department_model->get();
            $data['designations'] = $designation_model->get();
            $data['faculty_awards'] = $faculty_awards_model->get();
            $data['faculty_awards_data'] = $faculty_awards_model->get($id);
            $data['faculty_awards_mapped'] = $faculty_awards_mapping_model->get_by_faculty_award_id($id);
             $data['faculty_awards_gallery'] = $faculty_awards_gallery_model->get_by_faculty_award_id($id);
            return view('admin/awards_achievement/edit-faculty-awards', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $faculty_awards_data = $faculty_awards_model->get($id);
            $document = $this->request->getFile('upload_file');
            $old_document_file = $faculty_awards_data['thumbnail'];
            if (empty($old_document_file)) {
                if ($document->isValid() && !$document->hasMoved()) {
                    $document_name = "faculty" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/achievements/', $document_name);
                } else {
                    $document_name = null;
                }
            } else {
                if ($document->isValid() && !$document->hasMoved()) {
                    if (file_exists("public/admin/uploads/achievements/" . $old_document_file)) {
                        unlink("public/admin/uploads/achievements/" . $old_document_file);
                    }
                    $document_name = "faculty" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/achievements/', $document_name);
                } else {
                    $document_name = $old_document_file;
                }
            }

            $data = [
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'thumbnail' => $document_name,
                'award_date' => $this->request->getVar('awards_date'),
                'agency_name' => $this->request->getVar('agency_name'),
                'upload_by' => $loggeduserId,
            ];
            $result = $faculty_awards_model->add($data, $id);
            if ($result) {

                $file_gallery = $this->request->getFiles();
                if ($file_gallery && isset($file_gallery['file_gallery'])) {
                    foreach ($file_gallery['file_gallery'] as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = $id . "gallery" . $file->getRandomName();
                            $file->move(ROOTPATH . 'public/admin/uploads/achievements', $newName);

                            $file_data = [
                                'faculty_award_id' => $id,
                                'gallery_file' => $newName,
                            ];
                            // echo "<pre>"; print_r($file_data);
                            $faculty_awards_gallery_model->add($file_data);
                        }
                    }
                }
                return redirect()->to('admin/edit-faculty-awards/'.$id)->with('status', '<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/edit-faculty-awards/'.$id)->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function add_new_awarded_faculty($id){
        $faculty_awards_mapping_model = new Faculty_awards_mapping_model();
        $data = [
            'faculty_award_id' => $id,
            'faculty_name' => $this->request->getVar('faculty_name'),
            'department_id' => $this->request->getVar('department'),
            'designation_id' => $this->request->getVar('designation'),
        ];
        if ($faculty_awards_mapping_model->add($data)) {
            return redirect()->to('admin/edit-faculty-awards/'.$id)->with('status', '<div class="alert alert-success" role="alert"> Faculty Added Successfully </div>');
        } else {
            return redirect()->to('admin/edit-faculty-awards/'.$id)->with('status', '<div class="alert alert-danger" role="alert"> Failed to Add Faculty </div>');
        }
    }

    public function delete_awarded_faculty($id){
        $faculty_awards_mapping_model = new Faculty_awards_mapping_model();

        $result = $faculty_awards_mapping_model->delete($id);

        if ($result) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to delete faculty award mapping.'
            ]);
        }
    }

    public function delete_awarded_gallery($id){
        $faculty_awards_gallery_model = new Faculty_awards_gallery_model();
        $gallery_data = $faculty_awards_gallery_model->get($id);
        if ($gallery_data) {
            if (file_exists("public/admin/uploads/achievements/" . $gallery_data['gallery_file'])) {
                unlink("public/admin/uploads/achievements/" . $gallery_data['gallery_file']);
            }
        }
        $result = $faculty_awards_gallery_model->delete($id);
        if ($result) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to delete faculty award gallery.'
            ]);
        }
    }

    public function delete_faculty_awards($id){
        $faculty_awards_model = new Faculty_awards_model();
        $faculty_awards_mapping_model = new Faculty_awards_mapping_model();
        $faculty_awards_gallery_model = new Faculty_awards_gallery_model();

        // Delete associated gallery files
        $gallery_files = $faculty_awards_gallery_model->get_by_faculty_award_id($id);
        foreach ($gallery_files as $file) {
            if (file_exists("public/admin/uploads/achievements/" . $file['gallery_file'])) {
                unlink("public/admin/uploads/achievements/" . $file['gallery_file']);
            }
        }
        $faculty_awards_gallery_model->where('faculty_award_id', $id)->delete();

        // Delete associated mappings
        $faculty_awards_mapping_model->where('faculty_award_id', $id)->delete();

        // Finally, delete the faculty award
        $result = $faculty_awards_model->delete($id);

        if ($result) {
            return redirect()->to('admin/faculty-awards')->with('status', '<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/faculty-awards')->with('status', '<div class="alert alert-danger" role="alert"> Data Delete Failed </div>');
        }
    }


    public function awards_recognition()
    {
        $awards_recognition_model = new Awards_recognition_model();
        $data = ['title' => 'Awards & Recognition'];
        if ($this->request->is("get")) {
            $data['awards_recognition'] = $awards_recognition_model->get();
            return view('admin/awards_achievement/awards-recognition', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $upload_file = $this->request->getFile('upload_file');
            if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                $upload_file_new_name = 'awards' . $upload_file->getRandomName();
                $upload_file->move(ROOTPATH . 'public/admin/uploads/achievements', $upload_file_new_name);
            } else {
                $upload_file_new_name = "";
            }
            $data = [
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'upload_file' => $upload_file_new_name,
                'upload_by' => $loggeduserId,
            ];
            $result = $awards_recognition_model->add($data);
            if ($result) {
                return redirect()->to('admin/awards-recognition')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/awards-recognition')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function edit_awards_recognition($id)
    {
        $awards_recognition_model = new Awards_recognition_model();
        $data = ['title' => 'Awards & Recognition', 'awards_id' => $id];
        if ($this->request->is("get")) {
            $data['awards_recognition'] = $awards_recognition_model->get();
            $data['awards_recognition_data'] = $awards_recognition_model->get($id);
            return view('admin/awards_achievement/edit-awards-recognition', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $awards_recognition_data = $awards_recognition_model->get($id);
            $document = $this->request->getFile('upload_file');
            $old_document_file = $awards_recognition_data['upload_file'];
            if (empty($old_document_file)) {
                if ($document->isValid() && !$document->hasMoved()) {
                    $document_name = "awards" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/achievements/', $document_name);
                } else {
                    $document_name = null;
                }
            } else {
                if ($document->isValid() && !$document->hasMoved()) {
                    if (file_exists("public/admin/uploads/achievements/" . $old_document_file)) {
                        unlink("public/admin/uploads/achievements/" . $old_document_file);
                    }
                    $document_name = "awards" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/achievements/', $document_name);
                } else {
                    $document_name = $old_document_file;
                }
            }

            $data = [
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'upload_file' => $document_name,
                'upload_by' => $loggeduserId,
            ];
            $result = $awards_recognition_model->add($data, $id);
            if ($result) {
                return redirect()->to('admin/edit-awards-recognition/'.$id)->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/edit-awards-recognition/'.$id)->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function delete_awards_recognition($id)
    {
        $awards_recognition_model = new Awards_recognition_model();
        $awards_recognition_data = $awards_recognition_model->get($id);
        if ($awards_recognition_data) {
            if (file_exists("public/admin/uploads/achievements/" . $awards_recognition_data['upload_file'])) {
                unlink("public/admin/uploads/achievements/" . $awards_recognition_data['upload_file']);
            }
        }
        $result = $awards_recognition_model->delete($id);
        if ($result) {
            return redirect()->to('admin/awards-recognition')->with('status', '<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/awards-recognition')->with('status', '<div class="alert alert-danger" role="alert"> Data Delete Failed </div>');
        }
    }

    public function student_achievements()
    {
        $student_achievement_mapping_model = new Student_achievement_mapping_model();
        $employee_model = new Employee_model();
        $department_model = new Department_model();
        $courses_model = new Courses_model();
        $program_model = new Program_model();
        $student_achievement_model = new Student_achievement_model();
        $data = ['title' => 'Student Achievements'];
        if ($this->request->is("get")) {
            $data['employee'] = $employee_model->get();
            $data['department'] = $department_model->get();
            $data['program'] = $program_model->get();
            $data['student_acchievement'] = $student_achievement_model->get();
            return view('admin/awards_achievement/student-achievements', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $upload_file = $this->request->getFile('upload_file');
            if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                $upload_file_new_name = 'student' . $upload_file->getRandomName();
                $upload_file->move(ROOTPATH . 'public/admin/uploads/achievements', $upload_file_new_name);
            } else {
                $upload_file_new_name = "";
            }
            $data = [
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'award_date' => $this->request->getVar('awards_date'),
                'agency_name' => $this->request->getVar('agency_name'),
                'upload_file' => $upload_file_new_name,
                'upload_by' => $loggeduserId,
            ];
            $student_name = $this->request->getVar('student_name');
            $result = $student_achievement_model->add($data);
            if ($result) {
                $insert_id  = $student_achievement_model->getInsertID();
                foreach ($student_name as $key => $value) {
                    $data2 = [
                        'student_achievement_mapping_id' => $insert_id,
                        'student_name' => $value,
                        'department_id' => $this->request->getVar('department')[$key],
                        'course_id' => $this->request->getVar('course')[$key],
                        'supervisor_id' => $this->request->getVar('supervisor')[$key],
                    ];
                    $student_achievement_mapping_model->add($data2);
                }
                return redirect()->to('admin/student-achievements')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/student-achievements')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function edit_student_achievements($id)
    {
        $student_achievement_mapping_model = new Student_achievement_mapping_model();
        $employee_model = new Employee_model();
        $department_model = new Department_model();
        $courses_model = new Courses_model();
        $program_model = new Program_model();
        $student_achievement_model = new Student_achievement_model();
        $data = ['title' => 'Student Achievements','achievement_id' => $id];
        if ($this->request->is("get")) {
            $data['employee'] = $employee_model->get();
            $data['department'] = $department_model->get();
            $data['program'] = $program_model->get();
            $data['student_acchievement'] = $student_achievement_model->get();
            $data['student_acchievement_data'] = $student_achievement_model->get($id);
            return view('admin/awards_achievement/edit-student-achievements', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $student_acchievement_data = $student_achievement_model->get($id);
            $document = $this->request->getFile('upload_file');
            $old_document_file = $student_acchievement_data['upload_file'];
            if (empty($old_document_file)) {
                if ($document->isValid() && !$document->hasMoved()) {
                    $document_name = "student" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/achievements/', $document_name);
                } else {
                    $document_name = null;
                }
            } else {
                if ($document->isValid() && !$document->hasMoved()) {
                    if (file_exists("public/admin/uploads/achievements/" . $old_document_file)) {
                        unlink("public/admin/uploads/achievements/" . $old_document_file);
                    }
                    $document_name = "student" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/achievements/', $document_name);
                } else {
                    $document_name = $old_document_file;
                }
            }

            $data = [
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'award_date' => $this->request->getVar('awards_date'),
                'agency_name' => $this->request->getVar('agency_name'),
                'upload_file' => $document_name,
                'upload_by' => $loggeduserId,
            ];
            $result = $student_achievement_model->add($data);
            if ($result) {
                return redirect()->to('admin/edit-student-achievements/'.$id)->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/edit-student-achievements/'.$id)->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }
}
