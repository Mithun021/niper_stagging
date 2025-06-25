<?php

namespace App\Controllers;

use App\Models\Department_model;
use App\Models\Job_category_model;
use App\Models\Job_detail_model;
use App\Models\Job_extension_model;
use App\Models\Job_result_model;
use App\Models\Job_result_postdata_model;
use App\Models\Job_videolink_model;
use App\Models\Job_weblink_model;
use App\Models\Result_category_model;

class JobControllers extends BaseController
{
    public function job_category(){
        $job_category_model = new Job_category_model();
        $data = ['title' => 'Job Category'];
        if ($this->request->is("get")) {
            $data['job_category'] = $job_category_model->get();
            return view('admin/jobs/job-category',$data);
        }else if ($this->request->is("post")) {
            $data =[
                'name' => $this->request->getPost('category_name'),
            ];
            $result = $job_category_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/job-category')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/job-category')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function result_category(){
        $result_category_model = new Result_category_model();
        $data = ['title' => 'Result Category'];
        if ($this->request->is("get")) {
            $data['result_category'] = $result_category_model->get();
            return view('admin/jobs/result-category',$data);
        }else if ($this->request->is("post")) {
            $data =[
                'name' => $this->request->getPost('category_name'),
            ];
            $result = $result_category_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/result-category')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/result-category')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function job_details(){
        $department_model = new Department_model();
        $job_category_model = new Job_category_model();
        $job_detail_model = new Job_detail_model();
        $data = ['title' => 'Job Details'];
        if ($this->request->is("get")) {
            $data['department'] = $department_model->activeData();
            $data['job_category'] = $job_category_model->get();
            $data['job_details'] = $job_detail_model->get();
            return view('admin/jobs/job-details',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }

            $adv_file = $this->request->getFile('adv_file');
            if ($adv_file->isValid() && ! $adv_file->hasMoved()) {
                $adv_fileImageName = "adv".$adv_file->getRandomName();
                $adv_file->move(ROOTPATH . 'public/admin/uploads/jobs', $adv_fileImageName);    
            }else{
                $adv_fileImageName = "";
            }

            $syllabus_file = $this->request->getFile('syllabus_file');
            if ($syllabus_file->isValid() && ! $syllabus_file->hasMoved()) {
                $syllabus_fileImageName = "syllabus".$syllabus_file->getRandomName();
                $syllabus_file->move(ROOTPATH . 'public/admin/uploads/jobs', $syllabus_fileImageName);    
            }else{
                $syllabus_fileImageName = "";
            }

            $data =[
                'title' => $this->request->getPost('job_title'),
                'description' => $this->request->getPost('description'),
                'adv_reference_no' => $this->request->getPost('reference_no'),
                'adv_apply_link' => $this->request->getPost('apply_link'),
                'job_type_id' => $this->request->getPost('adv_type'),
                // 'department_id' => $this->request->getPost('department'),
                'application_start_date' => $this->request->getPost('application_start_date'),
                'application_start_time' => $this->request->getPost('application_start_time'),
                'application_end_date' => $this->request->getPost('application_end_date'),
                'application_end_time' => $this->request->getPost('application_end_time'),
                'hardcopy_last_date' => $this->request->getPost('hardcopy_last_date'),
                'hardcopy_last_time' => $this->request->getPost('hardcopy_last_time'),
                // 'revised_app_last_date' => $this->request->getPost('revised_app_last_date'),
                // 'revised_app_last_time' => $this->request->getPost('revised_app_last_time'),
                // 'revised_copy_last_date' => $this->request->getPost('revised_copy_last_date'),
                // 'revised_copy_last_time' => $this->request->getPost('revised_copy_last_time'),
                'payment_link' => $this->request->getPost('payment_link'),
                'adv_file' => $adv_fileImageName,
                'syllabus_file' => $syllabus_fileImageName,
                'status' => $this->request->getPost('status'),
                'upload_by' => $loggeduserId
            ];
            $result = $job_detail_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/job-details')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/job-details')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function edit_job_details($id){
        $department_model = new Department_model();
        $job_category_model = new Job_category_model();
        $job_detail_model = new Job_detail_model();
        $data = ['title' => 'Job Details', 'job_id' => $id];
        if ($this->request->is("get")) {
            $data['department'] = $department_model->activeData();
            $data['job_category'] = $job_category_model->get();
            $data['job_details'] = $job_detail_model->get();
            $data['job_data'] = $job_detail_model->get($id);
            return view('admin/jobs/edit-job-details',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $job_data = $job_detail_model->get($id);
            $adv_file = $this->request->getFile('adv_file');
            $old_adv_file = $job_data['adv_file'];

            if (empty($old_adv_file)) {
                if ($adv_file->isValid() && !$adv_file->hasMoved()) {
                    $adv_file_name = "adv" . $adv_file->getRandomName();
                    $adv_file->move(ROOTPATH . 'public/admin/uploads/jobs/', $adv_file_name);
                } else {
                    $adv_file_name = null;
                }
            } else {
                if ($adv_file->isValid() && !$adv_file->hasMoved()) {
                    if (file_exists("public/admin/uploads/jobs/" . $old_adv_file)) {
                        unlink("public/admin/uploads/jobs/" . $old_adv_file);
                    }
                    $adv_file_name = "adv" . $adv_file->getRandomName();
                    $adv_file->move(ROOTPATH . 'public/admin/uploads/jobs/', $adv_file_name);
                } else {
                    $adv_file_name = $old_adv_file;
                }
            }

            $syllabus_file = $this->request->getFile('syllabus_file');
            $old_syllabus_file = $job_data['syllabus_file'];

            if (empty($old_syllabus_file)) {
                if ($syllabus_file->isValid() && !$syllabus_file->hasMoved()) {
                    $syllabus_file_name = "syllabus" . $syllabus_file->getRandomName();
                    $syllabus_file->move(ROOTPATH . 'public/admin/uploads/jobs/', $syllabus_file_name);
                } else {
                    $syllabus_file_name = null;
                }
            } else {
                if ($syllabus_file->isValid() && !$syllabus_file->hasMoved()) {
                    if (file_exists("public/admin/uploads/jobs/" . $old_syllabus_file)) {
                        unlink("public/admin/uploads/jobs/" . $old_syllabus_file);
                    }
                    $syllabus_file_name = "syllabus" . $syllabus_file->getRandomName();
                    $syllabus_file->move(ROOTPATH . 'public/admin/uploads/jobs/', $syllabus_file_name);
                } else {
                    $syllabus_file_name = $old_syllabus_file;
                }
            }

            $data =[
                'title' => $this->request->getPost('job_title'),
                'description' => $this->request->getPost('description'),
                'adv_reference_no' => $this->request->getPost('reference_no'),
                'adv_apply_link' => $this->request->getPost('apply_link'),
                'job_type_id' => $this->request->getPost('adv_type'),
                // 'department_id' => $this->request->getPost('department'),
                'application_start_date' => $this->request->getPost('application_start_date'),
                'application_start_time' => $this->request->getPost('application_start_time'),
                'application_end_date' => $this->request->getPost('application_end_date'),
                'application_end_time' => $this->request->getPost('application_end_time'),
                'hardcopy_last_date' => $this->request->getPost('hardcopy_last_date'),
                'hardcopy_last_time' => $this->request->getPost('hardcopy_last_time'),
                // 'revised_app_last_date' => $this->request->getPost('revised_app_last_date'),
                // 'revised_app_last_time' => $this->request->getPost('revised_app_last_time'),
                // 'revised_copy_last_date' => $this->request->getPost('revised_copy_last_date'),
                // 'revised_copy_last_time' => $this->request->getPost('revised_copy_last_time'),
                'payment_link' => $this->request->getPost('payment_link'),
                'adv_file' => $adv_file_name,
                'syllabus_file' => $syllabus_file_name,
                'status' => $this->request->getPost('status'),
                'upload_by' => $loggeduserId
            ];
            $result = $job_detail_model->add($data, $id);
            if ($result === true) {
                return redirect()->to('admin/edit-job-details/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/edit-job-details/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function delete_job_details($id){
        $job_detail_model = new Job_detail_model();
        $job_data = $job_detail_model->get($id);
        if ($job_data) {
            if (file_exists("public/admin/uploads/jobs/" . $job_data['adv_file'])) {
                unlink("public/admin/uploads/jobs/" . $job_data['adv_file']);
            }
            if (file_exists("public/admin/uploads/jobs/" . $job_data['syllabus_file'])) {
                unlink("public/admin/uploads/jobs/" . $job_data['syllabus_file']);
            }
            $result = $job_detail_model->delete($id);
            if ($result === true) {
                return redirect()->to('admin/job-details')->with('status','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
            } else {
                return redirect()->to('admin/job-details')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        } else {
            return redirect()->to('admin/job-details')->with('status','<div class="alert alert-danger" role="alert"> Job not found </div>');
        }
    }

    public function job_result(){
        $job_detail_model = new Job_detail_model();
        $job_result_model = new Job_result_model();
        $result_category_model = new Result_category_model();
        $data = ['title' => 'Job Result'];
        if ($this->request->is("get")) {
            $data['job_details'] = $job_detail_model->get();
            $data['job_result'] = $job_result_model->get();
            $data['result_category'] = $result_category_model->get();
            return view('admin/jobs/job-result',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $resultfile = $this->request->getFile('resultfile');
            if ($resultfile->isValid() && ! $resultfile->hasMoved()) {
                $resultfileImageName = "result".$resultfile->getRandomName();
                $resultfile->move(ROOTPATH . 'public/admin/uploads/jobs', $resultfileImageName);    
            }else{
                $resultfileImageName = "";
            }

            $data = [
                'jobs_id' => $this->request->getPost('advid'),
                'result_title' => $this->request->getPost('resultitle'),
                'result_description' => $this->request->getPost('resultdesc'),
                'file_upload' => $resultfileImageName,
                'result_type' => $this->request->getPost('resulttype'),
                // 'corrigendum' => $this->request->getPost('corrigendum'),
                'status' => $this->request->getPost('result_status'),
                'upload_by' => $loggeduserId
            ];
            $result = $job_result_model->add($data);
            if ($result === true) {
                $insertedId = $job_result_model->getInsertID();
                $awards_photo = $this->request->getFileMultiple('upload_file');
                $postcode = $this->request->getPost('postcode');
                if (!empty($postcode)) {
                    $job_result_postdata_model = new Job_result_postdata_model();
                    foreach ($postcode as $key => $value) {
                        $photo = $awards_photo[$key];
                        $photoName = "";
                        if ($photo->isValid() && !$photo->hasMoved()) {
                            $photoName = "post".$photo->getRandomName();
                            $photo->move(ROOTPATH . 'public/admin/uploads/jobs', $photoName);
                        }
                        $postdata = [
                            'job_result_id' => $insertedId,
                            'postcode' => $value,
                            'postname' => $this->request->getPost('postname')[$key],
                            'description' => $this->request->getPost('description')[$key],
                            'upload_file' => $photoName,
                        ];
                        $result = $job_result_postdata_model->add($postdata);
                    }
                }

                return redirect()->to('admin/job-result')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/job-result')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function job_extension(){
        $job_detail_model = new Job_detail_model();
        $job_extension_model = new Job_extension_model();
        $data = ['title' => 'Job Extension'];
        if ($this->request->is("get")) {
            $data['job_details'] = $job_detail_model->get();
            $data['job_extension'] = $job_extension_model->get();
            return view('admin/jobs/job-extension',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $ext_notice_file = $this->request->getFile('ext_notice_file');
            if ($ext_notice_file->isValid() && ! $ext_notice_file->hasMoved()) {
                $ext_notice_fileImageName = "ext".$ext_notice_file->getRandomName();
                $ext_notice_file->move(ROOTPATH . 'public/admin/uploads/jobs', $ext_notice_fileImageName);    
            }else{
                $ext_notice_fileImageName = "";
            }

            $data = [
                'job_id' => $this->request->getPost('job_id'),
                'ext_notice_title' => $this->request->getPost('ext_notice_title'),
                'revised_app_last_date' => $this->request->getPost('revised_app_last_date'),
                'revised_app_last_time' => $this->request->getPost('revised_app_last_time'),
                'revised_copy_last_date' => $this->request->getPost('revised_copy_last_date'),
                'revised_copy_last_time' => $this->request->getPost('revised_copy_last_time'),
                'ext_notice_file' => $ext_notice_fileImageName,
                'upload_by' => $loggeduserId
            ];

            $result = $job_extension_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/job-extension')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/job-extension')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function edit_job_extension($id){
        $job_detail_model = new Job_detail_model();
        $job_extension_model = new Job_extension_model();
        $data = ['title' => 'Job Extension','job_id' => $id];
        if ($this->request->is("get")) {
            $data['job_details'] = $job_detail_model->get();
            $data['job_extension'] = $job_extension_model->get();
            $data['job_extension_data'] = $job_extension_model->get($id);
            return view('admin/jobs/edit-job-extension',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $job_extension_data = $job_extension_model->get($id);
            $document = $this->request->getFile('ext_notice_file');
            $old_document_file = $job_extension_data['ext_notice_file'];

            if (empty($old_document_file)) {
                if ($document->isValid() && !$document->hasMoved()) {
                    $document_name = "ext" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/jobs/', $document_name);
                } else {
                    $document_name = null;
                }
            } else {
                if ($document->isValid() && !$document->hasMoved()) {
                    if (file_exists("public/admin/uploads/jobs/" . $old_document_file)) {
                        unlink("public/admin/uploads/jobs/" . $old_document_file);
                    }
                    $document_name = "ext" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/jobs/', $document_name);
                } else {
                    $document_name = $old_document_file;
                }
            }

            $data = [
                'job_id' => $this->request->getPost('job_id'),
                'ext_notice_title' => $this->request->getPost('ext_notice_title'),
                'revised_app_last_date' => $this->request->getPost('revised_app_last_date'),
                'revised_app_last_time' => $this->request->getPost('revised_app_last_time'),
                'revised_copy_last_date' => $this->request->getPost('revised_copy_last_date'),
                'revised_copy_last_time' => $this->request->getPost('revised_copy_last_time'),
                'ext_notice_file' => $document_name,
                'upload_by' => $loggeduserId
            ];

            $result = $job_extension_model->add($data, $id);
            if ($result === true) {
                return redirect()->to('admin/edit-job-extension/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/edit-job-extension/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function delete_job_extension($id){
        $job_extension_model = new Job_extension_model();
        $job_data = $job_extension_model->get($id);
        if ($job_data) {
            if (file_exists("public/admin/uploads/jobs/" . $job_data['ext_notice_file'])) {
                unlink("public/admin/uploads/jobs/" . $job_data['ext_notice_file']);
            }
            $result = $job_extension_model->delete($id);
            if ($result === true) {
                return redirect()->to('admin/job-extension')->with('status','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
            } else {
                return redirect()->to('admin/job-extension')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        } else {
            return redirect()->to('admin/job-extension')->with('status','<div class="alert alert-danger" role="alert"> Job not found </div>');
        }
    }

    public function job_web_link(){
        $job_weblink_model = new Job_weblink_model();
        $job_detail_model = new Job_detail_model();
        $data = ['title' => 'Job Web Link'];
        if ($this->request->is("get")) {
            $data['job_details'] = $job_detail_model->get();
            $data['job_weblink'] = $job_weblink_model->get();
            return view('admin/jobs/job-web-link',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $data = [
                'job_id' => $this->request->getPost('job_id'),   
                'link_description' => $this->request->getPost('link_description'),
                'job_url' => $this->request->getPost('job_link'),
                'upload_by' => $loggeduserId,             
            ];
            $result = $job_weblink_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/job-web-link')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/job-web-link')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function edit_job_web_link($id){
        $job_weblink_model = new Job_weblink_model();
        $job_detail_model = new Job_detail_model();
        $data = ['title' => 'Job Web Link', 'job_id' => $id];
        if ($this->request->is("get")) {
            $data['job_details'] = $job_detail_model->get();
            $data['job_weblink'] = $job_weblink_model->get();
            $data['job_weblink_data'] = $job_weblink_model->get();
            return view('admin/jobs/edit-job-web-link',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $data = [
                'job_id' => $this->request->getPost('job_id'),   
                'link_description' => $this->request->getPost('link_description'),
                'job_url' => $this->request->getPost('job_link'),
                'upload_by' => $loggeduserId,             
            ];
            $result = $job_weblink_model->add($data, $id);
            if ($result === true) {
                return redirect()->to('admin/edit-job-web-link/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/edit-job-web-link/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function job_video(){
        $job_videolink_model = new Job_videolink_model();
        $job_detail_model = new Job_detail_model();
        $data = ['title' => 'Job Video'];
        if ($this->request->is("get")) {
            $data['job_details'] = $job_detail_model->get();
            $data['job_video'] = $job_videolink_model->get();
            return view('admin/jobs/job-video',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $data = [
                'job_id' => $this->request->getPost('job_id'),   
                'video_title' => $this->request->getPost('video_title'),
                'video_description' => $this->request->getPost('video_description'),
                'video_link' => $this->request->getPost('video_link'),
                'upload_by' => $loggeduserId,             
            ];
            $result = $job_videolink_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/job-video')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/job-video')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

}
