<?php

namespace App\Controllers;

class TendorControllers extends BaseController
{
    public function tendor_details(){
        $data = ['title' => 'Tendor Details'];
        if ($this->request->is("get")) {
            return view('admin/tendor/tendor-details',$data);
        }else if ($this->request->is("post")) {

        }
    }
}
