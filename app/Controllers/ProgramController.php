<?php
    namespace App\Controllers;

use App\Models\Program_model;

    class ProgramController extends BaseController{
        public function program(){
            $program_model = new Program_model();
            $data = ['title' => 'Program'];
            if ($this->request->is("get")) {
                $data['program'] = $program_model->get();
                return view('admin/program/program',$data);
            }else if ($this->request->is("post")) {
                $data = [
                    'name' => $this->request->getPost('program_title'),
                    'description' => $this->request->getPost('program_description')
                ];

               $result = $program_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/program')->with('msg','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/program')->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }
    }
?>