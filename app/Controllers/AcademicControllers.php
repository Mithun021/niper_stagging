<?php

namespace App\Controllers;

use App\Models\Academic_model;
use App\Models\Announcement_model;
use App\Models\Collaboration_model;
use App\Models\Research_publication_gallery_model;
use App\Models\Research_publication_model;
use App\Models\Rules_regulations_model;

class AcademicControllers extends BaseController
{
    public function academic_details()
    {
        $academic_model = new Academic_model();
        $data = ['title' => 'Academic Details'];
        if ($this->request->is("get")) {
            $data['academic_details'] = $academic_model->get();
            return view('admin/academics/academic-details', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $calendarFile = $this->request->getFile('acdcalenderfileupload');
            if ($calendarFile->isValid() && ! $calendarFile->hasMoved()) {
                $calendarFileImageName = "calendar" . $calendarFile->getRandomName();
                $calendarFile->move(ROOTPATH . 'public/admin/uploads/academic', $calendarFileImageName);
            } else {
                $calendarFileImageName = "";
            }

            $feesFile = $this->request->getFile('acdfeesfileupload');
            if ($feesFile->isValid() && ! $feesFile->hasMoved()) {
                $feesFileImageName = "fees" . $feesFile->getRandomName();
                $feesFile->move(ROOTPATH . 'public/admin/uploads/academic', $feesFileImageName);
            } else {
                $feesFileImageName = "";
            }

            $examin_grade_file = $this->request->getFile('examin_grade_file');
            if ($examin_grade_file->isValid() && ! $examin_grade_file->hasMoved()) {
                $examin_grade_fileImageName = "grade" . $examin_grade_file->getRandomName();
                $examin_grade_file->move(ROOTPATH . 'public/admin/uploads/academic', $examin_grade_fileImageName);
            } else {
                $examin_grade_fileImageName = "";
            }

            $data = [
                'session_start' => $this->request->getPost('session_start_year'),
                'session_end' => $this->request->getPost('session_end_year'),
                'calendar_file' => $calendarFileImageName,
                'fees_file' => $feesFileImageName,
                'exam_grade_file' => $examin_grade_fileImageName,
                'upload_by' => $loggeduserId
            ];

            $result = $academic_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/academic-details')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/academic-details')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function accouncement()
    {
        $announcement_model = new Announcement_model();
        $data = ['title' => 'Accouncement'];
        if ($this->request->is("get")) {
            $data['announcement'] = $announcement_model->get();
            return view('admin/academics/accouncement', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $annFile = $this->request->getFile('announcement_file');
            if ($annFile->isValid() && ! $annFile->hasMoved()) {
                $annFileImageName = "calendar" . $annFile->getRandomName();
                $annFile->move(ROOTPATH . 'public/admin/uploads/announcement', $annFileImageName);
            } else {
                $annFileImageName = "";
            }

            $data = [
                'announcement_date' => $this->request->getPost('annoncement_date'),
                'announcement_title' => $this->request->getPost('title'),
                'announcement_desc' => $this->request->getPost('description'),
                'upload_file' => $annFileImageName,
                'announcement_status' => $this->request->getPost('status'),
                'marquee_status' => $this->request->getPost('Marqueestatus'),
                'upload_by' => $loggeduserId
            ];

            $result = $announcement_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/accouncement')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/accouncement')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function rules_regulations()
    {
        $rules_regulations_model = new Rules_regulations_model();
        $data = ['title' => 'Rules & Regulations'];
        if ($this->request->is("get")) {
            $data['rules_regulations'] = $rules_regulations_model->get(1);
            return view('admin/academics/rules-regulations', $data);
        } else if ($this->request->is("post")) {
            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description')
            ];
            $result = $rules_regulations_model->add($data, 1);
            if ($result === true) {
                return redirect()->to('admin/rules-regulations')->with('status', '<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/rules-regulations')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function research_publication()
    {
        $research_publication_model = new Research_publication_model();
        $research_publication_gallery_model = new Research_publication_gallery_model();
        $data = ['title' => 'Research Publication'];
        if ($this->request->is("get")) {
            return view('admin/academics/research-publication', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData && isset($sessionData['loggeduserId'])) {
                $loggedUserId = $sessionData['loggeduserId'];
            } else {
                return redirect()->to('admin/login')->with('status', '<div class="alert alert-danger" role="alert"> User not logged in </div>');
            }

            $thumbnail = $this->request->getFile('thumbnail');
            $thumbnailNewName = "";

            if ($thumbnail && $thumbnail->isValid() && !$thumbnail->hasMoved()) {
                $thumbnailNewName = rand(0,9999) . $thumbnail->getRandomName();
                $thumbnail->move(ROOTPATH . 'public/admin/uploads/research_publication', $thumbnailNewName);
            }

            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'thumbnail' => $thumbnailNewName,
                'upload_by' => $loggedUserId,
            ];

            $albumFiles = $this->request->getFiles();
            if ($albumFiles && isset($albumFiles['gallery'])) {
                foreach ($albumFiles['gallery'] as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $newName = $file->getRandomName();
                        $file->move(ROOTPATH . 'public/admin/uploads/research_publication', $newName);
                        $fileData = [
                            'research_publication_id' => 1,
                            'files' => $newName,
                        ];
                        echo "<pre>"; print_r($fileData);
                        //$research_publication_gallery_model->add($fileData);
                    }
                }
            }
            die;
            $result = $research_publication_model->add($data);

            if ($result === true) {
                if ($albumFiles && isset($albumFiles['gallery'])) {
                    foreach ($albumFiles['gallery'] as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = $file->getRandomName();
                            $file->move(ROOTPATH . 'public/admin/uploads/research_publication', $newName);
                            $fileData = [
                                'research_publication_id' => $result,
                                'files' => $newName,
                            ];
                            $research_publication_gallery_model->add($fileData);
                        }
                    }
                }
                return redirect()->to('admin/research-publication')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/research-publication')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function collaboration()
    {
        $collaboration_model = new Collaboration_model();
        $data = ['title' => 'Collaboration'];
        if ($this->request->is("get")) {
            $data['collaboration'] = $collaboration_model->get();
            return view('admin/academics/collaboration', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $institutelogo = $this->request->getFile('institutelogo');
            if ($institutelogo->isValid() && ! $institutelogo->hasMoved()) {
                $institutelogoNewName = "calendar" . $institutelogo->getRandomName();
                $institutelogo->move(ROOTPATH . 'public/admin/uploads/collaboration', $institutelogoNewName);
            } else {
                $institutelogoNewName = "";
            }
            $Collabfile = $this->request->getFile('Collabfile');
            if ($Collabfile->isValid() && ! $Collabfile->hasMoved()) {
                $CollabfileNewName = "file" . $Collabfile->getRandomName();
                $Collabfile->move(ROOTPATH . 'public/admin/uploads/collaboration', $CollabfileNewName);
            } else {
                $CollabfileNewName = "";
            }

            $data = [
                'title' => $this->request->getPost('Collabtitle'),
                'description' => $this->request->getPost('description'),
                'institute_name' => $this->request->getPost('Collabinstitutename'),
                'collaboration_date' => $this->request->getPost('Collaborationdate'),
                'institute_logo' => $institutelogoNewName,
                'institute_link' => $this->request->getPost('Collabinstituelink'),
                'collaboration_file' => $CollabfileNewName,
                'collaboration_tenure_year' => $this->request->getPost('Collabtenure'),
                'status' => $this->request->getPost('Collabstatus'),
                'upload_by' => $loggeduserId
            ];

            $result = $collaboration_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/collaboration')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/collaboration')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }
}
