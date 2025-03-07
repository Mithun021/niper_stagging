<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Event_fee_subcategory_model extends Model
    {
        protected $table         = 'event_fee_subcategory';
        protected $primaryKey = 'id';
        protected $allowedFields = ['event_id','event_fee_category_id','name','upload_by'];
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

        public function getEventFeeSubcategories($event_id,$evtfeestype){
            return $this->where('event_id', $event_id)->where('event_fee_category_id', $evtfeestype)->findAll();
        }
    }
?>