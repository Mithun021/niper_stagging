<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Program_model extends Model
    {
        protected $table         = 'program_category';
        protected $primaryKey = 'id';
        protected $allowedFields = ['name','description','status','upload_by'];
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

        public function activeData() {
            return $this->where('status',1)->findAll();
        }

        public function getProgramCategoriesByDepartment($departmentId) {
            return $this->db->table('program_category')
                ->join('program_department_mapping', 'program_category.id = program_department_mapping.program_category_id', 'inner') // Correct the join condition
                ->where('program_category.status', 1)
                ->where('program_department_mapping.status', 1)
                ->where('program_department_mapping.department_id', $departmentId)
                ->select('program_category.name as program_name, program_category.id as program_id') // Explicit field selection
                ->get()
                ->getResult();
        }
        

        
    }
?>