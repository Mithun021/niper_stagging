<?php

namespace App\Controllers\student;

use App\Controllers\BaseController;
use App\Models\Student_model;

class AuthController extends BaseController
{
    public function login()
    {
        $student_model = new Student_model();
        $data = ['title' => 'Student Login'];
        if ($this->request->is('get')) {
            return view('student/login', $data);
        } else if ($this->request->is('post')) {
            $userId = $this->request->getPost('userId');
            $userPassword = $this->request->getVar('userPassword');

            $data = $student_model->where('enrollment_no', $userId)->first();
            if ($data) {
                $session_data = [
                    'loggedstudentName' => $data['first_name'],
                    'loggedstudentId' => $data['id']
                ];
                if (password_verify($userPassword, $data['password'])) {
                    $this->session->set('loggedStudentData', $session_data);
                    $this->session->set('studentLoginned', "studentLoginned");
                    echo "dataMatch";
                } else {
                    echo 'User ID or Password Mismatch';
                }
            } else {
                echo "Given Userid not found";
            }
        }
    }
}
