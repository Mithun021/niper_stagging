<?php
    namespace App\Controllers;

use App\Models\Department_model;
use App\Models\Program_model;

    class DepartmentController extends BaseController{
        public function departments_section(){
            $program_model = new Program_model();
            $department_model = new Department_model();
            $data = ['title' => 'Departments'];
            if ($this->request->is("get")) {
                $data['program'] = $program_model->get();
                $data['department'] = $department_model->get();
                return view('admin/department/departments-section',$data);
            }else if ($this->request->is("post")) {
                $profile_image = $this->request->getFile('photoupload');
                if ($profile_image->isValid() && ! $profile_image->hasMoved()) {
                    $imageName = $profile_image->getRandomName();
                    $profile_image->move(ROOTPATH . 'public/admin/uploads/department', $imageName);    
                }else{
                 $imageName = "invalidImage.png";
                }
                
                $data = [
                    'name' => $this->request->getPost('dept_name'),
                    'description' => $this->request->getPost('description'),
                    'program_id' => $this->request->getPost('program_id'),
                    'files' => $imageName,
                ];
                $save = $department_model->add($data);
                
                if ($save) {
                    return redirect()->to('admin/departments-section/')->with('msg','<div class="alert alert-success" role="alert"> Add Successful </div>');
                }
                else{
                    return redirect()->to('admin/departments-section/')->with('msg','<div class="alert alert-danger" role="alert"> Failed to add </div>');
                }
            }
        }
    }
?>