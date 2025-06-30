<?php

namespace App\Controllers;

use App\Models\Copyright_author_model;
use App\Models\Copyright_model;
use App\Models\Employee_model;

class CopyrightController extends BaseController
{
    public function copyright_details(){
        $copyright_author_model = new Copyright_author_model();
        $copyright_model = new Copyright_model();
        $employee_model = new Employee_model();
        $data = ['title' => 'Copyright Details'];
        if ($this->request->is("get")) {
            $data['employees'] = $employee_model->get();
            $data['copyright'] = $copyright_model->get();
            return view('admin/copyrights/copyright-details',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $copyright_photo = $this->request->getFile('Copyright_file');
            if ($copyright_photo->isValid() && ! $copyright_photo->hasMoved()) {
                $copyrightImageName = $copyright_photo->getRandomName();
                $copyright_photo->move(ROOTPATH . 'public/admin/uploads/copyright', $copyrightImageName);    
            }else{
                $copyrightImageName = "";
            }
            $author_name = $this->request->getPost('author_name');
            $data =[
                'copyright_title' => $this->request->getPost('Copyright_title'),
                'copyright_number' => $this->request->getPost('Copyright_number'),
                'copyright_description' => $this->request->getPost('description'),
                'submission_date' => $this->request->getPost('submission_date'),
                'grant_date' => $this->request->getPost('grant_date'),
                'upload_file' => $copyrightImageName,
                'employee_id' => implode(",",  $this->request->getPost('emp_id')), //$this->request->getPost('emp_id'),
                'current_status' => $this->request->getPost('current_status'),
                'status' => $this->request->getPost('Copyright_status'),
                'upload_by' => $loggeduserId
            ];
            $result = $copyright_model->add($data);
            if ($result === true) {
                $insertedId = $copyright_model->getInsertID();
                foreach ($author_name as $key => $value) {
                    $data = [
                        'copyright_id' => $insertedId,
                        'author_name' => $value
                    ];
                    $result = $copyright_author_model->add($data);
                }
                return redirect()->to('admin/copyright-details')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/copyright-details')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function edit_copyright_details($id){
        $copyright_author_model = new Copyright_author_model();
        $copyright_model = new Copyright_model();
        $employee_model = new Employee_model();
        $data = ['title' => 'Copyright Details', 'copyrightid' => $id];
        if ($this->request->is("get")) {
            $data['employees'] = $employee_model->get();
            $data['copyright'] = $copyright_model->get();
            $data['copyright_data'] = $copyright_model->get($id);
            $data['copyright_author'] = $copyright_author_model->getByCopyright($id);
            return view('admin/copyrights/edit-copyright-details',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $copyright_data = $copyright_model->get($id);
            $document = $this->request->getFile('Copyright_file');
            $old_document_file = $copyright_data['upload_file'];

            if (empty($old_document_file)) {
                if ($document->isValid() && !$document->hasMoved()) {
                    $document_name = $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/copyright/', $document_name);
                } else {
                    $document_name = null;
                }
            } else {
                if ($document->isValid() && !$document->hasMoved()) {
                    if (file_exists("public/admin/uploads/copyright/" . $old_document_file)) {
                        unlink("public/admin/uploads/copyright/" . $old_document_file);
                    }
                    $document_name = $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/copyright/', $document_name);
                } else {
                    $document_name = $old_document_file;
                }
            }
            $data =[
                'copyright_title' => $this->request->getPost('Copyright_title'),
                'copyright_number' => $this->request->getPost('Copyright_number'),
                'copyright_description' => $this->request->getPost('description'),
                'submission_date' => $this->request->getPost('submission_date'),
                'grant_date' => $this->request->getPost('grant_date'),
                'upload_file' => $document_name,
                'employee_id' => implode(",",  $this->request->getPost('emp_id')), //$this->request->getPost('emp_id'),
                'current_status' => $this->request->getPost('current_status'),
                'status' => $this->request->getPost('Copyright_status'),
                'upload_by' => $loggeduserId
            ];
            $result = $copyright_model->add($data, $id);
            if ($result === true) {
                return redirect()->to('admin/edit-copyright-details/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/edit-copyright-details/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }


    public function add_copyright_author($id){
        $copyright_author_model = new Copyright_author_model();
        $data = [
            'copyright_id' => $id,
            'author_name' => $this->request->getPost('author_name'),
        ];
        $result = $copyright_author_model->add($data);
        if ($result === true) {
            return redirect()->to('admin/edit-copyright-details/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
        } else {
            return redirect()->to('admin/edit-copyright-details/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
        }
    }

    public function delete_copyright_author($id){
        $copyright_author_model = new Copyright_author_model();
        $result = $copyright_author_model->delete($id);
        if ($result) {
            echo "success";
        } else {
            echo "error";
        }
    }

}
