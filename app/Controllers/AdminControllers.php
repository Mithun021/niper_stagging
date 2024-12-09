<?php
    namespace App\Controllers;

use App\Models\About_niper_model;
use App\Models\Department_model;
use App\Models\Designation_model;
use App\Models\Employee_model;
use App\Models\Permission_model;
use App\Models\Roles_model;
use App\Models\UserModel;

    
    class AdminControllers extends BaseController{
        public function adminLogin(){
            $admin_model = new UserModel();
            if ($this->request->is("get")) {

                // Check Session Status

                if (isset($_SESSION['adminLoginned'])) {
                    return view("admin/index"); 
                }


                return view('admin/login');
            }
            else if ($this->request->is("post")) {
                $userId = $this->request->getPost('userId');
                $userPassword = $this->request->getVar('userPassword');

                $data = $admin_model->where('email',$userId)
                                    ->orWhere('phoneNumber',$userId)->first();
                if($data){
                    $session_data = [
                        'loggeduserFirstName' => $data['firstName'],
                        'loggeduserPhone' => $data['phoneNumber'],
                        'loggeduseremail' => $data['email'],
                        'loggeduserId' => $data['userId']
                    ];
                    $userPhone = $data['phoneNumber'];
                    if (password_verify($userPassword, $data['password'])) {
                        $this->session->set('loggedUserData',$session_data);
                        $this->session->set('adminLoginned',"adminLoginned");
                        echo "dataMatch";
                    } else {
                    echo 'User ID or Password Mismatch';
                    }
                }
                else{
                    echo "Given Username or Phone Number not found";
                }
            }
           
        }
        public function adminDashboard(){
            $data = [
                'title' => 'Home'
            ];
            return view('admin/index',$data);
        }
        public function logout(){
            $session = session();
            session_unset();
            session_destroy();
            return redirect()->to(base_url('admin/login'));
        }


        public function news_post(){
            $data = ['title' => 'News Post'];
            if ($this->request->is("get")) {
                return view('admin/news-post',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function event_post(){
            $data = ['title' => 'Event Post'];
            if ($this->request->is("get")) {
                return view('admin/event-post',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function event_members(){
            $data = ['title' => 'Event Members'];
            if ($this->request->is("get")) {
                return view('admin/event-members',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function event_organizer(){
            $data = ['title' => 'Event Organizer'];
            if ($this->request->is("get")) {
                return view('admin/event-organizer',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function event_fees(){
            $data = ['title' => 'Event Fees'];
            if ($this->request->is("get")) {
                return view('admin/event-fees',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function event_highlight(){
            $data = ['title' => 'Event Highlight'];
            if ($this->request->is("get")) {
                return view('admin/event-highlight',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function event_category(){
            $data = ['title' => 'Event Category'];
            if ($this->request->is("get")) {
                return view('admin/event-category',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function tendor_details(){
            $data = ['title' => 'Tendor Details'];
            if ($this->request->is("get")) {
                return view('admin/tendor-details',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function job_category(){
            $data = ['title' => 'Job Category'];
            if ($this->request->is("get")) {
                return view('admin/job-category',$data);
            }else if ($this->request->is("post")) {

            }
        }
        public function job_details(){
            $data = ['title' => 'Job Details'];
            if ($this->request->is("get")) {
                return view('admin/job-details',$data);
            }else if ($this->request->is("post")) {

            }
        }
        public function job_result(){
            $data = ['title' => 'Job Result'];
            if ($this->request->is("get")) {
                return view('admin/job-result',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function accouncement(){
            $data = ['title' => 'Accouncement'];
            if ($this->request->is("get")) {
                return view('admin/accouncement',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function achievements(){
            $data = ['title' => 'Achievements'];
            if ($this->request->is("get")) {
                return view('admin/achievements',$data);
            }else if ($this->request->is("post")) {

            }
        }

        // public function director_message(){
        //     $data = ['title' => 'Director Message'];
        //     if ($this->request->is("get")) {
        //         return view('admin/director-message',$data);
        //     }else if ($this->request->is("post")) {

        //     }
        // }

        public function testimonial(){
            $data = ['title' => 'Testimonial'];
            if ($this->request->is("get")) {
                return view('admin/testimonial',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function research_publication(){
            $data = ['title' => 'Research Publication'];
            if ($this->request->is("get")) {
                return view('admin/research-publication',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function faculty_awards(){
            $data = ['title' => 'Faculty Awards'];
            if ($this->request->is("get")) {
                return view('admin/faculty-awards',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function awards_recognition(){
            $data = ['title' => 'Awards & Recognition'];
            if ($this->request->is("get")) {
                return view('admin/Awards-recognition',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function student_achievements(){
            $data = ['title' => 'Student Achievements'];
            if ($this->request->is("get")) {
                return view('admin/student-achievements',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function employee_department(){
            $data = ['title' => 'Employee Department Details'];
            if ($this->request->is("get")) {
                return view('admin/employee-department',$data);
            }else if ($this->request->is("post")) {

            }
        }

        

        public function images(){
            $data = ['title' => 'Images'];
            if ($this->request->is("get")) {
                return view('admin/images',$data);
            }else if ($this->request->is("post")) {

            }
        }
        public function contact(){
            $data = ['title' => 'Contact'];
            if ($this->request->is("get")) {
                return view('admin/contact',$data);
            }else if ($this->request->is("post")) {

            }
        }
        public function download_forms(){
            $data = ['title' => 'Download Forms'];
            if ($this->request->is("get")) {
                return view('admin/download-forms',$data);
            }else if ($this->request->is("post")) {

            }
        }
        public function photo_album(){
            $data = ['title' => 'Photo Album'];
            if ($this->request->is("get")) {
                return view('admin/photo-album',$data);
            }else if ($this->request->is("post")) {

            }
        }
        public function media(){
            $data = ['title' => 'Media'];
            if ($this->request->is("get")) {
                return view('admin/media',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function youtube_link(){
            $data = ['title' => 'Youtube Link'];
            if ($this->request->is("get")) {
                return view('admin/youtube-link',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function quick_link(){
            $data = ['title' => 'Quick Links'];
            if ($this->request->is("get")) {
                return view('admin/quick-link',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function rules_regulations(){
            $data = ['title' => 'Rules & Regulations'];
            if ($this->request->is("get")) {
                return view('admin/rules-regulations',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function banner_slider(){
            $data = ['title' => 'Banner Slider'];
            if ($this->request->is("get")) {
                return view('admin/banner-slider',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function about(){
            $about_niper_model = new About_niper_model();
            $data = ['title' => 'About Us'];
            if ($this->request->is("get")) {
                $data['about'] = $about_niper_model->get();
                return view('admin/about',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function bog(){
            $data = ['title' => 'BoG Page'];
            if ($this->request->is("get")) {
                return view('admin/bog',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function bog_member(){
            $data = ['title' => 'BoG Member'];
            if ($this->request->is("get")) {
                return view('admin/bog-member',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function leadership_and_media_link(){
            $data = ['title' => 'Leadership & Media Links'];
            if ($this->request->is("get")) {
                return view('admin/leadership-and-media-link',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function collaboration(){
            $data = ['title' => 'Collaboration'];
            if ($this->request->is("get")) {
                return view('admin/collaboration',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function committee_details(){
            $data = ['title' => 'Committee Details'];
            if ($this->request->is("get")) {
                return view('admin/committee-details',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function patent_details(){
            $data = ['title' => 'Patent Details'];
            if ($this->request->is("get")) {
                return view('admin/patent-details',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function copyright_details(){
            $data = ['title' => 'Copyright Details'];
            if ($this->request->is("get")) {
                return view('admin/copyright-details',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function membership(){
            $data = ['title' => 'Membership'];
            if ($this->request->is("get")) {
                return view('admin/membership',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function program_dept_mapping(){
            $data = ['title' => 'Program Dept. Mapping'];
            if ($this->request->is("get")) {
                return view('admin/program-dept-mapping',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function program_dept_std_mapping(){
            $data = ['title' => 'Program Dept. Std. Mapping'];
            if ($this->request->is("get")) {
                return view('admin/program-dept-std-mapping',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function students(){
            $data = ['title' => 'Students'];
            if ($this->request->is("get")) {
                return view('admin/students',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function academic_details(){
            $data = ['title' => 'Academic Details'];
            if ($this->request->is("get")) {
                return view('admin/academic-details',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function convocation(){
            $data = ['title' => 'Convocation'];
            if ($this->request->is("get")) {
                return view('admin/convocation',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function result(){
            $data = ['title' => 'Result'];
            if ($this->request->is("get")) {
                return view('admin/result',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function grades(){
            $data = ['title' => 'Grades'];
            if ($this->request->is("get")) {
                return view('admin/grades',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function ranking(){
            $data = ['title' => 'Ranking'];
            if ($this->request->is("get")) {
                return view('admin/ranking',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function admission(){
            $data = ['title' => 'Admission'];
            if ($this->request->is("get")) {
                return view('admin/admission',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function act_rules(){
            $data = ['title' => 'Act Rules'];
            if ($this->request->is("get")) {
                return view('admin/act-rules',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function annual_report(){
            $data = ['title' => 'Annual Report'];
            if ($this->request->is("get")) {
                return view('admin/annual-report',$data);
            }else if ($this->request->is("post")) {

            }
        }
        public function placement_details(){
            $data = ['title' => 'Placement Details'];
            if ($this->request->is("get")) {
                return view('admin/placement-details',$data);
            }else if ($this->request->is("post")) {

            }
        }
        public function recuiter_details(){
            $data = ['title' => 'Recuiter Details'];
            if ($this->request->is("get")) {
                return view('admin/recuiter-details',$data);
            }else if ($this->request->is("post")) {

            }
        }
        public function instrument_facility(){
            $data = ['title' => 'Instrument Facility'];
            if ($this->request->is("get")) {
                return view('admin/instrument-facility',$data);
            }else if ($this->request->is("post")) {

            }
        }
        public function instrument_rates(){
            $data = ['title' => 'Instrument Rates'];
            if ($this->request->is("get")) {
                return view('admin/instrument-rates',$data);
            }else if ($this->request->is("post")) {

            }
        }
        public function private_research_labs(){
            $data = ['title' => 'Private Research Labs'];
            if ($this->request->is("get")) {
                return view('admin/private-research-labs',$data);
            }else if ($this->request->is("post")) {

            }
        }
        
        public function modules(){
            $roles_model = new Roles_model();
            $data = ['title' => 'Modules Details'];
            if ($this->request->is("get")) {
                $data['modules'] = $roles_model->get();
                return view('admin/modules',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function roles_permissions(){
            $roles_model = new Roles_model();
            $employee_model = new Employee_model();
            $designation_model = new Designation_model();
            $department_model = new Department_model();
            $data = ['title' => 'Roles & Permissions'];
            if ($this->request->is("get")) {
                $data['employee'] = $employee_model->get();
                return view('admin/roles-permissions',$data);
            }else if ($this->request->is("post")) {

            }
        }
        public function permission($emp_id){
            $roles_model = new Roles_model();
            $permission_model = new Permission_model();
            $data = ['title' => 'Permissions','emp_id' => $emp_id];
            if ($this->request->is("get")) {
                $data['modules'] = $roles_model->get();
                return view('admin/permission',$data);
            }else if ($this->request->is("post")) {
                $add_type_name = $this->request->getPost('add_type_name');
                $status = $this->request->getPost('status');
                $data = [
                    'emplyee_id' => $emp_id,
                    'module_cat_id' => $this->request->getPost('model_id'),
                ];
                $save  = $permission_model->manage_permission($data,$add_type_name,$status);
                if($save == true){
                    echo true;
                }else{
                    echo "Failed to update";
                }
            }
        }


    }

?>