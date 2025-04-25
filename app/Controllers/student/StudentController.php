<?php

namespace App\Controllers\student;

use App\Controllers\BaseController;
use App\Models\Employee_model;
use App\Models\Program_department_mapping_model;
use App\Models\Student_model;
use App\Models\Student_prog_dept_mapping_model;

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
        if ($this->request->is('get')) {
            return view('student/personal-details',$data);
        }else  if ($this->request->is('post')) {
            
        }
    }

    public function academic_details()
    {
        $data = ['title' =>'Academic Details'];
        if ($this->request->is('get')) {
        return view('student/academic-details',$data);
        }else  if ($this->request->is('post')) {
            
        }
    }

    public function phd_details()
    {
        $data = ['title' =>'PHD Details'];
        if ($this->request->is('get')) {
        return view('student/phd-details',$data);
        }else  if ($this->request->is('post')) {
            
        }
    }

    public function publication_details()
    {
        $data = ['title' =>'Publication Details'];
        if ($this->request->is('get')) {
        return view('student/publication-details',$data);
        }else  if ($this->request->is('post')) {
            
        }
    }

    public function book_chapter_details()
    {
        $data = ['title' =>'Book Chapter Details'];
        if ($this->request->is('get')) {
        return view('student/book-chapter-details',$data);
        }else  if ($this->request->is('post')) {
            
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
