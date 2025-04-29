<?php

namespace App\Controllers;

class PlacementController extends BaseController
{
    public function company_details()
    {
        $data = ['title' => 'Company Details'];
        if($this->request->is('get')) {
            return view('admin/placement/company-details',$data);
        } else if($this->request->is('post')){
            
        }
    }



    public function placementList()
    {
        return view('placement/placementList');
    }
}
