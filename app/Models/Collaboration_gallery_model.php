<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Collaboration_gallery_model extends Model
    {
        protected $table         = 'collaboration_gallery';
        protected $primaryKey    = 'id';
        protected $allowedFields = ['collaboration_id', 'gallery_file'];
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
                $result = $this->orderBy('id','asc')->findAll();
            }
            return $result;
        }
        public function get_by_colid($id) {
            return $this->where('collaboration_id',$id)->findAll();
        }
    }
?>
