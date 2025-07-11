<?php

namespace App\Controllers;

use App\Models\Academic_model;
use App\Models\Admission_brochure_model;
use App\Models\Announcement_model;
use App\Models\Classified_mou_value_model;
use App\Models\Collaboration_faculties_model;
use App\Models\Collaboration_gallery_model;
use App\Models\Collaboration_model;
use App\Models\Department_model;
use App\Models\Research_publication_gallery_model;
use App\Models\Research_publication_model;
use App\Models\Research_publication_type_model;
use App\Models\Rules_regulations_model;

class AcademicControllers extends BaseController
{
    public function academic_details()
    {
        $academic_model = new Academic_model();
        $data = ['title' => 'Academic Details'];
        if ($this->request->is("get")) {
            $data['academic_details'] = $academic_model->get();
            return view('admin/academics/academic-details', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $calendarFile = $this->request->getFile('acdcalenderfileupload');
            if ($calendarFile->isValid() && ! $calendarFile->hasMoved()) {
                $calendarFileImageName = "calendar" . $calendarFile->getRandomName();
                $calendarFile->move(ROOTPATH . 'public/admin/uploads/academic', $calendarFileImageName);
            } else {
                $calendarFileImageName = "";
            }

            $feesFile = $this->request->getFile('acdfeesfileupload');
            if ($feesFile->isValid() && ! $feesFile->hasMoved()) {
                $feesFileImageName = "fees" . $feesFile->getRandomName();
                $feesFile->move(ROOTPATH . 'public/admin/uploads/academic', $feesFileImageName);
            } else {
                $feesFileImageName = "";
            }

            $data = [
                'session_start' => $this->request->getPost('session_start_year'),
                'session_end' => $this->request->getPost('session_end_year'),
                'calendar_file' => $calendarFileImageName,
                'fees_file' => $feesFileImageName,
                'upload_by' => $loggeduserId
            ];

            $result = $academic_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/academic-details')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/academic-details')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function edit_academic_details($id)
    {
        $academic_model = new Academic_model();
        $data = ['title' => 'Academic Details','academic_id' => $id];
        if ($this->request->is("get")) {
            $data['academic_details'] = $academic_model->get();
            $data['academic_details_data'] = $academic_model->get($id);
            return view('admin/academics/edit-academic-details', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $academic_details_data = $academic_model->get($id);
            $calendarFile = $this->request->getFile('acdcalenderfileupload');
            $old_document_file = $academic_details_data['calendar_file'];
            if (empty($old_document_file)) {
                if ($calendarFile->isValid() && !$calendarFile->hasMoved()) {
                    $document_name = "calendar" . $calendarFile->getRandomName();
                    $calendarFile->move(ROOTPATH . 'public/admin/uploads/academic/', $document_name);
                } else {
                    $document_name = null;
                }
            } else {
                if ($calendarFile->isValid() && !$calendarFile->hasMoved()) {
                    if (file_exists("public/admin/uploads/academic/" . $old_document_file)) {
                        unlink("public/admin/uploads/academic/" . $old_document_file);
                    }
                    $document_name = "calendar" . $calendarFile->getRandomName();
                    $calendarFile->move(ROOTPATH . 'public/admin/uploads/academic/', $document_name);
                } else {
                    $document_name = $old_document_file;
                }
            }

            $feesFile = $this->request->getFile('acdfeesfileupload');
            $old_document_fee_file = $academic_details_data['fees_file'];
            if (empty($old_document_fee_file)) {
                if ($feesFile->isValid() && !$feesFile->hasMoved()) {
                    $document_fee_name = "fees" . $feesFile->getRandomName();
                    $feesFile->move(ROOTPATH . 'public/admin/uploads/academic/', $document_fee_name);
                } else {
                    $document_fee_name = null;
                }
            } else {
                if ($feesFile->isValid() && !$feesFile->hasMoved()) {
                    if (file_exists("public/admin/uploads/academic/" . $old_document_fee_file)) {
                        unlink("public/admin/uploads/academic/" . $old_document_fee_file);
                    }
                    $document_fee_name = "fees" . $feesFile->getRandomName();
                    $feesFile->move(ROOTPATH . 'public/admin/uploads/academic/', $document_fee_name);
                } else {
                    $document_fee_name = $old_document_fee_file;
                }
            }

            
            $data = [
                'session_start' => $this->request->getPost('session_start_year'),
                'session_end' => $this->request->getPost('session_end_year'),
                'calendar_file' => $document_name,
                'fees_file' => $document_fee_name,
                'upload_by' => $loggeduserId
            ];

            $result = $academic_model->add($data, $id);
            if ($result === true) {
                return redirect()->to('admin/edit-academic-details/'.$id)->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/edit-academic-details/'.$id)->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function delete_academic_details($id){
        $academic_model = new Academic_model();
        $academic_details_data = $academic_model->get($id);
        $old_document_file = $academic_details_data['calendar_file'];
        $feesFile = $this->request->getFile('acdfeesfileupload');
        $file_path = "public/admin/uploads/academic/" . $old_document_file;
        $fees_file_path = "public/admin/uploads/academic/" . $feesFile;
        if (!empty($old_document_file) && file_exists($file_path) && is_file($file_path)) {
            unlink($file_path);
        }
        if (!empty($feesFile) && file_exists($fees_file_path) && is_file($fees_file_path)) {
            unlink($fees_file_path);
        }
        $result = $academic_model->delete($id);
        if ($result === true) {
            return redirect()->to('admin/academic-details')->with('status','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/academic-details')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
        }
    }

    public function accouncement()
    {
        $announcement_model = new Announcement_model();
        $data = ['title' => 'Accouncement'];
        if ($this->request->is("get")) {
            $data['announcement'] = $announcement_model->get();
            return view('admin/academics/accouncement', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $annFile = $this->request->getFile('announcement_file');
            if ($annFile->isValid() && ! $annFile->hasMoved()) {
                $annFileImageName = "calendar" . $annFile->getRandomName();
                $annFile->move(ROOTPATH . 'public/admin/uploads/announcement', $annFileImageName);
            } else {
                $annFileImageName = "";
            }

            $data = [
                'announcement_date' => $this->request->getPost('annoncement_date'),
                'announcement_title' => $this->request->getPost('title'),
                'announcement_desc' => $this->request->getPost('description'),
                'upload_file' => $annFileImageName,
                'announcement_status' => $this->request->getPost('status'),
                'marquee_status' => $this->request->getPost('Marqueestatus'),
                'upload_by' => $loggeduserId
            ];

            $result = $announcement_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/accouncement')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/accouncement')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function edit_accouncement($id)
    {
        $announcement_model = new Announcement_model();
        $data = ['title' => 'Accouncement', 'announcement_id' => $id];
        if ($this->request->is("get")) {
            $data['announcement'] = $announcement_model->get();
            $data['announcement_data'] = $announcement_model->get($id);
            return view('admin/academics/edit-accouncement', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $announcement_data = $announcement_model->get($id);
            $document = $this->request->getFile('announcement_file');
            $old_document_file = $announcement_data['upload_file'];
            if (empty($old_document_file)) {
                if ($document->isValid() && !$document->hasMoved()) {
                    $document_name = "announcement" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/announcement/', $document_name);
                } else {
                    $document_name = null;
                }
            } else {
                if ($document->isValid() && !$document->hasMoved()) {
                    if (file_exists("public/admin/uploads/announcement/" . $old_document_file)) {
                        unlink("public/admin/uploads/announcement/" . $old_document_file);
                    }
                    $document_name = "announcement" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/announcement/', $document_name);
                } else {
                    $document_name = $old_document_file;
                }
            }

            $data = [
                'announcement_date' => $this->request->getPost('annoncement_date'),
                'announcement_title' => $this->request->getPost('title'),
                'announcement_desc' => $this->request->getPost('description'),
                'upload_file' => $document_name,
                'announcement_status' => $this->request->getPost('status'),
                'marquee_status' => $this->request->getPost('Marqueestatus'),
                'upload_by' => $loggeduserId
            ];

            $result = $announcement_model->add($data, $id);
            if ($result === true) {
                return redirect()->to('admin/edit-accouncement/'.$id)->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/edit-accouncement/'.$id)->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function delete_accouncement($id){
        $announcement_model = new Announcement_model();
        $announcement_data = $announcement_model->get($id);
        $old_document_file = $announcement_data['upload_file'];
        $file_path = "public/admin/uploads/announcement/" . $old_document_file;
        if (!empty($old_document_file) && file_exists($file_path) && is_file($file_path)) {
            unlink($file_path);
        }
        $result = $announcement_model->delete($id);
        if ($result === true) {
            return redirect()->to('admin/accouncement')->with('status','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/accouncement')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
        }
    }

    public function rules_regulations()
    {
        $rules_regulations_model = new Rules_regulations_model();
        $data = ['title' => 'Rules & Regulations'];
        if ($this->request->is("get")) {
            $data['rules_regulations'] = $rules_regulations_model->get(1);
            return view('admin/academics/rules-regulations', $data);
        } else if ($this->request->is("post")) {
            $new_file = $this->request->getFile('upload_file');
            $data = $rules_regulations_model->where('id', 1)->first();
            $old_file =  $data['upload_file'];
            if ($new_file->isValid() && !$new_file->hasMoved()) {
                if (file_exists("public/admin/uploads/rules_regulation/" . $old_file)) {
                    unlink("public/admin/uploads/rules_regulation/" . $old_file);
                }
                $new_filename = $new_file->getRandomName();
                $new_file->move(ROOTPATH . 'public/admin/uploads/rules_regulation', $new_filename);
            } else {
                $new_filename = $old_file;
            }
            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'upload_file' => $new_filename
            ];
            $result = $rules_regulations_model->add($data, 1);
            if ($result === true) {
                return redirect()->to('admin/rules-regulations')->with('status', '<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/rules-regulations')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function research_publication()
    {
        $department_model = new Department_model();
        $research_publication_type_model = new Research_publication_type_model();
        $research_publication_model = new Research_publication_model();
        $research_publication_gallery_model = new Research_publication_gallery_model();
        $data = ['title' => 'Research Publication'];
        if ($this->request->is("get")) {
            $data['department'] = $department_model->activeData();
            // echo "<pre>";print_r($data['department']); die;
            $data['research_publication_type'] = $research_publication_type_model->get();
            $data['research_publication'] = $research_publication_model->get();
            return view('admin/academics/research-publication', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData && isset($sessionData['loggeduserId'])) {
                $loggedUserId = $sessionData['loggeduserId'];
            } else {
                return redirect()->to('admin/login')->with('status', '<div class="alert alert-danger" role="alert"> User not logged in </div>');
            }

            $thumbnail = $this->request->getFile('thumbnail');
            $thumbnailNewName = "";

            if ($thumbnail && $thumbnail->isValid() && !$thumbnail->hasMoved()) {
                $thumbnailNewName = rand(0, 9999) . $thumbnail->getRandomName();
                $thumbnail->move(ROOTPATH . 'public/admin/uploads/research_publication', $thumbnailNewName);
            }

            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'thumbnail' => $thumbnailNewName,
                'reseach_publication_type_id' => $this->request->getPost('research_type'),
                'impact_factor' => $this->request->getPost('impact_factor'),
                'faculty_name' => $this->request->getPost('faculty_name'),
                'patent_no' => $this->request->getPost('patent_no'),
                'issn_no' => $this->request->getPost('issn_no'),
                'isbn_no' => $this->request->getPost('isbn_no'),
                'doi_no' => $this->request->getPost('doi_no'),
                'department_id' => $this->request->getPost('department'),
                'upload_by' => $loggedUserId,
            ];
            $result = $research_publication_model->add($data);

            if ($result == true) {
                $insert_id = $research_publication_model->getInsertID();
                $albumFiles = $this->request->getFiles();
                if ($albumFiles && isset($albumFiles['gallery_file'])) {
                    foreach ($albumFiles['gallery_file'] as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = $file->getRandomName();
                            $file->move(ROOTPATH . 'public/admin/uploads/research_publication', $newName);
                            $fileData = [
                                'research_publication_id' => $insert_id,
                                'files' => $newName,
                            ];
                            $research_publication_gallery_model->add($fileData);
                        }
                    }
                }
                return redirect()->to('admin/research-publication')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/research-publication')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function edit_research_publication($id)
    {
        $department_model = new Department_model();
        $research_publication_type_model = new Research_publication_type_model();
        $research_publication_model = new Research_publication_model();
        $research_publication_gallery_model = new Research_publication_gallery_model();
        $data = ['title' => 'Research Publication', 'research_id' => $id];
        if ($this->request->is("get")) {
            $data['department'] = $department_model->activeData();
            // echo "<pre>";print_r($data['department']); die;
            $data['research_publication_type'] = $research_publication_type_model->get();
            $data['research_publication'] = $research_publication_model->get();
            $data['research_publication_data'] = $research_publication_model->get($id);
            $data['research_publication_gallery'] = $research_publication_gallery_model->getByResearch($id);
            return view('admin/academics/edit-research-publication', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData && isset($sessionData['loggeduserId'])) {
                $loggedUserId = $sessionData['loggeduserId'];
            } else {
                return redirect()->to('admin/login')->with('status', '<div class="alert alert-danger" role="alert"> User not logged in </div>');
            }
            $research_publication_data = $research_publication_model->get($id);

            $document = $this->request->getFile('thumbnail');
            $old_thumbnail_file = $research_publication_data['thumbnail'];

            if (empty($old_thumbnail_file)) {
                if ($document->isValid() && !$document->hasMoved()) {
                    $document_name = "research" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/research_publication/', $document_name);
                } else {
                    $document_name = null;
                }
            } else {
                if ($document->isValid() && !$document->hasMoved()) {
                    if (file_exists("public/admin/uploads/research_publication/" . $old_thumbnail_file)) {
                        unlink("public/admin/uploads/research_publication/" . $old_thumbnail_file);
                    }
                    $document_name = "research" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/research_publication/', $document_name);
                } else {
                    $document_name = $old_thumbnail_file;
                }
            }
            

            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'thumbnail' => $document_name,
                'reseach_publication_type_id' => $this->request->getPost('research_type'),
                'impact_factor' => $this->request->getPost('impact_factor'),
                'faculty_name' => $this->request->getPost('faculty_name'),
                'patent_no' => $this->request->getPost('patent_no'),
                'issn_no' => $this->request->getPost('issn_no'),
                'isbn_no' => $this->request->getPost('isbn_no'),
                'doi_no' => $this->request->getPost('doi_no'),
                'department_id' => $this->request->getPost('department'),
                'upload_by' => $loggedUserId,
            ];
            $result = $research_publication_model->add($data, $id);

            if ($result == true) {
                $insert_id = $research_publication_model->getInsertID();
                $albumFiles = $this->request->getFiles();
                if ($albumFiles && isset($albumFiles['gallery_file'])) {
                    foreach ($albumFiles['gallery_file'] as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = $file->getRandomName();
                            $file->move(ROOTPATH . 'public/admin/uploads/research_publication', $newName);
                            $fileData = [
                                'research_publication_id' => $id,
                                'files' => $newName,
                            ];
                            $research_publication_gallery_model->add($fileData);
                        }
                    }
                }
                return redirect()->to('admin/edit-research-publication/'.$id)->with('status', '<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/edit-research-publication/'.$id)->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function deleteResearchGallery($id) {
        $research_publication_gallery_model = new Research_publication_gallery_model();
        $gallery_data = $research_publication_gallery_model->get($id);
        $old_document_file = $gallery_data['files'];
        $file_path = "public/admin/uploads/research_publication/" . $old_document_file;
        if (!empty($old_document_file) && file_exists($file_path) && is_file($file_path)) {
            unlink($file_path);
        }
        $result = $research_publication_gallery_model->delete($id);
        if ($result === true) {
            echo 'success';
        } else {
           echo 'error';
        }
    }

    public function delete_research_publication($id){
        $research_publication_model = new Research_publication_model();
        $research_publication_gallery_model = new Research_publication_gallery_model();
        $research_publication_data = $research_publication_model->get($id);
        $thumbnail = $research_publication_data['thumbnail'];
        $thumbnail_path = "public/admin/uploads/research_publication/" . $thumbnail;
        if (!empty($thumbnail) && file_exists($thumbnail_path) && is_file($thumbnail_path)) {
            unlink($thumbnail_path);
        }
        if($research_publication_model->delete($id)){

            $gallery_data = $research_publication_gallery_model->getByResearch($id);
            foreach ($gallery_data as $key => $gallery) {
                $old_document_file = $gallery['files'];
                $file_path = "public/admin/uploads/research_publication/" . $old_document_file;
                if (!empty($old_document_file) && file_exists($file_path) && is_file($file_path)) {
                    unlink($file_path);
                }
                $research_publication_gallery_model->delete($gallery['id']);
            }

            return redirect()->to('admin/research-publication')->with('status','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        }else{
            return redirect()->to('admin/research-publication')->with('status','<div class="alert alert-danger" role="alert"> Failed to delete. </div>');
        }
    }

    public function collaboration()
    {
        $collaboration_faculties_model = new Collaboration_faculties_model();
        $collaboration_gallery_model = new Collaboration_gallery_model();
        $collaboration_model = new Collaboration_model();
        $classified_mou_value_model = new Classified_mou_value_model();
        $data = ['title' => 'Collaboration'];
        if ($this->request->is("get")) {
            $data['classified_mou'] = $classified_mou_value_model->get();
            $data['collaboration'] = $collaboration_model->get();
            return view('admin/academics/collaboration', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $institutelogo = $this->request->getFile('institutelogo');
            if ($institutelogo->isValid() && ! $institutelogo->hasMoved()) {
                $institutelogoNewName = "ins_logo" . $institutelogo->getRandomName();
                $institutelogo->move(ROOTPATH . 'public/admin/uploads/collaboration', $institutelogoNewName);
            } else {
                $institutelogoNewName = "";
            }
            $Collabfile = $this->request->getFile('Collabfile');
            if ($Collabfile->isValid() && ! $Collabfile->hasMoved()) {
                $CollabfileNewName = "file" . $Collabfile->getRandomName();
                $Collabfile->move(ROOTPATH . 'public/admin/uploads/collaboration', $CollabfileNewName);
            } else {
                $CollabfileNewName = "";
            }
            $gallery_file = $this->request->getFiles();
            $data = [
                'title' => $this->request->getPost('Collabtitle'),
                'description' => $this->request->getPost('description'),
                'institute_name' => $this->request->getPost('Collabinstitutename'),
                'collaboration_date' => $this->request->getPost('Collaborationdate'),
                'collaboration_end_date' => $this->request->getPost('Collaborationenddate'),
                'institute_logo' => $institutelogoNewName,
                'institute_link' => $this->request->getPost('Collabinstituelink'),
                'collaboration_file' => $CollabfileNewName,
                // 'faculty_coordinator' => $this->request->getPost('faculty_coordinator'),
                'classified_mou' => $this->request->getPost('classified_mou'),
                // 'collaboration_tenure_year' => $this->request->getPost('Collabtenure'),
                'status' => $this->request->getPost('Collabstatus'),
                'renewal_date' => $this->request->getPost('RenewalDate') ?? null,
                'upload_by' => $loggeduserId
            ];

            $result = $collaboration_model->add($data);
            if ($result === true) {
                $insert_id = $collaboration_model->getInsertID();

                $faculty_coordinator = $this->request->getPost('faculty_coordinator');
                if (!empty($faculty_coordinator)) {
                    foreach ($faculty_coordinator as $key => $faculty) {
                       $data2 = [
                        'collaboration_id' => $insert_id,
                        'faculty_name' => $faculty,
                       ];
                       $result = $collaboration_faculties_model->add($data2);
                    }
                }

                if (isset($gallery_file['collab_gallery']) && !empty($gallery_file['collab_gallery'][0]->getName())) {
                    foreach ($gallery_file['collab_gallery'] as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = "gallery".rand(0,9999).$file->getRandomName();
                            $file->move(ROOTPATH . 'public/admin/uploads/collaboration', $newName);
                
                            $data = [
                                'gallery_file' => $newName,
                                'collaboration_id' => $insert_id,
                            ];
                
                            $result = $collaboration_gallery_model->save($data);
                        }
                    }
                }
                return redirect()->to('admin/collaboration')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/collaboration')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function edit_collaboration($id)
    {
        $collaboration_faculties_model = new Collaboration_faculties_model();
        $collaboration_gallery_model = new Collaboration_gallery_model();
        $collaboration_model = new Collaboration_model();
        $classified_mou_value_model = new Classified_mou_value_model();
        $data = ['title' => 'Collaboration', 'collab_id' => $id];
        if ($this->request->is("get")) {
            $data['classified_mou'] = $classified_mou_value_model->get();
            $data['collaboration'] = $collaboration_model->get();
            $data['collaboration_data'] = $collaboration_model->get($id);
            $data['collaboration_gallery'] = $collaboration_gallery_model->get_by_colid($id);
            $data['collaboration_faculty'] = $collaboration_faculties_model->getByColId($id);
            return view('admin/academics/edit-collaboration', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $collaboration_data = $collaboration_model->get($id);
            $institutelogo = $this->request->getFile('institutelogo');
            $old_institutelogo = $collaboration_data['institute_logo'];

            if (empty($old_institutelogo)) {
                if ($institutelogo->isValid() && !$institutelogo->hasMoved()) {
                    $institutelogo_name = "ins_logo" . $institutelogo->getRandomName();
                    $institutelogo->move(ROOTPATH . 'public/admin/uploads/collaboration/', $institutelogo_name);
                } else {
                    $institutelogo_name = null;
                }
            } else {
                if ($institutelogo->isValid() && !$institutelogo->hasMoved()) {
                    if (file_exists("public/admin/uploads/collaboration/" . $old_institutelogo)) {
                        unlink("public/admin/uploads/collaboration/" . $old_institutelogo);
                    }
                    $institutelogo_name = "ins_logo" . $institutelogo->getRandomName();
                    $institutelogo->move(ROOTPATH . 'public/admin/uploads/collaboration/', $institutelogo_name);
                } else {
                    $institutelogo_name = $old_institutelogo;
                }
            }

            
            $Collabfile = $this->request->getFile('Collabfile');
            $old_collaboration_file = $collaboration_data['collaboration_file'];
            if (empty($old_collaboration_file)) {
                if ($Collabfile->isValid() && !$Collabfile->hasMoved()) {
                    $Collabfile_name = "file" . $Collabfile->getRandomName();
                    $Collabfile->move(ROOTPATH . 'public/admin/uploads/collaboration/', $Collabfile_name);
                } else {
                    $Collabfile_name = null;
                }
            } else {
                if ($Collabfile->isValid() && !$Collabfile->hasMoved()) {
                    if (file_exists("public/admin/uploads/collaboration/" . $old_collaboration_file)) {
                        unlink("public/admin/uploads/collaboration/" . $old_collaboration_file);
                    }
                    $Collabfile_name = "file" . $Collabfile->getRandomName();
                    $Collabfile->move(ROOTPATH . 'public/admin/uploads/collaboration/', $Collabfile_name);
                } else {
                    $Collabfile_name = $old_collaboration_file;
                }
            }
            $gallery_file = $this->request->getFiles();
            $data = [
                'title' => $this->request->getPost('Collabtitle'),
                'description' => $this->request->getPost('description'),
                'institute_name' => $this->request->getPost('Collabinstitutename'),
                'collaboration_date' => $this->request->getPost('Collaborationdate'),
                'collaboration_end_date' => $this->request->getPost('Collaborationenddate'),
                'institute_logo' => $institutelogo_name,
                'institute_link' => $this->request->getPost('Collabinstituelink'),
                'collaboration_file' => $Collabfile_name,
                // 'faculty_coordinator' => $this->request->getPost('faculty_coordinator'),
                'classified_mou' => $this->request->getPost('classified_mou'),
                // 'collaboration_tenure_year' => $this->request->getPost('Collabtenure'),
                'status' => $this->request->getPost('Collabstatus'),
                'renewal_date' => $this->request->getPost('RenewalDate') ?? null,
                'upload_by' => $loggeduserId
            ];

            $result = $collaboration_model->add($data, $id);
            if ($result === true) {

                if (isset($gallery_file['collab_gallery']) && !empty($gallery_file['collab_gallery'][0]->getName())) {
                    foreach ($gallery_file['collab_gallery'] as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = "gallery".rand(0,9999).$file->getRandomName();
                            $file->move(ROOTPATH . 'public/admin/uploads/collaboration', $newName);
                
                            $data = [
                                'gallery_file' => $newName,
                                'collaboration_id' => $id,
                            ];
                
                            $result = $collaboration_gallery_model->save($data);
                        }
                    }
                }
                return redirect()->to('admin/edit-collaboration/'.$id)->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/edit-collaboration/'.$id)->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function add_collab_faculty($id){
        $collaboration_faculties_model = new Collaboration_faculties_model();
        $data = [
            'collaboration_id' => $id,
            'faculty_name' => $this->request->getPost('collab_faculty_name')
        ];
        $result = $collaboration_faculties_model->add($data);
        if ($result === true) {
            return redirect()->to('admin/edit-collaboration/'.$id)->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
        }else{
            return redirect()->to('admin/edit-collaboration/'.$id)->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
        }
    }

    public function deleteCollabFaculty($id) {
        $collaboration_faculties_model = new Collaboration_faculties_model();
        $result = $collaboration_faculties_model->delete($id);
        if ($result === true) {
            echo 'success';
        } else {
           echo 'error';
        }
    }
    public function deleteCollabGallery($id) {
        $collaboration_gallery_model = new Collaboration_gallery_model();
        $announcement_data = $collaboration_gallery_model->get($id);
        $old_document_file = $announcement_data['gallery_file'];
        $file_path = "public/admin/uploads/collaboration/" . $old_document_file;
        if (!empty($old_document_file) && file_exists($file_path) && is_file($file_path)) {
            unlink($file_path);
        }
        $result = $collaboration_gallery_model->delete($id);
        if ($result === true) {
            echo 'success';
        } else {
           echo 'error';
        }
    }

    public function delete_collaboration($id){
        $collaboration_model = new Collaboration_model();
        $collaboration_faculties_model = new Collaboration_faculties_model();
        $collaboration_gallery_model = new Collaboration_gallery_model();

        $collaboration_data = $collaboration_model->get($id);

        if (!$collaboration_data) {
            return redirect()->to('admin/collaboration')->with('status', '<div class="alert alert-danger" role="alert">Record not found</div>');
        }

        // Delete institute logo
        $logo_file = $collaboration_data['institute_logo'];
        $logo_path = "public/admin/uploads/collaboration/" . $logo_file;
        if (!empty($logo_file) && file_exists($logo_path) && is_file($logo_path)) {
            unlink($logo_path);
        }

        // Delete collaboration file
        $collab_file = $collaboration_data['collaboration_file'];
        $collab_path = "public/admin/uploads/collaboration/" . $collab_file;
        if (!empty($collab_file) && file_exists($collab_path) && is_file($collab_path)) {
            unlink($collab_path);
        }

        // Delete main collaboration record
        $result = $collaboration_model->delete($id);

        if ($result === true) {

            // Delete related faculty records
            $collaboration_faculties_model->where('collaboration_id', $id)->delete();

            // Delete gallery files and records
            $collaboration_gallery = $collaboration_gallery_model->get_by_colid($id);
            if (!empty($collaboration_gallery)) {
                foreach ($collaboration_gallery as $gallery) {
                    $gallery_file = $gallery['gallery_file'];
                    $gallery_path = "public/admin/uploads/collaboration/" . $gallery_file;
                    if (!empty($gallery_file) && file_exists($gallery_path) && is_file($gallery_path)) {
                        unlink($gallery_path);
                    }
                    $collaboration_gallery_model->delete($gallery['id']);
                }
            }

            return redirect()->to('admin/collaboration')->with('status', '<div class="alert alert-success" role="alert">Data deleted successfully.</div>');
        } else {
            return redirect()->to('admin/collaboration')->with('status', '<div class="alert alert-danger" role="alert">Failed to delete record.</div>');
        }
    }


    public function research_publication_type(){
        $research_publication_type_model = new Research_publication_type_model();
        $data = ['title' => 'Research Publication Type'];
        if ($this->request->is("get")) {
            $data['research_publication_type'] = $research_publication_type_model->get();
            return view('admin/academics/research-publication-type', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $data = [
                'name' => $this->request->getPost('category_name'),
                'upload_by' => $loggeduserId
            ];
            $result = $research_publication_type_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/research-publication-type')->with('status', '<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/research-publication-type')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }
    public function edit_research_publication_type($id){
        $research_publication_type_model = new Research_publication_type_model();
        $data = ['title' => 'Research Publication Type', 'research_type_id' => $id];
        if ($this->request->is("get")) {
            $data['research_publication_type'] = $research_publication_type_model->get();
            $data['research_type_data'] = $research_publication_type_model->get($id);
            return view('admin/academics/edit-research-publication-type', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $data = [
                'name' => $this->request->getPost('category_name'),
                'upload_by' => $loggeduserId
            ];
            $result = $research_publication_type_model->add($data, $id);
            if ($result === true) {
                return redirect()->to('admin/edit-research-publication-type/'.$id)->with('status', '<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/edit-research-publication-type/'.$id)->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function delete_research_publication_type($id){
        $research_publication_type_model = new Research_publication_type_model();
        $result = $research_publication_type_model->delete($id);
        if ($result === true) {
            return redirect()->to('admin/research-publication-type')->with('status', '<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/research-publication-type')->with('status', '<div class="alert alert-danger" role="alert"> Failed to delete </div>');
        }
    }

    public function classified_mou_value(){
        $classified_mou_value_model = new Classified_mou_value_model();
        $data = ['title' => 'Classified MoU Value'];
        if ($this->request->is("get")) {
            $data['classified_mou_value'] = $classified_mou_value_model->get();
            return view('admin/academics/classified-mou-value',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $data = [
                'name' => $this->request->getPost('mou_value'),
                'upload_by' => $loggeduserId
            ];
            $result = $classified_mou_value_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/classified-mou-value')->with('status', '<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/classified-mou-value')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function edit_classified_mou_value($id){
        $classified_mou_value_model = new Classified_mou_value_model();
        $data = ['title' => 'Classified MoU Value','classified_id' => $id];
        if ($this->request->is("get")) {
            $data['classified_mou_value'] = $classified_mou_value_model->get();
            $data['classified_mou_data'] = $classified_mou_value_model->get($id);
            return view('admin/academics/edit-classified-mou-value',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $data = [
                'name' => $this->request->getPost('mou_value'),
                'upload_by' => $loggeduserId
            ];
            $result = $classified_mou_value_model->add($data, $id);
            if ($result === true) {
                return redirect()->to('admin/edit-classified-mou-value/'.$id)->with('status', '<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/edit-classified-mou-value/'.$id)->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }
    public function delete_classified_mou_value($id){
        $classified_mou_value_model = new Classified_mou_value_model();
        $result = $classified_mou_value_model->delete($id);
        if ($result) {
            return redirect()->to('admin/classified-mou-value')->with('status', '<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/classified-mou-value')->with('status', '<div class="alert alert-danger" role="alert"> Failed to delete </div>');
        }
    }


    public function admission_brochure()
    {
        $admission_brochure_model = new Admission_brochure_model();
        $data = ['title' => 'Admission Brochure'];
        if ($this->request->is("get")) {
            $data['admission_brochure'] = $admission_brochure_model->get();
            return view('admin/academics/admission-brochure', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $upload_file = $this->request->getFile('upload_file');
            if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                $upload_fileNewName = "brochure" . $upload_file->getRandomName();
                $upload_file->move(ROOTPATH . 'public/admin/uploads/brochure', $upload_fileNewName);
            } else {
                $upload_fileNewName = "";
            }

            $data = [
                'title' => $this->request->getPost('title'),
                'upload_file' => $upload_fileNewName,
                'description' => $this->request->getPost('description'),
                'start_batch' => $this->request->getPost('start_year'),
                'end_batch' => $this->request->getPost('end_year'),
                'upload_by' => $loggeduserId,
            ];
            $result = $admission_brochure_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/admission-brochure')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/admission-brochure')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }

        }
    }

    public function edit_admission_brochure($id)
    {
        $admission_brochure_model = new Admission_brochure_model();
        $data = ['title' => 'Admission Brochure','brochure_id' => $id];
        if ($this->request->is("get")) {
            $data['admission_brochure'] = $admission_brochure_model->get();
            $data['admission_brochure_data'] = $admission_brochure_model->get($id);
            return view('admin/academics/edit-admission-brochure', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $admission_brochure_data = $admission_brochure_model->get($id);
            $document = $this->request->getFile('upload_file');
            $old_document_file = $admission_brochure_data['upload_file'];

            if (empty($old_document_file)) {
                if ($document->isValid() && !$document->hasMoved()) {
                    $document_name = "brochure" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/brochure/', $document_name);
                } else {
                    $document_name = null;
                }
            } else {
                if ($document->isValid() && !$document->hasMoved()) {
                    if (file_exists("public/admin/uploads/brochure/" . $old_document_file)) {
                        unlink("public/admin/uploads/brochure/" . $old_document_file);
                    }
                    $document_name = "brochure" . $document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/brochure/', $document_name);
                } else {
                    $document_name = $old_document_file;
                }
            }

            $data = [
                'title' => $this->request->getPost('title'),
                'upload_file' => $document_name,
                'description' => $this->request->getPost('description'),
                'start_batch' => $this->request->getPost('start_year'),
                'end_batch' => $this->request->getPost('end_year'),
                'upload_by' => $loggeduserId,
            ];
            $result = $admission_brochure_model->add($data, $id);
            if ($result === true) {
                return redirect()->to('admin/edit-admission-brochure/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/edit-admission-brochure/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }

        }
    }

    public function delete_admission_brochure($id){
        $admission_brochure_model = new Admission_brochure_model();
        $admission_brochure_data = $admission_brochure_model->get($id);
        $old_document_file = $admission_brochure_data['upload_file'];
        $file_path = "public/admin/uploads/brochure/" . $old_document_file;
        if (!empty($old_document_file) && file_exists($file_path) && is_file($file_path)) {
            unlink($file_path);
        }
        $result = $admission_brochure_model->delete($id);
        if ($result) {
            return redirect()->to('admin/admission-brochure')->with('status', '<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/admission-brochure')->with('status', '<div class="alert alert-danger" role="alert"> Failed to delete </div>');
        }
    }

}
