<?php
    namespace App\Controllers;
    use App\Models\Department_model;
    use App\Models\Designation_model;
    use App\Models\Employee_model;
use App\Models\Event_category_model;
use App\Models\Event_members_model;
use App\Models\Events_model;
use App\Models\Program_department_mapping_model;
    use App\Models\Program_model;

    
    class EventsController extends BaseController{
        public function event_post(){
            $events_model = new Events_model();
            $event_category_model = new Event_category_model();
            $data = ['title' => 'Event Post'];
            if ($this->request->is("get")) {
                $data['event_category'] = $event_category_model->get();
                // print_r($data['event_categories']); die;
                $data['events'] = $events_model->get();
                return view('admin/events/event-post',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }

                $event_file = $this->request->getFile('event_file');
                if ($event_file->isValid() && ! $event_file->hasMoved()) {
                    $event_fileNewName = "file".$event_file->getRandomName();
                    $event_file->move(ROOTPATH . 'public/admin/uploads/events', $event_fileNewName);    
                }else{
                 $event_fileNewName = "";
                }

                $extension_file = $this->request->getFile('extension_file');
                if ($extension_file->isValid() && ! $extension_file->hasMoved()) {
                    $extension_fileNewName = "ext".$extension_file->getRandomName();
                    $extension_file->move(ROOTPATH . 'public/admin/uploads/events', $extension_fileNewName);    
                }else{
                 $extension_fileNewName = "";
                }

                $data = [
                    'title' => $this->request->getPost('event_title'),
                    'description' => $this->request->getPost('description'),
                    'event_category' => $this->request->getPost('event_category'),
                    'registration_link' => $this->request->getPost('reg_link'),
                    'venue' => $this->request->getPost('event_venue'),
                    'upload_file' => $event_fileNewName,
                    'event_start_date' => $this->request->getPost('event_start_date'),
                    'event_end_date' => $this->request->getPost('event_end_date'),
                    'reg_start_date' => $this->request->getPost('reg_start_date'),
                    'reg_start_time' => $this->request->getPost('reg_start_time'),
                    'reg_end_date' => $this->request->getPost('reg_end_date'),
                    'reg_end_time' => $this->request->getPost('reg_end_time'),
                    'payment_link' => $this->request->getPost('payment_link'),
                    'participant_seats' => $this->request->getPost('participant_seats'),
                    'participant_eligibility' => $this->request->getPost('participant_eligibility'),
                    'extension_status' => $this->request->getPost('extension_status'),
                    'extension_notice_file' => $extension_fileNewName,
                    'extension_end_date' => $this->request->getPost('extension_end_date'),
                    'extension_end_time' => $this->request->getPost('extension_end_time'),
                    'marquee_status' => $this->request->getPost('marquee_status'),
                    'status' => $this->request->getPost('status'),
                    'upload_by' => $loggeduserId,
                ];

                $result = $events_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/event-post')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/event-post')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }

            }
        }

        public function event_members(){
            $events_model = new Events_model();
            $employee_model =new Employee_model();
            $event_members_model = new Event_members_model();
            $data = ['title' => 'Event Members'];
            if ($this->request->is("get")) {
                $data['events'] = $events_model->get();
                $data['employees'] = $employee_model->get();
                $data['event_members'] = $event_members_model->get();
                return view('admin/events/event-members',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data =[
                    'event_id' => $this->request->getPost('event_id'),
                    'employee_id' => $this->request->getPost('emp_id'),
                    'member_type' => $this->request->getPost('member_type'),
                    'member_designation' => $this->request->getPost('member_designation'),
                    'other_designation' => $this->request->getPost('other_designation'),
                    'member_affiliation' => $this->request->getPost('member_affiliation'),
                    'upload_by' => $loggeduserId,
                ];
                $result = $event_members_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/event-members')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/event-members')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function event_organizer(){
            $data = ['title' => 'Event Organizer'];
            if ($this->request->is("get")) {
                return view('admin/events/event-organizer',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function event_fees(){
            $data = ['title' => 'Event Fees'];
            if ($this->request->is("get")) {
                return view('admin/events/event-fees',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function event_highlight(){
            $data = ['title' => 'Event Highlight'];
            if ($this->request->is("get")) {
                return view('admin/events/event-highlight',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function event_category(){
            $event_category_model = new Event_category_model();
            $data = ['title' => 'Event Category'];
            if ($this->request->is("get")) {
                $data['event_categories'] = $event_category_model->get();
                return view('admin/events/event-category',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data = [
                    'name' => $this->request->getPost('event_category'),
                    'upload_by' => $loggeduserId
                ];
                $result = $event_category_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/event-category')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/event-category')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }
    }
?>