<?php
    namespace App\Controllers;

use App\Models\Assign_course_model;
use App\Models\Country_model;
use App\Models\Department_model;
use App\Models\Designation_model;
use App\Models\Employee_model;
use App\Models\Event_fee_category_model;
use App\Models\Event_fee_subcategory_model;
use App\Models\Menu_heading_model;
use App\Models\Menu_name_model;
use App\Models\Program_department_mapping_model;
use App\Models\Program_model;
use App\Models\Student_model;   
    class UniversalController extends BaseController{
        public function fetch_programs(){
            $program_model = new Program_model();
            $department_id = $this->request->getPost('dept_id');
            $programCategories = $program_model->getProgramCategoriesByDepartment($department_id);
            return $this->response->setJSON($programCategories);
        }
        public function fetch_menu_heading(){
            $menu_heading_model = new Menu_heading_model();
            $menu_id = $this->request->getPost('menu_id');
            $headings = $menu_heading_model->getAllMenuHeading($menu_id);
            return $this->response->setJSON($headings);
        }
        public function get_event_fee_category(){
            $event_fee_category_model = new Event_fee_category_model();
            $event_id = $this->request->getPost('event_id');
            $event_fee_categories = $event_fee_category_model->getEventFeeCategories($event_id);
            return $this->response->setJSON($event_fee_categories);
        }
        public function get_event_fee_subcategory(){
            $event_fee_subcategory_model = new Event_fee_subcategory_model();
            $event_id = $this->request->getPost('event_id');
            $evtfeestype = $this->request->getPost('evtfeestype');
            $event_fee_categories = $event_fee_subcategory_model->getEventFeeSubcategories($event_id,$evtfeestype);
            return $this->response->setJSON($event_fee_categories);
        }

        public function getStates(){
            $country_name = $this->request->getPost('country_name');
            $country_model = new Country_model();
            $states = $country_model->getState($country_name);
            return $this->response->setJSON($states);
        }

        public function getCourseByDepartment(){
            $department_id = $this->request->getPost('department_id');
            $assign_course_model = new Assign_course_model();
            $course = $assign_course_model->getCourseByDepartment($department_id);
            return $this->response->setJSON($course);
        }

    }
?>