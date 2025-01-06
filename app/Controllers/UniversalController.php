<?php
    namespace App\Controllers;

use App\Models\Department_model;
use App\Models\Designation_model;
use App\Models\Employee_model;
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
    }
?>