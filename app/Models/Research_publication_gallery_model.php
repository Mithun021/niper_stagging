<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Research_publication_gallery_model extends Model
    {
        protected $table         = 'research_publication_gallery';
        protected $primaryKey = 'id';
        protected $allowedFields = ['research_publication_id','files'];

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

        public function getByResearch($id){
            $result = $this->where('research_publication_id',$id)->findAll();
            return $result;
        }
    }
?>