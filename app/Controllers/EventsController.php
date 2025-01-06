<?php
    namespace App\Controllers;
    use App\Models\Department_model;
    use App\Models\Designation_model;
    use App\Models\Employee_model;
use App\Models\Event_category_model;
use App\Models\Program_department_mapping_model;
    use App\Models\Program_model;

    
    class EventsController extends BaseController{
        public function event_post(){
            $data = ['title' => 'Event Post'];
            if ($this->request->is("get")) {
                return view('admin/events/event-post',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function event_members(){
            $data = ['title' => 'Event Members'];
            if ($this->request->is("get")) {
                return view('admin/events/event-members',$data);
            }else if ($this->request->is("post")) {

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