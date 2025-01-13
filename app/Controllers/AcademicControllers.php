<?php

namespace App\Controllers;

use App\Models\Academic_model;
use App\Models\Announcement_model;

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
                'announcement_status' => $this->request->getPost('Announcementstatus'),
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
        $data = ['title' => 'Rules & Regulations'];
        if ($this->request->is("get")) {
            return view('admin/academics/rules-regulations', $data);
        } else if ($this->request->is("post")) {
        }
    }

    public function research_publication()
    {
        $data = ['title' => 'Research Publication'];
        if ($this->request->is("get")) {
            return view('admin/academics/research-publication', $data);
        } else if ($this->request->is("post")) {
        }
    }
}
