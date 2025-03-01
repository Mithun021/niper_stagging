<?php

namespace App\Controllers;

class Adjunt_facultyController extends BaseController
{
    public function other_faculty()
    {
        $data = ['title' => 'Other Facuty Details'];
        if ($this->request->is("get")) {
            return view('admin/adjunt_faculty/other-faculty',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
        }
    }

    public function adjunt_faculty_webpage()
    {
        $data = ['title' => 'Adjunt Facuty Webpage'];
        if ($this->request->is("get")) {
            return view('admin/adjunt_faculty/adjunt-faculty-webpage',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
        }
    }
}
