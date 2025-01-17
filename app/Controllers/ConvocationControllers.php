<?php

namespace App\Controllers;

use App\Models\Convocation_model;

class ConvocationControllers extends BaseController
{
    public function convocation(){
        $convocation_model = new Convocation_model();
        $data = ['title' => 'Convocation'];
        if ($this->request->is("get")) {
            $data['convocation'] = $convocation_model->get();
            return view('admin/convocation/convocation',$data);
        }else if ($this->request->is("post")) {

        }
    }
}
