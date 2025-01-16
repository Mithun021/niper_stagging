<?php

namespace App\Controllers;

use App\Models\Tendor_model;

class TendorControllers extends BaseController
{
    public function tendor_details(){
        $tendor_model = new Tendor_model();
        $data = ['title' => 'Tendor Details'];
        if ($this->request->is("get")) {
            $data['tendors'] = $tendor_model->get();
            return view('admin/tendor/tendor-details',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $data = [
                'tendor_title' => $this->request->getPost('tendor_title'),
                'tendor_description' => $this->request->getPost('tendor_description'),
                'tendor_ref_no' => $this->request->getPost('tendor_ref_no'),
                'bidding_date' => $this->request->getPost('bidding_date'),
                'bidding_time' => $this->request->getPost('bidding_time'),
                'tendor_start_date' => $this->request->getPost('tendor_start_date'),
                'tendor_start_time' => $this->request->getPost('tendor_start_time'),
                'tendor_end_date' => $this->request->getPost('tendor_end_date'),
                'tendor_end_time' => $this->request->getPost('tendor_end_time'),
                'tendor_status' => $this->request->getPost('tendor_status'),
                'marquee_status' => $this->request->getPost('marquee_status'),
                'status' => $this->request->getPost('status'),
                'upload_by' => $loggeduserId
            ];
            $result = $tendor_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/tendor-details')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/tendor-details')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }
}
