<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Annual_report_model extends Model
    {
        protected $table         = 'annual_report';
        protected $primaryKey = 'id';
        protected $allowedFields = ['title','start_year','end_year','description','upload_photo','upload_file','upload_by'];
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
                $result = $this->orderBy('title','asc')->findAll();
            }
            return $result;
        }
    }
?>