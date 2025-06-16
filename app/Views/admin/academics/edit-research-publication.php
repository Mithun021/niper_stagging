<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Department_model;
use App\Models\Research_publication_gallery_model;
use App\Models\Employee_model;
use App\Models\Research_publication_type_model;

$employee_model = new Employee_model();
$research_publication_gallery_model = new Research_publication_gallery_model();
$research_publication_type_model = new Research_publication_type_model();
$department_model = new Department_model();
?>
<style>
    .collab_gallery {
        display: flex;
        flex-wrap: wrap;
        gap: 10px; /* space between images */
        margin-top: 10px;
    }

    .gallery_image {
        position: relative;
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 5px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background: #f9f9f9;
    }
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Research & Publication </h4>
            </div>
            <div class="card-body">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form method="post" action="<?= base_url() ?>admin/edit-research-publication/<?= $research_id ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Title<span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="title" value="<?= $research_publication_data['title'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Upload Thumbnail(JPG,PNG)</span>
                                <input type="file" class="form-control form-control-sm" name="thumbnail" accept=".jpg, .png" >
                                 <?php if (!empty($research_publication_data['thumbnail']) && file_exists('public/admin/uploads/research_publication/' . $research_publication_data['thumbnail'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/research_publication/<?= $research_publication_data['thumbnail'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/research_publication/<?= $research_publication_data['thumbnail'] ?>" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/research_publication/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Upload Gallery(JPG,PNG)</span>
                                <input type="file" class="form-control form-control-sm" name="gallery_file[]" accept=".jpg, .png" multiple >
                                <div class="collab_gallery">
                                <?php foreach ($research_publication_gallery as $key => $gallery) {  ?>
                                    <div class="gallery_image">
                                        <?php if (!empty($gallery['files']) && file_exists('public/admin/uploads/research_publication/' . $gallery['files'])): ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/research_publication/<?= $gallery['files'] ?>" alt="" height="50px">
                                        <?php endif; ?>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="deleteResearchGallery(<?= $gallery['id'] ?>)">X</button>
                                    </div>
                                <?php }  ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span>Type of publication/Research</span>
                                <select name="research_type" id="" class="form-control form-control-sm">
                                    <option value="">--Select--</option>
                                    <?php foreach ($research_publication_type as $key => $value) { ?>
                                        <option value="<?= $value['id'] ?>" <?php if($research_publication_data['reseach_publication_type_id'] == $value['id']){ echo "selected"; } ?>><?= $value['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <span for="">Description</span>
                                <textarea id="editor" name="description"><?= $research_publication_data['description'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Impact Factor<span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="impact_factor" value="<?= $research_publication_data['impact_factor'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Faculty Name<span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="faculty_name" value="<?= $research_publication_data['faculty_name'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Patent No.</span>
                                <input type="text" class="form-control form-control-sm" name="patent_no" value="<?= $research_publication_data['patent_no'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">ISSN No</span>
                                <input type="text" class="form-control form-control-sm" name="issn_no" value="<?= $research_publication_data['issn_no'] ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <span for="">ISBN No</span>
                                <input type="text" class="form-control form-control-sm" name="isbn_no" value="<?= $research_publication_data['isbn_no'] ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <span for="">DOI No</span>
                                <input type="text" class="form-control form-control-sm" name="doi_no" value="<?= $research_publication_data['doi_no'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span>Department</span>
                                <select class="form-control form-control-sm" name="department">
                                    <option value="">--Select--</option>
                                <?php foreach ($department as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>" <?php if($research_publication_data['department_id'] == $value['id']){ echo "selected"; } ?>><?= $value['name'] ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>

                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Research & Publication List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Files</td>
                                <td>Title</td>
                                <td>Reseach/Publication Type</td>
                                <td>Impact Factor</td>
                                <td>Faculty Name</td>
                                <td>ISSN/ISBN</td>
                                <td>Department</td>
                                <td>Gallery</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($research_publication as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?php if (!empty($value['thumbnail']) && file_exists('public/admin/uploads/research_publication/' . $value['thumbnail'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/research_publication/<?= $value['thumbnail'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/research_publication/<?= $value['thumbnail'] ?>" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/research_publication/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $value['title'] ?></td>
                                    <td><?= $research_publication_type_model->get($value['reseach_publication_type_id'])['name'] ?? '' ?></td>
                                    <td><?= $value['impact_factor'] ?></td>
                                    <td><?= $value['faculty_name'] ?></td>
                                    <td><?= $value['issn_no'] ?> / <?= $value['isbn_no'] ?></td>
                                    <td><?= $department_model->get($value['department_id'])['name'] ?? '' ?></td>
                                    <td>
                                        <?php $gallery = $research_publication_gallery_model->getByResearch($value['id']);
                                        if (isset($gallery)) {
                                            foreach ($gallery as $key => $image) {
                                                if ($value['id'] == $image['research_publication_id']) {
                                        ?>
                                                    <?php if (!empty($image['files']) && file_exists('public/admin/uploads/research_publication/' . $image['files'])): ?>
                                                        <a href="<?= base_url() ?>public/admin/uploads/research_publication/<?= $image['files'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/research_publication/<?= $image['files'] ?>" alt="" height="30px"></a>
                                                    <?php else: ?>
                                                        <img src="<?= base_url() ?>public/admin/uploads/research_publication/invalid_image.png" alt="" height="40px">
                                                    <?php endif; ?>
                                        <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <a href="<?= base_url() ?>admin/edit-research-publication/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-research-publication/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure...!')"><i class="far fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>