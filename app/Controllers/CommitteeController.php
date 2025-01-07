<?php

namespace App\Controllers;

class CommitteeController extends BaseController
{
    public function committee_details(){
        $data = ['title' => 'Committee Details'];
        if ($this->request->is("get")) {
            return view('admin/committee/committee-details',$data);
        }else if ($this->request->is("post")) {

        }
    }
}
