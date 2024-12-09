<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Employee_awards_model extends Model
    {
        protected $table         = 'employee_awards';
        protected $primaryKey = 'id';
        protected $allowedFields = ['emplyee_id','award_title','award_photo','award_year','award_date_time','award_agency_type','award_agency_name','upload_by'];
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
                $result = $this->orderBy('emplyee_id','asc')->findAll();
            }
            return $result;
        }

        
        
    }
?>