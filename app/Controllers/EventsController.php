<?php
    namespace App\Controllers;
    use App\Models\Department_model;
    use App\Models\Designation_model;
    use App\Models\Employee_model;
use App\Models\Event_category_model;
use App\Models\Event_extension_model;
use App\Models\Event_fee_category_model;
use App\Models\Event_fee_subcategory_model;
use App\Models\Event_fees_model;
use App\Models\Event_gallery_model;
use App\Models\Event_highlights_model;
use App\Models\Event_link_model;
use App\Models\Event_members_model;
use App\Models\Event_organizer_model;
use App\Models\Events_model;
use App\Models\Member_type_model;
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

                $data = [
                    'title' => $this->request->getPost('event_title'),
                    'event_theme_title' => $this->request->getPost('event_theme_title'),
                    'description' => $this->request->getPost('description'),
                    'event_category' => $this->request->getPost('event_category'),
                    'registration_link' => $this->request->getPost('reg_link'),
                    'meeting_link' => $this->request->getPost('meeting_link'),
                    'venue' => $this->request->getPost('event_venue'),
                    'upload_file' => $event_fileNewName,
                    'event_start_date' => $this->request->getPost('event_start_date'),
                    'event_end_date' => $this->request->getPost('event_end_date'),
                    'event_start_time' => $this->request->getPost('event_start_date'),
                    'event_end_time' => $this->request->getPost('event_start_time'),
                    'reg_start_date' => $this->request->getPost('event_end_time'),
                    'reg_start_time' => $this->request->getPost('reg_start_time'),
                    'reg_end_date' => $this->request->getPost('reg_end_date'),
                    'reg_end_time' => $this->request->getPost('reg_end_time'),
                    'payment_link' => $this->request->getPost('payment_link'),
                    'payment_end_date' => $this->request->getPost('payment_end_date'),
                    'payment_end_time' => $this->request->getPost('payment_end_time'),
                    'participant_seats' => $this->request->getPost('participant_seats'),
                    'participant_eligibility' => $this->request->getPost('participant_eligibility'),
                    'marquee_status' => $this->request->getPost('marquee_status'),
                    'status' => $this->request->getPost('status'),
                    'icc_events' => $this->request->getPost('icc_event') ?? 0,
                    'institute_event' => $this->request->getPost('institute_event') ?? 0,
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

        public function event_link(){
            $events_model = new Events_model();
            $event_link_model = new Event_link_model();
            $data = ['title' => 'Event Members'];
            if ($this->request->is("get")) {
                $data['events'] = $events_model->get();
                $data['event_link'] = $event_link_model->get();
                return view('admin/events/event-link',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data =[
                    'event_id' => $this->request->getPost('event_id'),
                    'link_description' => $this->request->getPost('link_description'),
                    'event_link' => $this->request->getPost('event_link'),
                    'upload_by' => $loggeduserId
                ];
                $result = $event_link_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/event-link')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/event-link')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function event_members(){
            $events_model = new Events_model();
            $member_type_model = new Member_type_model();
            $employee_model =new Employee_model();
            $event_members_model = new Event_members_model();
            $data = ['title' => 'Event Members'];
            if ($this->request->is("get")) {
                $data['member_type'] = $member_type_model->get();
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

                $member_name = $this->request->getPost('member_name');
                $member_file = $this->request->getFileMultiple('upload_file');
                foreach ($member_name as $key => $value) {
                    $file = $member_file[$key];
                    $fileName = "";
                    if ($file->isValid() && !$file->hasMoved()) {
                        $fileName = "membersFile".$file->getRandomName();
                        $file->move(ROOTPATH . 'public/admin/uploads/events', $fileName);
                    }
                    $data =[
                        'event_id' => $this->request->getPost('event_id'),
                        'member_name' => $value,
                        'member_type' => $this->request->getPost('member_type'),
                        'member_designation' => $this->request->getPost('member_designation')[$key],
                        'other_designation' => $this->request->getPost('member_desig_other')[$key] ?? '',
                        'member_affiliation' => $this->request->getPost('member_affiliation')[$key],
                        'upload_file' => $fileName,
                        'upload_by' => $loggeduserId,
                    ];
                    // echo "<pre>"; print_r($data);
                    $result = $event_members_model->add($data);
                }
                // die;
                
                if ($result === true) {
                    return redirect()->to('admin/event-members')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/event-members')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function event_organizer(){
            $events_model = new Events_model();
            $event_organizer_model = new Event_organizer_model();
            $data = ['title' => 'Event Organizer'];
            if ($this->request->is("get")) {
                $data['events'] = $events_model->get();
                $data['event_organizers'] = $event_organizer_model->get();
                return view('admin/events/event-organizer',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data = [
                    'event_id' => $this->request->getPost('event_id'),
                    'organizer_type' => $this->request->getPost('evtorg_type'),
                    'organizer_name' => $this->request->getPost('evtorg_name'),
                    'upload_by' => $loggeduserId,
                ];
                $result = $event_organizer_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/event-organizer')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/event-organizer')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function event_fees(){
            $events_model = new Events_model();
            $event_fees_model = new Event_fees_model();
            $event_fee_category_model = new Event_fee_category_model();
            $data = ['title' => 'Event Fees'];
            if ($this->request->is("get")) {
                $data['events_fee'] = $event_fee_category_model->get();
                $data['events'] = $events_model->get();
                $data['event_fees'] = $event_fees_model->get();
                return view('admin/events/event-fees',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data = [
                    'event_id' => $this->request->getPost('event_id'),
                    'fee_type' => $this->request->getPost('evtfeestype'),
                    'evtfeesvalue' => $this->request->getPost('evtfeesvalue'),
                    'event_fees' => $this->request->getPost('evtfees'),
                    'upload_by' => $loggeduserId,
                ];
                $result = $event_fees_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/event-fees')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/event-fees')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function event_highlight(){
            $event_gallery_model = new Event_gallery_model();
            $events_model = new Events_model();
            $event_highlights_model = new Event_highlights_model();
            $data = ['title' => 'Event Highlight'];
            if ($this->request->is("get")) {
                $data['events'] = $events_model->get();
                $data['event_gallery'] = $event_gallery_model->get();
                $data['event_highlights'] = $event_highlights_model->get();
                return view('admin/events/event-highlight',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $gallery_file = $this->request->getFiles();
                if ($gallery_file) {
                    foreach ($gallery_file['gallery_file'] as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = $file->getRandomName();
                            $file->move(ROOTPATH . 'public/admin/uploads/event_gallery', $newName);
                
                            $data = [
                                'event_id' => $this->request->getPost('event_id'),
                                'gallery_file' => $newName,
                                'upload_by' => $loggeduserId,
                            ];
                
                            $result = $event_gallery_model->save($data);
                        }
                    }
                }
                if ($result === true) {
                    return redirect()->to('admin/event-highlight')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/event-highlight')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
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

        public function event_fee_category(){
            $events_model = new Events_model();
            $event_fee_category_model = new Event_fee_category_model();
            $data = ['title' => 'Event Fee Category'];
            if ($this->request->is("get")) {
                $data['events'] = $events_model->get();
                $data['event_categories'] = $event_fee_category_model->get();
                return view('admin/events/event-fee-category',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data = [
                    'event_id' => $this->request->getPost('event_id'),
                    'name' => $this->request->getPost('event_category'),
                    'upload_by' => $loggeduserId
                ];
                $result = $event_fee_category_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/event-fee-category')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/event-fee-category')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function event_extension_notice() {
            $events_model = new Events_model();
            $event_extension_model = new Event_extension_model();
            $data = ['title' => 'Event Extension Notice'];
            if ($this->request->is('get')) {
                $data['events'] = $events_model->get();
                $data['event_extension'] = $event_extension_model->get();
                return view('admin/events/event-extension-notice',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $extension_file = $this->request->getFile('extension_file');
                if ($extension_file->isValid() && ! $extension_file->hasMoved()) {
                    $extension_fileNewName = "ext".$extension_file->getRandomName();
                    $extension_file->move(ROOTPATH . 'public/admin/uploads/events', $extension_fileNewName);    
                }else{
                 $extension_fileNewName = "";
                }

                $data = [
                    'event_id' => $this->request->getPost('event_id'),
                    'extension_status' => $this->request->getPost('extension_status'),
                    'extension_notice_file' => $extension_fileNewName,
                    'extension_end_date' => $this->request->getPost('extension_end_date'),
                    'extension_end_time' => $this->request->getPost('extension_end_time'),
                    'upload_by' => $loggeduserId
                ];
                $result = $event_extension_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/event-extension-notice')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/event-extension-notice')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }


        public function member_type_category() {
            $member_type_model = new Member_type_model();
            $data = ['title' => 'Event Member Type'];
            if ($this->request->is('get')) {
                $data['member_type'] = $member_type_model->get();
                return view('admin/events/member_type_category',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data = [
                    'member_type' => $this->request->getPost('member_type'),
                    'upload_by' => $loggeduserId
                ];
                $result = $member_type_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/member_type_category')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/member_type_category')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function event_fee_subcategory(){
            $events_model = new Events_model();
            $event_fee_subcategory_model = new Event_fee_subcategory_model();
            $event_fee_category_model = new Event_fee_category_model();
            $data = ['title' => 'Event Fee Sub Category'];
            if ($this->request->is("get")) {
                $data['events'] = $events_model->get();
                $data['event_categories'] = $event_fee_category_model->get();
                return view('admin/events/event-fee-subcategory',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data = [
                    'event_id' => $this->request->getPost('event_id'),
                    'event_fee_category_id' => $this->request->getPost('event_fee_category_id'),
                    'name' => $this->request->getPost('event_category'),
                    'upload_by' => $loggeduserId
                ];
                $result = $event_fee_subcategory_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/event-fee-subcategory')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/event-fee-subcategory')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
                
                
            }
        }

        public function event_contact_info(){
            $event_fee_category_model = new Event_fee_category_model();
            $data = ['title' => 'Event Contact Info'];
            if ($this->request->is("get")) {
                $data['event_categories'] = $event_fee_category_model->get();
                return view('admin/events/event-contact-info',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                
            }
        }
    }
?>