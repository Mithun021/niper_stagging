<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Event_members_model extends Model
    {
        protected $table         = 'event_members';
        protected $primaryKey = 'id';
        protected $allowedFields = ['event_id','employee_id','member_type','member_designation','other_designation','member_affiliation','upload_by'];
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
    }
?>