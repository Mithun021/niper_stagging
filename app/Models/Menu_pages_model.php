<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Menu_pages_model extends Model
    {
        protected $table         = 'menu_pages';
        protected $primaryKey = 'id';
        protected $allowedFields = ['menu_id','menu_heading_id','page_name'];
        // protected $createdField  = 'created_at';

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