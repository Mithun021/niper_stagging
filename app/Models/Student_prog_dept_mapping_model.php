<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Student_prog_dept_mapping_model extends Model
    {
        protected $table         = 'student_prog_dept_mapping';
        protected $primaryKey = 'id';
        protected $allowedFields = ['student_id','department_id','program_id','semester','upload_by'];
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
                $result = $this->orderBy('name','asc')->findAll();
            }
            return $result;
        }
    }
?>