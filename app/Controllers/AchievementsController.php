<?php

namespace App\Controllers;

class AchievementsController extends BaseController
{
    public function faculty_awards(){
        $data = ['title' => 'Faculty Awards'];
        if ($this->request->is("get")) {
            return view('admin/awards_achievement/faculty-awards',$data);
        }else if ($this->request->is("post")) {

        }
    }

    public function awards_recognition(){
        $data = ['title' => 'Awards & Recognition'];
        if ($this->request->is("get")) {
            return view('admin/awards_achievement/awards-recognition',$data);
        }else if ($this->request->is("post")) {

        }
    }

    public function student_achievements(){
        $data = ['title' => 'Student Achievements'];
        if ($this->request->is("get")) {
            return view('admin/awards_achievement/student-achievements',$data);
        }else if ($this->request->is("post")) {

        }
    }
}
