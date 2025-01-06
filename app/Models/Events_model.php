<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Events_model extends Model
    {
        protected $table         = 'events';
        protected $primaryKey = 'id';
        protected $allowedFields = ['title','description','event_category','registration_link','venue','upload_file','event_start_date','event_end_date','reg_start_date','reg_start_time','reg_end_date','reg_end_time','payment_link','participant_seats','participant_eligibility','extension_status','extension_notice_file','extension_start_date','extension_start_time','marquee_status','status','upload_by'];
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