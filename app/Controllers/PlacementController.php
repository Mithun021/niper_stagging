<?php

namespace App\Controllers;

use App\Models\Company_contact_person_model;
use App\Models\Placement_company_detail_model;
use App\Models\Placement_job_details_model;

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

    public function delete_placement_company_details($id){
        $placement_company_detail_model = new Placement_company_detail_model();
        $placementData = $placement_company_detail_model->get($id);
        if ($placementData) {
            if (file_exists("public/admin/uploads/placement/" . $placementData['company_logo'])) {
                unlink("public/admin/uploads/placement/" . $placementData['company_logo']);
            }
            if (file_exists("public/admin/uploads/placement/" . $placementData['company_photo'])) {
                unlink("public/admin/uploads/placement/" . $placementData['company_photo']);
            }
            $result = $placement_company_detail_model->delete($id);
            if ($result === true) {
                return redirect()->to('admin/placement-company-details')->with('status', '<div class="alert alert-success" role="alert">Data deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('admin/placement-company-details')->with('status', '<div class="alert alert-danger" role="alert">Data not found.</div>');
        }
    }

    public function company_contact_person()
    {
        $placement_company_detail_model = new Placement_company_detail_model();
        $company_contact_person_model = new Company_contact_person_model();
        $data = ['title' => 'Company Contact Person'];
        if ($this->request->is('get')) {
            $data['company_details'] = $placement_company_detail_model->get();
            $data['company_contact_person'] = $company_contact_person_model->get();
            return view('admin/placement/company-contact-person', $data);
        } else if ($this->request->is('post')) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $data = [
                'company_name' => $this->request->getPost('company_name'),
                'contact_name' => $this->request->getPost('contact_name'),
                'contact_designation' => $this->request->getPost('contact_designation'),
                'linkedin' => $this->request->getPost('linkedin'),
                'facebook' => $this->request->getPost('facebook'),
                'instagram' => $this->request->getPost('instagram'),
                'twitter' => $this->request->getPost('twitter'),
                'email_1' => $this->request->getPost('email_1'),
                'email_2' => $this->request->getPost('email_2'),
                'helpline_number1' => $this->request->getPost('helpline_number1'),
                'helpline_number2' => $this->request->getPost('helpline_number2'),
                'upload_by' => $loggeduserId
            ];
            $result = $company_contact_person_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/company-contact-person')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/company-contact-person')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function delete_company_contact_person($id){
        $company_contact_person_model = new Company_contact_person_model();
        $result = $company_contact_person_model->delete($id);
        if ($result === true) {
            return redirect()->to('admin/company-contact-person')->with('status', '<div class="alert alert-success" role="alert">Data deleted successfully.</div>');
        } else {
            return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
        }
    }

    public function job_details()
    {
        $placement_company_detail_model = new Placement_company_detail_model();
        $placement_job_details_model = new Placement_job_details_model();
        $data = ['title' => 'Job Details'];
        if ($this->request->is('get')) {
            $data['company_details'] = $placement_company_detail_model->get();
            $data['job_details'] = $placement_job_details_model->get();
            return view('admin/placement/job-details', $data);
        } else if ($this->request->is('post')) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $data = [
                'company_name' => $this->request->getPost('company_name'),
                'job_title' => $this->request->getPost('job_title'),
                'job_description' => $this->request->getPost('job_description'),
                'no_of_position' => $this->request->getPost('no_of_position'),
                'minimum_salary' => $this->request->getPost('minimum_salary'),
                'maximun_salary' => $this->request->getPost('maximun_salary'),
                'hiring_date_time' => $this->request->getPost('hiring_date_time'),
                'venue' => $this->request->getPost('venue'),
                'meeting_link' => $this->request->getPost('meeting_link'),
                'upload_by' => $loggeduserId
            ];
            $result = $placement_job_details_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/placement-job-details')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/placement-job-details')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function delete_placement_job_details($id){
        $placement_job_details_model = new Placement_job_details_model();
        $result = $placement_job_details_model->delete($id);
        if ($result === true) {
            return redirect()->to('admin/placement-job-details')->with('status', '<div class="alert alert-success" role="alert">Data deleted successfully.</div>');
        } else {
            return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
        }
    }

    public function result_details()
    {
        $placement_job_details_model = new Placement_job_details_model();
        $data = ['title' => 'Result Details'];
        if ($this->request->is('get')) {
            $data['job_details'] = $placement_job_details_model->get();
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
