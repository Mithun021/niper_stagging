<?php

namespace App\Controllers\student;

use App\Controllers\BaseController;

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
        $data = ['title' =>'Personal Details'];
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
