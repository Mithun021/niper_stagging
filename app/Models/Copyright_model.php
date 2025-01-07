<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Copyright_model extends Model
    {
        protected $table         = 'copyrights';
        protected $primaryKey = 'id';
        protected $allowedFields = ['copyright_title','copyright_number','copyright_description','copyright_start_date','copyright_start_time','copyright_end_date','copyright_end_time','upload_file','employee_id','author_name','status','upload_by'];
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
                $result = $this->orderBy('id','asc')->findAll();
            }
            return $result;
        }
    }
?>