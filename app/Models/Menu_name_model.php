<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Menu_name_model extends Model
    {
        protected $table         = 'menu_name';
        protected $primaryKey = 'id';
        protected $allowedFields = ['name'];
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
                $result = $this->orderBy('instrument_id','asc')->findAll();
            }
            return $result;
        }
    }
?>