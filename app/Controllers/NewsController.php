<?php
    namespace App\Controllers; 
    class NewsController extends BaseController{
        public function news_post(){
            $data = ['title' => 'News Post'];
            if ($this->request->is("get")) {
                return view('admin/news/news-post',$data);
            }else if ($this->request->is("post")) {

            }
        }
    }
?>