<?php
    namespace App\Controllers;

use App\Models\Department_model;
use App\Models\Department_photos_file_model;
use App\Models\Department_photos_model;
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
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $data = [
                    'name' => $this->request->getPost('dept_name'),
                    'description' => $this->request->getPost('description'),
                    'status' => $this->request->getPost('status'),
                    'upload_by' => $loggeduserId,
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


        public function departments_photos() {
            $department_model = new Department_model();
            $department_photos_model = new Department_photos_model();
            $department_photos_file_model = new Department_photos_file_model();
            $data = ['title' => 'Dept. Photo Album'];
            if ($this->request->is("get")) {
                $data['department'] = $department_model->activeData();
                $data['albums'] = $department_photos_model->get();
                return view('admin/department/departments-photos', $data);
            } else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                $loggeduserId = $sessionData['loggeduserId'] ?? null;
        
                if (!$loggeduserId) {
                    return redirect()->to('admin/departments-photos')->with(
                        'status', 
                        '<div class="alert alert-danger" role="alert"> User session is not valid. Please log in again. </div>'
                    );
                }
        
                $dept_id = $this->request->getPost('dept_id');
                if (empty($dept_id)) {
                    return redirect()->to('admin/departments-photos')->with(
                        'status', 
                        '<div class="alert alert-danger" role="alert"> Album title cannot be empty. </div>'
                    );
                }
        
                $album_data = [
                    'dept_id' => $dept_id,
                    'upload_by' => $loggeduserId,
                ];
        
                $album_id = $department_photos_model->add($album_data);
                if (!$album_id) {
                    return redirect()->to('admin/departments-photos')->with(
                        'status', 
                        '<div class="alert alert-danger" role="alert"> Failed to create photo album. Please try again. </div>'
                    );
                }
        
                $album_files = $this->request->getFiles();
                if ($album_files && isset($album_files['album_file'])) {
                    foreach ($album_files['album_file'] as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = $file->getRandomName();
                            $file->move(ROOTPATH . 'public/admin/uploads/department', $newName);
        
                            $file_data = [
                                'dept_photos_id' => $album_id,
                                'file_name' => $newName,
                            ];
                            // echo "<pre>"; print_r($file_data);
                            $department_photos_file_model->add($file_data);
                        }
                    }
                }
                //  die;
                return redirect()->to('admin/departments-photos')->with(
                    'status', 
                    '<div class="alert alert-success" role="alert"> Data added successfully. </div>'
                );
            }
        
            return redirect()->to('admin/departments-photos')->with(
                'status', 
                '<div class="alert alert-danger" role="alert"> Invalid request method. </div>'
            );
        }

    }
?>