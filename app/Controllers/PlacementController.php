<?php

namespace App\Controllers;

use App\Models\Placement_company_detail_model;

class PlacementController extends BaseController
{
    public function company_details()
    {
        $placement_company_detail_model = new Placement_company_detail_model();
        $data = ['title' => 'Company Details'];
        if ($this->request->is('get')) {
            $data['company_details'] = $placement_company_detail_model->get();
            return view('admin/placement/company-details', $data);
        } else if ($this->request->is('post')) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $file = $this->request->getFile('company_logo');
            if ($file->isValid() && ! $file->hasMoved()) {
                $fileNewName = "logo" . $file->getRandomName();
                $file->move(ROOTPATH . 'public/admin/uploads/placement', $fileNewName);
            } else {
                $fileNewName = "";
            }
            $photo = $this->request->getFile('company_photo');
            if ($photo->isValid() && ! $photo->hasMoved()) {
                $photoNewName = "company" . $photo->getRandomName();
                $photo->move(ROOTPATH . 'public/admin/uploads/placement', $photoNewName);
            } else {
                $photoNewName = "";
            }
            $data = [
                'company_name' => $this->request->getPost('company_name'),
                'company_profile' => $this->request->getPost('company_profile'),
                'company_website' => $this->request->getPost('company_website'),
                'linkedin' => $this->request->getPost('linkedin'),
                'facebook' => $this->request->getPost('facebook'),
                'instagram' => $this->request->getPost('instagram'),
                'twitter' => $this->request->getPost('twitter'),
                'email_1' => $this->request->getPost('email_1'),
                'email_2' => $this->request->getPost('email_2'),
                'helpline_number1' => $this->request->getPost('helpline_number1'),
                'helpline_number2' => $this->request->getPost('helpline_number2'),
                'company_logo' => $fileNewName,
                'company_photo' => $photoNewName,
                'upload_by' => $loggeduserId
            ];
            $result = $placement_company_detail_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/placement-company-details')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/placement-company-details')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function company_contact_person()
    {
        $data = ['title' => 'Company Contact Person'];
        if ($this->request->is('get')) {
            return view('admin/placement/company-contact-person', $data);
        } else if ($this->request->is('post')) {
        }
    }

    public function job_details()
    {
        $data = ['title' => 'Job Details'];
        if ($this->request->is('get')) {
            return view('admin/placement/job-details', $data);
        } else if ($this->request->is('post')) {
        }
    }

    public function result_details()
    {
        $data = ['title' => 'Result Details'];
        if ($this->request->is('get')) {
            return view('admin/placement/result-details', $data);
        } else if ($this->request->is('post')) {
        }
    }

    public function job_student_mapping()
    {
        $data = ['title' => 'Job Student Mapping'];
        if ($this->request->is('get')) {
            return view('admin/placement/job-student-mapping', $data);
        } else if ($this->request->is('post')) {
        }
    }

    public function job_result_stage_mapping()
    {
        $data = ['title' => 'Job Result Stage Mapping'];
        if ($this->request->is('get')) {
            return view('admin/placement/job-result-stage-mapping', $data);
        } else if ($this->request->is('post')) {
        }
    }

    public function student_result_mapping()
    {
        $data = ['title' => 'Student Result Mapping'];
        if ($this->request->is('get')) {
            return view('admin/placement/student-result-mapping', $data);
        } else if ($this->request->is('post')) {
        }
    }

    public function page_notification_details()
    {
        $data = ['title' => 'Page Notification Details'];
        if ($this->request->is('get')) {
            return view('admin/placement/page-notification-details', $data);
        } else if ($this->request->is('post')) {
        }
    }

    public function page_section_details()
    {
        $data = ['title' => 'Page Section Details'];
        if ($this->request->is('get')) {
            return view('admin/placement/page-section-details', $data);
        } else if ($this->request->is('post')) {
        }
    }

    public function page_gallery()
    {
        $data = ['title' => 'Page Gallery'];
        if ($this->request->is('get')) {
            return view('admin/placement/page-gallery', $data);
        } else if ($this->request->is('post')) {
        }
    }
}
