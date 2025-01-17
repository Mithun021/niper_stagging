<?php

namespace App\Controllers;

class RankingControllers extends BaseController
{
    public function ranking(){
        $data = ['title' => 'Ranking'];
        if ($this->request->is("get")) {
            return view('admin/ranking/ranking',$data);
        }else if ($this->request->is("post")) {

        }
    }
}
