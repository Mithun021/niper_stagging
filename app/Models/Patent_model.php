<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Patent_model extends Model
    {
        protected $table         = 'patent_details';
        protected $primaryKey = 'id';
        protected $allowedFields = ['patent_title','patent_number','description','patent_date','upload_file','employee_id','author_name','status','upload_by'];
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