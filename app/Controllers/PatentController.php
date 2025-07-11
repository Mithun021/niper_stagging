<?php

namespace App\Controllers;

use App\Models\Committee_model;
use App\Models\Employee_model;
use App\Models\Patent_author_model;
use App\Models\Patent_current_status_model;
use App\Models\Patent_model;
use App\Models\Patent_type_model;
use App\Models\Patent_webpage_file_model;
use App\Models\Patent_webpage_model;

class PatentController extends BaseController
{
    public function patent_details(){
        $patent_current_status_model = new Patent_current_status_model();
        $patent_type_model = new Patent_type_model();
        $patent_model = new Patent_model();
        $employee_model = new Employee_model();
        $patent_author_model = new Patent_author_model();
        $data = ['title' => 'Patent Details'];
        if ($this->request->is("get")) {
            $data['employees'] = $employee_model->get();
            $data['patent'] = $patent_model->get();
            $data['patent_type'] = $patent_type_model->get();
            $data['patent_current_status'] = $patent_current_status_model->get();
            return view('admin/patent/patent-details',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $patent_photo = $this->request->getFile('patent_file');
            if ($patent_photo->isValid() && ! $patent_photo->hasMoved()) {
                $patentImageName = $patent_photo->getRandomName();
                $patent_photo->move(ROOTPATH . 'public/admin/uploads/patent', $patentImageName);    
            }else{
                $patentImageName = "";
            }
            $author_name = $this->request->getPost('author_name');
            $data =[
                'patent_title' => $this->request->getPost('patent_title'),
                'ipr_number' => $this->request->getPost('ipr_number'),
                'patent_type' => $this->request->getPost('patent_type'),
                'patent_no' => $this->request->getPost('patent_number'),
                'description' => $this->request->getPost('description'),
                'filling_date' => $this->request->getPost('filling_date'),
                'grant_date' => $this->request->getPost('grant_date'),
                'current_status' => $this->request->getPost('current_status'),
                'upload_file' => $patentImageName,
                'employee_id' => implode(",",  $this->request->getPost('emp_id')), //$this->request->getPost('emp_id'),
                'status' => $this->request->getPost('patent_status'),
                'upload_by' => $loggeduserId
            ];
            $result = $patent_model->add($data);
            if ($result === true) {
                $insertedId = $patent_model->getInsertID();
                foreach ($author_name as $key => $value) {
                    $data = [
                        'patent_id' => $insertedId,
                        'author_name' => $value
                    ];
                    $result = $patent_author_model->add($data);
                }
                return redirect()->to('admin/patent-details')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/patent-details')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function edit_patent_details($id){
        $patent_current_status_model = new Patent_current_status_model();
        $patent_type_model = new Patent_type_model();
        $patent_model = new Patent_model();
        $employee_model = new Employee_model();
        $patent_author_model = new Patent_author_model();
        $data = ['title' => 'Patent Details', 'patentid' => $id];
        if ($this->request->is("get")) {
            $data['employees'] = $employee_model->get();
            $data['patent'] = $patent_model->get();
            $data['patent_type'] = $patent_type_model->get();
            $data['patent_current_status'] = $patent_current_status_model->get();
            $data['patent_data'] = $patent_model->get($id);
            $data['patent_author'] = $patent_author_model->getByPatent($id);
            return view('admin/patent/edit-patent-details',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $patent_photo = $this->request->getFile('patent_file');
            if ($patent_photo->isValid() && ! $patent_photo->hasMoved()) {
                $patentImageName = $patent_photo->getRandomName();
                $patent_photo->move(ROOTPATH . 'public/admin/uploads/patent', $patentImageName);    
            }else{
                $patentImageName = "";
            }
            $data =[
                'patent_title' => $this->request->getPost('patent_title'),
                'ipr_number' => $this->request->getPost('ipr_number'),
                'patent_type' => $this->request->getPost('patent_type'),
                'patent_no' => $this->request->getPost('patent_number'),
                'description' => $this->request->getPost('description'),
                'filling_date' => $this->request->getPost('filling_date'),
                'grant_date' => $this->request->getPost('grant_date'),
                'current_status' => $this->request->getPost('current_status'),
                'upload_file' => $patentImageName,
                'employee_id' => implode(",",  $this->request->getPost('emp_id')), //$this->request->getPost('emp_id'),
                'status' => $this->request->getPost('patent_status'),
                'upload_by' => $loggeduserId
            ];
            $result = $patent_model->add($data, $id);
            if ($result === true) {
                return redirect()->to('admin/edit-patent-details/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/edit-patent-details/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function add_patent_author($id){
        $patent_author_model = new Patent_author_model();
        $data = [
            'patent_id' => $id,
            'author_name' => $this->request->getPost('author_name'),
        ];
        $result = $patent_author_model->add($data);
        if ($result === true) {
            return redirect()->to('admin/edit-patent-details/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
        } else {
            return redirect()->to('admin/edit-patent-details/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
        }
    }

    public function delete_patent_author($id){
        $patent_author_model = new Patent_author_model();
        $result = $patent_author_model->delete($id);
        if ($result) {
            echo "success";
        } else {
            echo "error";
        }
    }

    public function delete_patent_details($id){
        $patent_model = new Patent_model();
        $patent_author_model = new Patent_author_model();
        $patent_data = $patent_model->get($id);
        if ($patent_data['upload_file'] != "") {
            if (file_exists("public/admin/uploads/patent/" . $patent_data['upload_file'])) {
                unlink("public/admin/uploads/patent/" . $patent_data['upload_file']);
            }
        }
        $result = $patent_model->delete($id);
        if ($result) {
            $patent_author_model->where('patent_id', $id)->delete();
            return redirect()->to('admin/patent-details')->with('status','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/patent-details')->with('status','<div class="alert alert-danger" role="alert"> Data Delete Failed </div>');
        }
    }

    public function patent_web_page(){
        $patent_webpage_file_model = new Patent_webpage_file_model();
        $patent_webpage_model = new Patent_webpage_model();
        $data = ['title' => 'Patent Web Page'];
        if ($this->request->is("get")) {
            $data['patent_webpage'] = $patent_webpage_model->get();
            return view('admin/patent/patent-web-page',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'upload_by' => $loggeduserId
            ];
            $album_files = $this->request->getFiles();
            $result = $patent_webpage_model->add($data);
            if ($result === true) {
                $insertedId = $patent_webpage_model->getInsertID();
                if ($album_files && isset($album_files['upload_file'])) {
                    foreach ($album_files['upload_file'] as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = $insertedId."webpage".$file->getRandomName();
                            $file->move(ROOTPATH . 'public/admin/uploads/patent', $newName);
        
                            $file_data = [
                                'patent_webpage_id' => $insertedId,
                                'upload_file' => $newName,
                            ];
                            // echo "<pre>"; print_r($file_data);
                            $patent_webpage_file_model->add($file_data);
                        }
                    }
                }
                return redirect()->to('admin/patent-web-page')->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/patent-web-page')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function edit_patent_web_page($id){
        $patent_webpage_file_model = new Patent_webpage_file_model();
        $patent_webpage_model = new Patent_webpage_model();
        $data = ['title' => 'Patent Web Page','patent_webpage_id' => $id];
        if ($this->request->is("get")) {
            $data['patent_webpage'] = $patent_webpage_model->get();
            $data['patent_webpage_data'] = $patent_webpage_model->get($id);
            $data['patent_webpage_file'] = $patent_webpage_file_model->get_by_webpage($id);
            return view('admin/patent/edit-patent-web-page',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'upload_by' => $loggeduserId
            ];
            $album_files = $this->request->getFiles();
            $result = $patent_webpage_model->add($data, $id);
            if ($result === true) {
                if ($album_files && isset($album_files['upload_file'])) {
                    foreach ($album_files['upload_file'] as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = $id."webpage".$file->getRandomName();
                            $file->move(ROOTPATH . 'public/admin/uploads/patent', $newName);
        
                            $file_data = [
                                'patent_webpage_id' => $id,
                                'upload_file' => $newName,
                            ];
                            // echo "<pre>"; print_r($file_data);
                            $patent_webpage_file_model->add($file_data);
                        }
                    }
                }
                return redirect()->to('admin/edit-patent-web-page/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/edit-patent-web-page/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function delete_patent_webpage_file($id){
        $patent_webpage_file_model = new Patent_webpage_file_model();
        $file_data = $patent_webpage_file_model->get($id);
        if ($file_data) {
            $file_path = ROOTPATH . 'public/admin/uploads/patent/' . $file_data['upload_file'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        $patent_webpage_file_model->where('id', $id)->delete();
        echo "success";
    }

    public function delete_patent_web_page($id){
        $patent_webpage_model = new Patent_webpage_model();
        $patent_webpage_file_model = new Patent_webpage_file_model();
        $file_data = $patent_webpage_model->get($id);
        if ($file_data) {
            $patent_webpage_file = $patent_webpage_file_model->get_by_webpage($id);
            foreach ($patent_webpage_file as $key => $value) {
                $file_path = ROOTPATH . 'public/admin/uploads/patent/' . $value['upload_file'];
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
                 $patent_webpage_file_model->delete($value['id']);
            }
            
            // $patent_webpage_file_model->where('patent_webpage_id', $id)->delete();
        }
        $result = $patent_webpage_model->delete($id);
        
        if ($result) {
            return redirect()->to('admin/patent-web-page')->with('status','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/patent-web-page')->with('status','<div class="alert alert-danger" role="alert"> Data Delete Failed </div>');
        }
    }

    public function patent_type(){
        $patent_type_model = new Patent_type_model();
        $data = ['title' => 'Patent Type'];
        if ($this->request->is("get")) {
            $data['patent_type'] = $patent_type_model->get();
            return view('admin/patent/patent-type',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $data = [
                'name' => $this->request->getPost('patent_type'),
                'upload_by' => $loggeduserId
            ];
            $result = $patent_type_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/patent-type')->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/patent-type')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function edit_patent_type($id){
        $patent_type_model = new Patent_type_model();
        $data = ['title' => 'Patent Type', 'patent_type_id' => $id];
        if ($this->request->is("get")) {
            $data['patent_type'] = $patent_type_model->get();
            $data['patent_type_data'] = $patent_type_model->get($id);
            return view('admin/patent/edit-patent-type',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $data = [
                'name' => $this->request->getPost('patent_type'),
                'upload_by' => $loggeduserId
            ];
            $result = $patent_type_model->add($data,$id);
            if ($result === true) {
                return redirect()->to('admin/edit-patent-type/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/edit-patent-type/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function delete_patent_type($id){
        $patent_type_model = new Patent_type_model();
        $result = $patent_type_model->delete($id);
        if ($result) {
            return redirect()->to('admin/patent-type')->with('status','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/patent-type')->with('status','<div class="alert alert-danger" role="alert"> Data Delete Failed </div>');
        }
    }

    public function current_status(){
        $patent_current_status_model = new Patent_current_status_model();
        $data = ['title' => 'Current Staus'];
        if ($this->request->is("get")) {
            $data['current_status'] = $patent_current_status_model->get();
            return view('admin/patent/current-status',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $data = [
                'name' => $this->request->getPost('current_staus'),
                'upload_by' => $loggeduserId
            ];
            $result = $patent_current_status_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/current-status')->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/current-status')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function edit_current_status($id){
        $patent_current_status_model = new Patent_current_status_model();
        $data = ['title' => 'Current Staus', 'current_status_id' => $id];
        if ($this->request->is("get")) {
            $data['current_status'] = $patent_current_status_model->get();
            $data['current_status_data'] = $patent_current_status_model->get($id);
            return view('admin/patent/edit-current-status',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $data = [
                'name' => $this->request->getPost('current_staus'),
                'upload_by' => $loggeduserId
            ];
            $result = $patent_current_status_model->add($data, $id);
            if ($result === true) {
                return redirect()->to('admin/edit-current-status/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/edit-current-status/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function delete_current_status($id){
        $patent_current_status_model = new Patent_current_status_model();
        $result = $patent_current_status_model->delete($id);
        if ($result) {
            return redirect()->to('admin/current-status')->with('status','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/current-status')->with('status','<div class="alert alert-danger" role="alert"> Data Delete Failed </div>');
        }
    }
    
}
