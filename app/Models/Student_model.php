<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Student_model extends Model
    {
        protected $table         = 'students';
        protected $primaryKey = 'id';
        protected $allowedFields = ['first_name','middle_name','last_name','enrollment_no','father_name','mother_name','date_of_birth','blood_group','personal_mail','official_mail','phone_no','gender','permanent_address','correspondence_address','profile_image','upload_by'];
        protected $createdField  = 'created_at';

        public function add($data, $id = null) {
            if ($id != null) {
                $result = $this->update($id, $data);
                return $result ? true : 'Data not updated: Update failed.';
            } else {
                $result = $this->insert($data);
                return $result ? true : 'Data not inserted: Insertion failed.';
            }
        }

        public function get($id = null){
            if($id != null){
                $result = $this->where('id',$id)->first();
            }else{
                $result = $this->orderBy('enrollment_no','asc')->findAll();
            }
            return $result;
        }
    }
?>