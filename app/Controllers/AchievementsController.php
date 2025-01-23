<?php

namespace App\Controllers;

use App\Models\Faculty_awards_gallery_model;
use App\Models\Faculty_awards_model;

class AchievementsController extends BaseController
{
    public function faculty_awards()
    {
        $faculty_awards_model = new Faculty_awards_model();
        $faculty_awards_gallery_model = new Faculty_awards_gallery_model();
        $data = ['title' => 'Faculty Awards'];
        if ($this->request->is("get")) {
            return view('admin/awards_achievement/faculty-awards', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $upload_file = $this->request->getFile('upload_file');
            if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                $upload_file_new_name = 'faculty' . $upload_file->getRandomName();
                $upload_file->move(ROOTPATH . 'public/admin/uploads/achievements', $upload_file_new_name);
            } else {
                $upload_file_new_name = "";
            }
            $data = [
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'thumbnail' => $upload_file_new_name,
            ];
            $result = $faculty_awards_model->add($data);
            if ($result) {
                $insert_id = $faculty_awards_model->getInsertID();
                $file_gallery = $this->request->getFiles();
                if ($file_gallery && isset($file_gallery['file_gallery'])) {
                    foreach ($file_gallery['file_gallery'] as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = $insert_id . "gallery" . $file->getRandomName();
                            $file->move(ROOTPATH . 'public/admin/uploads/achievements', $newName);

                            $file_data = [
                                'faculty_award_id' => $insert_id,
                                'gallery_file' => $newName,
                            ];
                            // echo "<pre>"; print_r($file_data);
                            $faculty_awards_gallery_model->add($file_data);
                        }
                    }
                }
                return redirect()->to('admin/faculty-awards')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/faculty-awards')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function awards_recognition()
    {
        $data = ['title' => 'Awards & Recognition'];
        if ($this->request->is("get")) {
            return view('admin/awards_achievement/awards-recognition', $data);
        } else if ($this->request->is("post")) {
        }
    }

    public function student_achievements()
    {
        $data = ['title' => 'Student Achievements'];
        if ($this->request->is("get")) {
            return view('admin/awards_achievement/student-achievements', $data);
        } else if ($this->request->is("post")) {
        }
    }
}
