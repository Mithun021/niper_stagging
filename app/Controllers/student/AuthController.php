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
                session()->remove(['loggedstudentName','loggedstudentId', 'studentLoginned']);
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

    public function forget_password(){
        $student_model = new Student_model();
        $data = ['title' => 'Forget Password'];
        if ($this->request->is('get')) {
            return view('student/forget-password', $data);
        } else if ($this->request->is('post')) {
            $student_id = $this->request->getPost('student_id');
            $student = $student_model->where('personal_mail', $student_id)->orWhere('enrollment_no',$student_id)->first();
            if ($student) {
                $email = $student['personal_mail'];
                helper('text');
               echo $token = random_string('alnum', 64);
                $expiry = date("Y-m-d H:i:s", strtotime('+10 minutes'));
            }
        }
        return redirect()->back()->with('status', '<div class="alert alert-danger" role="alert">Email not found</div>');
        
    }
    public function reset_password(){
        $data = ['title' => 'Reset Password'];
        if ($this->request->is('get')) {
            return view('student/reset-password', $data);
        }else if ($this->request->is('post')) {

        }
    }

    public function logout(){
        $session = session();
        session_unset();
        session_destroy();
        return redirect()->to(base_url('stdlogin'));    
    }
}
