<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Admission_section_images_model extends Model
    {
        protected $table         = 'admission_section_images';
        protected $primaryKey    = 'id';
        protected $allowedFields = ['section_id','image_title','image_description','image_upload','upload_by'];
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
