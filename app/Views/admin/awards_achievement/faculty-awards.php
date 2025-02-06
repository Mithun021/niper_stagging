<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Employee_model;
use App\Models\Faculty_awards_gallery_model;

$employee_model = new Employee_model();
$faculty_awards_gallery_model = new Faculty_awards_gallery_model();
?>
<style>

</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Faculty Awards </h4>
            </div>
            <div class="card-body">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form method="post" action="<?= base_url() ?>admin/faculty-awards" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="title">
                    </div>
                    <div class="form-group">
                        <span for="">Upload Thumbnail(JPG,PNG)</span>
                        <input type="file" class="form-control form-control-sm" name="upload_file" accept=".jpg, .png, .jpeg" required>
                    </div>
                    <div class="form-group">
                        <span for="">Upload Gallery(JPG,PNG)</span>
                        <input type="file" class="form-control form-control-sm" name="file_gallery[]" accept=".jpg, .png, .jpeg" multiple required>
                    </div>
                    <div class="form-group">
                        <span for="">Description</span>
                        <textarea id="editor" name="description"></textarea>
                    </div>

                    <div class="form-group">
                        <span for="">Faculty Name<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="faculty_name" required>
                    </div>
                    <div class="form-group">
                        <span for="">Awards Date<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="awards_date" required>
                    </div>
                    <div class="form-group">
                        <span for="">Awarding Agency Name</span>
                        <input type="text" class="form-control form-control-sm" name="agency_name">
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>

                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Faculty Awards List</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Files</td>
                                <td>Title</td>
                                <td>Gallery</td>
                                <td>upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($faculty_awards as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?php if (!empty($value['thumbnail']) && file_exists('public/admin/uploads/achievements/' . $value['thumbnail'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/achievements/<?= $value['thumbnail'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/achievements/<?= $value['thumbnail'] ?>" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/achievements/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $value['title'] ?></td>
                                    <td>
                                        <?php
                                        // Fetch gallery data based on faculty award id
                                        $gallery = $faculty_awards_gallery_model->get_by_faculty_award_id($value['id']);

                                        if (!empty($gallery)) {
                                            // Loop through each gallery file
                                            foreach ($gallery as $files) { ?>
                                                <?php if (!empty($files['gallery_file']) && file_exists('public/admin/uploads/achievements/' . $files['gallery_file'])): ?>
                                                    <a href="<?= base_url() ?>public/admin/uploads/achievements/<?= $files['gallery_file'] ?>" target="_blank">
                                                        <img src="<?= base_url() ?>public/admin/uploads/achievements/<?= $files['gallery_file'] ?>" alt="Gallery Image" height="30px">
                                                    </a>
                                                <?php else: ?>
                                                    <img src="<?= base_url() ?>public/admin/uploads/achievements/invalid_image.png" alt="Invalid Image" height="40px">
                                                <?php endif; ?>
                                        <?php }
                                        }
                                        ?>

                                    </td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a>
                                            <a href="#" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="#" class="btn btn-danger waves-effect waves-light"><i class="far fa-trash-alt"></i></a>
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