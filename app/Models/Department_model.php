<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Department_model extends Model
    {
        protected $table         = 'department';
        protected $primaryKey = 'id';
        protected $allowedFields = ['name','description','program_id','files'];
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
                $result = $this->findAll();
            }
            return $result;
        }
        
    }
?>