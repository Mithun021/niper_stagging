<?php

namespace App\Controllers;

class DynamicformControllers extends BaseController
{
    public function form_details(){
        $data = ['title' => 'Form Details'];
        if ($this->request->is("get")) {
            return view('admin/dymanic_form/form-details',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
        }
    }

    public function form_section(){
        $data = ['title' => 'Departments'];
        if ($this->request->is("get")) {
            return view('admin/dymanic_form/form-section',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
        }
    }
}
