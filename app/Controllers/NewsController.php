<?php
    namespace App\Controllers;

use App\Models\Department_model;
use App\Models\News_model;

    class NewsController extends BaseController{
        public function news_post(){
            $department_model = new Department_model();
            $news_model = new News_model();
            $data = ['title' => 'News Post'];
            if ($this->request->is("get")) {
                
                // print_r($data['department']);die;
                return view('admin/news/news-post',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $news_file = $this->request->getFile('news_file');
                if ($news_file->isValid() && ! $news_file->hasMoved()) {
                    $news_fileImageName = "admission".$news_file->getRandomName();
                    $news_file->move(ROOTPATH . 'public/admin/uploads/news', $news_fileImageName);    
                }else{
                 $news_fileImageName = "";
                }
                $data = [
                    'publish_date' => $this->request->getPost('news_date'),
                    'title' => $this->request->getPost('news_title'),
                    'upload_file' => $news_fileImageName,
                    'department_id' => $this->request->getPost('department_id'),
                    'marquee_status' => $this->request->getPost('marquee_status'),
                    'status' => $this->request->getPost('status'),
                    'description' => $this->request->getPost('description'),
                    'upload_by' => $loggeduserId
                ];
                $result = $news_model->add($data);
                if ($result === true) {
                    return redirect()->to(base_url('admin/news-post'))->with('success','News added successfully.');
                }else{
                    return redirect()->to(base_url('admin/news-post'))->with('error',$result);
                }
            }
        }
    }
?>