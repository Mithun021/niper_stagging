<?php
    namespace App\Controllers;
    use App\Models\Department_model;
    use App\Models\Designation_model;
    use App\Models\Employee_model;
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
            $data = ['title' => 'Event Category'];
            if ($this->request->is("get")) {
                return view('admin/events/event-category',$data);
            }else if ($this->request->is("post")) {

            }
        }
    }
?>