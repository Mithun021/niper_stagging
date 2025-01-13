<?php

namespace App\Controllers;

use App\Models\Academic_model;

class AcademicControllers extends BaseController
{
    public function academic_details()
    {
        $academic_model = new Academic_model();
        $data = ['title' => 'Academic Details'];
        if ($this->request->is("get")) {
            return view('admin/academics/academic-details', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $calendarFile = $this->request->getFile('acdcalenderfileupload');
            if ($calendarFile->isValid() && ! $calendarFile->hasMoved()) {
                $calendarFileImageName = "admission" . $calendarFile->getRandomName();
                $calendarFile->move(ROOTPATH . 'public/admin/uploads/testimonials', $calendarFileImageName);
            } else {
                $calendarFileImageName = "";
            }

            $feesFile = $this->request->getFile('acdfeesfileupload');
            if ($feesFile->isValid() && ! $feesFile->hasMoved()) {
                $feesFileImageName = "admission" . $feesFile->getRandomName();
                $feesFile->move(ROOTPATH . 'public/admin/uploads/testimonials', $feesFileImageName);
            } else {
                $feesFileImageName = "";
            }

            $data = [
                'session_start' => $this->request->getPost('session_start_year'),
                'session_end' => $this->request->getPost('session_end_year'),
                'calendar_file' => $calendarFileImageName,
                'fees_file' => $feesFileImageName,
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
        $data = ['title' => 'Accouncement'];
        if ($this->request->is("get")) {
            return view('admin/academics/accouncement', $data);
        } else if ($this->request->is("post")) {
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
