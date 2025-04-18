<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Job_result_model extends Model
    {
        protected $table         = 'job_result';
        protected $primaryKey = 'id';
        protected $allowedFields = ['jobs_id','result_title','result_description','file_upload','result_type','corrigendum','status','upload_by'];
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