<?php

namespace App\Controllers;

use App\Models\Adjunt_faculty_notification_model;
use App\Models\Adjunt_faculty_video_model;
use App\Models\Adjunt_faculty_webpage_model;
use App\Models\Adjunt_other_faculty_designation_map_model;
use App\Models\Adjunt_other_faculty_model;
use App\Models\Designation_model;

class Adjunt_facultyController extends BaseController
{
    public function other_faculty()
    {
        $adjunt_faculty_webpage_model = new Adjunt_faculty_webpage_model();
        $designation_model = new Designation_model();
        $adjunt_other_faculty_model = new Adjunt_other_faculty_model();
        $adjunt_other_faculty_designation_map_model = new Adjunt_other_faculty_designation_map_model();
        $data = ['title' => 'Other Facuty Details'];
        if ($this->request->is("get")) {
            $data['designation'] = $designation_model->get();
          	$data['adjunt_faculty_webpage'] = $adjunt_faculty_webpage_model->get();
            $data['adjunt_other_faculty'] = $adjunt_other_faculty_model->get();
            return view('admin/adjunt_faculty/other-faculty',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }

            $photo = $this->request->getFile('photo');
            if ($photo->isValid() && ! $photo->hasMoved()) {
                $photoNewName = "file".$photo->getRandomName();
                $photo->move(ROOTPATH . 'public/admin/uploads/adjunt_faculty', $photoNewName);    
            }else{
                $photoNewName = "";
            }

            $resume = $this->request->getFile('resume');
            if ($resume->isValid() && ! $resume->hasMoved()) {
                $resumeNewName = "resume".$resume->getRandomName();
                $resume->move(ROOTPATH . 'public/admin/uploads/adjunt_faculty', $resumeNewName);    
            }else{
                $resumeNewName = "";
            }

            $data = [
                'annotation' => $this->request->getPost('annotation'),
                'first_name' => $this->request->getPost('first_name'),
                'middle_name' => $this->request->getPost('middle_name'),
                'last_name' => $this->request->getPost('last_name'),
                'personal_email' => $this->request->getPost('personal_email'),
                'official_email' => $this->request->getPost('official_email'),
                'mobile' => $this->request->getPost('mobile'),
                'linkedin' => $this->request->getPost('linkedin'),
                'twitter' => $this->request->getPost('twitter'),
                'facebook' => $this->request->getPost('facebook'),
                'research_interest' => $this->request->getPost('research_interest'),
                'description' => $this->request->getPost('description'),
                'photo' => $photoNewName,
                'resume' => $resumeNewName,
                //'faculty_type' => $this->request->getPost('faculty_type'),
              	'adjunt_faculty_webpage_id' => $this->request->getPost('adjunt_faculty_webpage_id'),
                'status' => $this->request->getPost('status'),
                'upload_by' => $loggeduserId
            ];

            $result = $adjunt_other_faculty_model->add($data);
            if ($result === true) {
                $insertId = $adjunt_other_faculty_model->getInsertID();
                $designation = $this->request->getPost('designation');
                $organisation_name = $this->request->getPost('organisation_name');
                $organisation_address = $this->request->getPost('organisation_address');
                if(!empty($designation)){
                    foreach ($designation as $key => $value) {
                        $data = [
                            'adjunt_faculty_id' => $insertId,
                            'designation' => $value,
                            'organisation_name' => $organisation_name[$key],
                            'organisation_address' => $organisation_address[$key]
                        ];
                        $result = $adjunt_other_faculty_designation_map_model->add($data);
                    }
                }
                return redirect()->to('admin/other-faculty')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/other-faculty')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }

        }
    }

    public function edit_other_faculty($id)
    {
        $adjunt_faculty_webpage_model = new Adjunt_faculty_webpage_model();
        $designation_model = new Designation_model();
        $adjunt_other_faculty_model = new Adjunt_other_faculty_model();
        $adjunt_other_faculty_designation_map_model = new Adjunt_other_faculty_designation_map_model();
        $data = ['title' => 'Other Facuty Details', 'faculty_id' => $id];
        if ($this->request->is("get")) {
            $data['designation'] = $designation_model->get();
          	$data['adjunt_faculty_webpage'] = $adjunt_faculty_webpage_model->get();
            $data['adjunt_other_faculty'] = $adjunt_other_faculty_model->get();
            $data['adjunt_other_faculty_data'] = $adjunt_other_faculty_model->get($id);
            $data['adjunt_other_faculty_designation_data'] = $adjunt_other_faculty_designation_map_model->getByAdjunt_id($id);
            return view('admin/adjunt_faculty/edit-other-faculty',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $adjunt_other_faculty_data = $adjunt_other_faculty_model->get($id);
            $document = $this->request->getFile('photo');
            $old_document_file = $adjunt_other_faculty_data['photo'];
            if (empty($old_document_file)) {
                if ($document->isValid() && !$document->hasMoved()) {
                    $document_name = "file" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/adjunt_faculty/', $document_name);
                } else {
                    $document_name = null;
                }
            } else {
                if ($document->isValid() && !$document->hasMoved()) {
                    if (file_exists("public/admin/uploads/adjunt_faculty/" . $old_document_file)) {
                        unlink("public/admin/uploads/adjunt_faculty/" . $old_document_file);
                    }
                    $document_name = "file" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/adjunt_faculty/', $document_name);
                } else {
                    $document_name = $old_document_file;
                }
            }


            $resume = $this->request->getFile('resume');
            $old_resume_file = $adjunt_other_faculty_data['resume'];
            if (empty($old_resume_file)) {
                if ($resume->isValid() && !$resume->hasMoved()) {
                    $new_resume_name = "resume" . $resume->getRandomName();
                    $resume->move(ROOTPATH . 'public/admin/uploads/adjunt_faculty/', $new_resume_name);
                } else {
                    $new_resume_name = null;
                }
            } else {
                if ($resume->isValid() && !$resume->hasMoved()) {
                    if (file_exists("public/admin/uploads/adjunt_faculty/" . $old_resume_file)) {
                        unlink("public/admin/uploads/adjunt_faculty/" . $old_resume_file);
                    }
                    $new_resume_name = "resume" . $resume->getRandomName();
                    $resume->move(ROOTPATH . 'public/admin/uploads/adjunt_faculty/', $new_resume_name);
                } else {
                    $new_resume_name = $old_resume_file;
                }
            }

            $data = [
                'annotation' => $this->request->getPost('annotation'),
                'first_name' => $this->request->getPost('first_name'),
                'middle_name' => $this->request->getPost('middle_name'),
                'last_name' => $this->request->getPost('last_name'),
                'personal_email' => $this->request->getPost('personal_email'),
                'official_email' => $this->request->getPost('official_email'),
                'mobile' => $this->request->getPost('mobile'),
                'linkedin' => $this->request->getPost('linkedin'),
                'twitter' => $this->request->getPost('twitter'),
                'facebook' => $this->request->getPost('facebook'),
                'research_interest' => $this->request->getPost('research_interest'),
                'description' => $this->request->getPost('description'),
                'photo' => $document_name,
                'resume' => $new_resume_name,
                //'faculty_type' => $this->request->getPost('faculty_type'),
              	'adjunt_faculty_webpage_id' => $this->request->getPost('adjunt_faculty_webpage_id'),
                'status' => $this->request->getPost('status'),
                'upload_by' => $loggeduserId
            ];

            $result = $adjunt_other_faculty_model->add($data, $id);
            if ($result === true) {
                return redirect()->to('admin/edit-other-faculty/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/edit-other-faculty/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }

        }
    }

    public function add_new_other_faculty_organisation($id){
        $adjunt_other_faculty_designation_map_model = new Adjunt_other_faculty_designation_map_model();
        $data = [
            'adjunt_faculty_id' => $id,
            'designation' => $this->request->getPost('designation'),
            'organisation_name' => $this->request->getPost('organisation_name'),
            'organisation_address' => $this->request->getPost('organisation_address')
        ];
        $result = $adjunt_other_faculty_designation_map_model->add($data);
        if ($result === true) {
            return redirect()->to('admin/edit-other-faculty/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
        } else {
            return redirect()->to('admin/edit-other-faculty/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
        }
    }

    public function delete_other_faculty_organisation($id){
        $adjunt_other_faculty_designation_map_model = new Adjunt_other_faculty_designation_map_model();
        $result = $adjunt_other_faculty_designation_map_model->delete($id);
        if ($result) {
            echo "success";
        } else {
           echo "Failed to delete";
        }
    }

    public function delete_other_faculty($id){
        $adjunt_other_faculty_model = new Adjunt_other_faculty_model();
        $adjunt_other_faculty_designation_map_model = new Adjunt_other_faculty_designation_map_model();
        $faculty = $adjunt_other_faculty_model->get($id);
        if ($faculty) {
            if (!empty($faculty['photo'])) {
                $photoPath = ROOTPATH . 'public/admin/uploads/adjunt_faculty/' . $faculty['photo'];
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
            }
            if (!empty($faculty['resume'])) {
                $resumePath = ROOTPATH . 'public/admin/uploads/adjunt_faculty/' . $faculty['resume'];
                if (file_exists($resumePath)) {
                    unlink($resumePath);
                }
            }
        }
        $result = $adjunt_other_faculty_model->delete($id);
        if ($result) {
            $adjunt_other_faculty_designation_map_model->where('adjunt_faculty_id', $id)->delete();
            return redirect()->to('admin/other-faculty')->with('status', '<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/other-faculty')->with('status', '<div class="alert alert-danger" role="alert"> Failed to delete </div>');
        }
    }

    public function adjunt_faculty_webpage()
    {
        $adjunt_faculty_webpage_model = new Adjunt_faculty_webpage_model();
        $data = ['title' => 'Adjunt Facuty Webpage'];
        if ($this->request->is("get")) {
            $data['adjunt_faculty_webpage'] = $adjunt_faculty_webpage_model->get();
            return view('admin/adjunt_faculty/adjunt-faculty-webpage',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }

            $data = [
                'section_title' => $this->request->getPost('section_title'),
                'section_description' => $this->request->getPost('section_description'),
                'section_priority' => $this->request->getPost('section_priority'),
                'upload_by' => $loggeduserId
            ];

            $result = $adjunt_faculty_webpage_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/adjunt-faculty-webpage')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/adjunt-faculty-webpage')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }

        }
    }

    public function edit_adjunt_faculty_webpage($id)
    {
        $adjunt_faculty_webpage_model = new Adjunt_faculty_webpage_model();
        $data = ['title' => 'Adjunt Facuty Webpage', 'webpage_id' => $id];
        if ($this->request->is("get")) {
            $data['adjunt_faculty_webpage'] = $adjunt_faculty_webpage_model->get();
            $data['adjunt_faculty_webpage_data'] = $adjunt_faculty_webpage_model->get($id);
            return view('admin/adjunt_faculty/edit-adjunt-faculty-webpage',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }

            $data = [
                'section_title' => $this->request->getPost('section_title'),
                'section_description' => $this->request->getPost('section_description'),
                'section_priority' => $this->request->getPost('section_priority'),
                'upload_by' => $loggeduserId
            ];

            $result = $adjunt_faculty_webpage_model->add($data, $id);
            if ($result === true) {
                return redirect()->to('admin/edit-adjunt-faculty-webpage/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/edit-adjunt-faculty-webpage/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }

        }
    }

    public function delete_adjunt_faculty_webpage($id){
        $adjunt_faculty_webpage_model = new Adjunt_faculty_webpage_model();
        $result = $adjunt_faculty_webpage_model->delete($id);
        if ($result) {
            return redirect()->to('admin/adjunt-faculty-webpage')->with('status', '<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/adjunt-faculty-webpage')->with('status', '<div class="alert alert-danger" role="alert"> Failed to delete </div>');
        }
    }

    public function adjunt_faculty_notification()
    {
        $adjunt_faculty_notification_model = new Adjunt_faculty_notification_model();
        $data = ['title' => 'Adjunt Facuty Notification'];
        if ($this->request->is("get")) {
            $data['adjunt_faculty_notification'] = $adjunt_faculty_notification_model->get();
            return view('admin/adjunt_faculty/adjunt-faculty-notification',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }

            $photo = $this->request->getFile('notification_file');
            if ($photo->isValid() && ! $photo->hasMoved()) {
                $photoNewName = "notification".$photo->getRandomName();
                $photo->move(ROOTPATH . 'public/admin/uploads/adjunt_faculty', $photoNewName);    
            }else{
                $photoNewName = "";
            }

            $data =[
                'notification_title' => $this->request->getPost('notification_title'),
                'notification_description' => $this->request->getPost('notification_description'),
                'notification_date' => $this->request->getPost('notification_date'),
                'notification_file' => $photoNewName,
                'notification_marquee' => $this->request->getPost('notification_marquee') ?? 0,
                'upload_by' => $loggeduserId
            ];

            $result = $adjunt_faculty_notification_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/adjunt-faculty-notification')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/adjunt-faculty-notification')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }

        }
    }

    public function edit_adjunt_faculty_notification($id)
    {
        $adjunt_faculty_notification_model = new Adjunt_faculty_notification_model();
        $data = ['title' => 'Adjunt Facuty Notification', 'notify_id' => $id];
        if ($this->request->is("get")) {
            $data['adjunt_faculty_notification'] = $adjunt_faculty_notification_model->get();
             $data['adjunt_faculty_notification_data'] = $adjunt_faculty_notification_model->get($id);
            return view('admin/adjunt_faculty/edit-adjunt-faculty-notification',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $adjunt_faculty_notification_data = $adjunt_faculty_notification_model->get($id);
            $document = $this->request->getFile('notification_file');
            $old_document_file = $adjunt_faculty_notification_data['notification_file'];
            if (empty($old_document_file)) {
                if ($document->isValid() && !$document->hasMoved()) {
                    $document_name = "notification" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/adjunt_faculty/', $document_name);
                } else {
                    $document_name = null;
                }
            } else {
                if ($document->isValid() && !$document->hasMoved()) {
                    if (file_exists("public/admin/uploads/adjunt_faculty/" . $old_document_file)) {
                        unlink("public/admin/uploads/adjunt_faculty/" . $old_document_file);
                    }
                    $document_name = "notification" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/adjunt_faculty/', $document_name);
                } else {
                    $document_name = $old_document_file;
                }
            }


            $data =[
                'notification_title' => $this->request->getPost('notification_title'),
                'notification_description' => $this->request->getPost('notification_description'),
                'notification_date' => $this->request->getPost('notification_date'),
                'notification_file' => $document_name,
                'notification_marquee' => $this->request->getPost('notification_marquee') ?? 0,
                'upload_by' => $loggeduserId
            ];

            $result = $adjunt_faculty_notification_model->add($data, $id);
            if ($result === true) {
                return redirect()->to('admin/edit-adjunt-faculty-notification/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/edit-adjunt-faculty-notification/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }

        }
    }

    public function delete_adjunt_faculty_notification($id){
        $adjunt_faculty_notification_model = new Adjunt_faculty_notification_model();
        $notification = $adjunt_faculty_notification_model->get($id);

        if ($notification && !empty($notification['notification_file'])) {
            $filePath = ROOTPATH . 'public/admin/uploads/adjunt_faculty/' . $notification['notification_file'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $result = $adjunt_faculty_notification_model->delete($id);
        if ($result) {
            return redirect()->to('admin/adjunt-faculty-notification')->with('status', '<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/adjunt-faculty-notification')->with('status', '<div class="alert alert-danger" role="alert"> Failed to delete </div>');
        }
    }

    public function adjunt_faculty_video()
    {
        $adjunt_faculty_video_model = new Adjunt_faculty_video_model();
        $data = ['title' => 'Adjunt Facuty Video'];
        if ($this->request->is("get")) {
            $data['adjunt_faculty_video'] = $adjunt_faculty_video_model->get();
            return view('admin/adjunt_faculty/adjunt-faculty-video',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }

            $video = $this->request->getFile('video_file');
            if ($video->isValid() && ! $video->hasMoved()) {
                $videoNewName = "video".$video->getRandomName();
                $video->move(ROOTPATH . 'public/admin/uploads/adjunt_faculty', $videoNewName);    
            }else{
                $videoNewName = "";
            }

            $data = [
                'video_title' => $this->request->getPost('video_title'),
                'video_description' => $this->request->getPost('video_description'),
                'video_file' => $videoNewName,
                'video_venue' => $this->request->getPost('video_venue'),
                'video_datetime' => $this->request->getPost('video_datetime'),
                'upload_by' => $loggeduserId
            ];
            $result = $adjunt_faculty_video_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/adjunt-faculty-video')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/adjunt-faculty-video')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }


    public function edit_adjunt_faculty_video($id)
    {
        $adjunt_faculty_video_model = new Adjunt_faculty_video_model();
        $data = ['title' => 'Adjunt Facuty Video', 'video_id' => $id];
        if ($this->request->is("get")) {
            $data['adjunt_faculty_video'] = $adjunt_faculty_video_model->get();
            $data['adjunt_faculty_video_data'] = $adjunt_faculty_video_model->get($id);
            return view('admin/adjunt_faculty/edit-adjunt-faculty-video',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }

            $adjunt_faculty_video_data = $adjunt_faculty_video_model->get($id);
            $document = $this->request->getFile('video_file');
            $old_document_file = $adjunt_faculty_video_data['video_file'];
            if (empty($old_document_file)) {
                if ($document->isValid() && !$document->hasMoved()) {
                    $document_name = "video" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/adjunt_faculty/', $document_name);
                } else {
                    $document_name = null;
                }
            } else {
                if ($document->isValid() && !$document->hasMoved()) {
                    if (file_exists("public/admin/uploads/adjunt_faculty/" . $old_document_file)) {
                        unlink("public/admin/uploads/adjunt_faculty/" . $old_document_file);
                    }
                    $document_name = "video" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/adjunt_faculty/', $document_name);
                } else {
                    $document_name = $old_document_file;
                }
            }

            $data = [
                'video_title' => $this->request->getPost('video_title'),
                'video_description' => $this->request->getPost('video_description'),
                'video_file' => $document_name,
                'video_venue' => $this->request->getPost('video_venue'),
                'video_datetime' => $this->request->getPost('video_datetime'),
                'upload_by' => $loggeduserId
            ];
            $result = $adjunt_faculty_video_model->add($data, $id);
            if ($result === true) {
                return redirect()->to('admin/edit-adjunt-faculty-video/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/edit-adjunt-faculty-video/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function delete_adjunt_faculty_video($id){
        $adjunt_faculty_video_model = new Adjunt_faculty_video_model();
        $video = $adjunt_faculty_video_model->get($id);

        if ($video && !empty($video['video_file'])) {
            $filePath = ROOTPATH . 'public/admin/uploads/adjunt_faculty/' . $video['video_file'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $result = $adjunt_faculty_video_model->delete($id);
        if ($result) {
            return redirect()->to('admin/adjunt-faculty-video')->with('status', '<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/adjunt-faculty-video')->with('status', '<div class="alert alert-danger" role="alert"> Failed to delete </div>');
        }
    }

}
