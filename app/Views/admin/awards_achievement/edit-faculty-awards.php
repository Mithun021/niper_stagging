<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Department_model;
use App\Models\Designation_model;
use App\Models\Employee_model;
use App\Models\Faculty_awards_gallery_model;
use App\Models\Faculty_awards_mapping_model;

$employee_model = new Employee_model();
$department_model = new Department_model();
$designation_model = new Designation_model();
$faculty_awards_gallery_model = new Faculty_awards_gallery_model();
$faculty_awards_mapping_model = new Faculty_awards_mapping_model();
?>
<style>
    
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
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
                <form method="post" action="<?= base_url() ?>admin/edit-faculty-awards/<?= $awards_id ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <span for="">Title<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="title" value="<?= $faculty_awards_data['title'] ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Upload Thumbnail(JPG,PNG)</span>
                            <input type="file" class="form-control form-control-sm" name="upload_file" accept=".jpg, .png, .jpeg">
                            <?php if (!empty($faculty_awards_data['thumbnail']) && file_exists('public/admin/uploads/achievements/' . $faculty_awards_data['thumbnail'])): ?>
                                <a href="<?= base_url() ?>public/admin/uploads/achievements/<?= $faculty_awards_data['thumbnail'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/achievements/<?= $faculty_awards_data['thumbnail'] ?>" alt="" height="30px"></a>
                            <?php else: ?>
                                <img src="<?= base_url() ?>public/admin/uploads/achievements/invalid_image.png" alt="" height="40px">
                            <?php endif; ?>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Upload Gallery(JPG,PNG)</span>
                            <input type="file" class="form-control form-control-sm" name="file_gallery[]" accept=".jpg, .png, .jpeg" multiple>

                            <?php foreach ($faculty_awards_gallery as $key => $gallery) { ?>
                                <?php if (!empty($gallery['gallery_file']) && file_exists('public/admin/uploads/achievements/' . $gallery['gallery_file'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/achievements/<?= $gallery['gallery_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/achievements/<?= $gallery['gallery_file'] ?>" alt="" height="30px"></a><br>
                                    <span class="fas fa-trash-alt"></span>    
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/achievements/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                            <?php } ?>

                        </div>
                        <div class="form-group col-md-12">
                            <span for="">Description</span>
                            <textarea id="editor" name="description"><?= $faculty_awards_data['description'] ?></textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="addServicetable">
                                    <thead class="bg-light">
                                        <tr>
                                            <td>Faculty Name</td>
                                            <td>Department</td>
                                            <td>Designation</td>
                                            <td><button type="button" class="btn btn-sm btn-primary" id="addnewMemberRow">+</button></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($faculty_awards_mapped as $key => $faculty) { ?>
                                        <tr>
                                            <td><?= $faculty['faculty_name'] ?></td>
                                            <td><?= $department_model->get($faculty['department_id'])['name'] ?? '' ?></td>
                                            <td><?= $designation_model->get($faculty['designation_id'])['name'] ?? '' ?></td>
                                            <td><button type="button" class="btn btn-sm btn-danger" id="removenewMemberRow">-</button></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <span for="">Awards Date<span class="text-danger">*</span></span>
                            <input type="date" class="form-control form-control-sm" name="awards_date" value="<?= $faculty_awards_data['award_date'] ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="">Awarding Agency Name</span>
                            <input type="text" class="form-control form-control-sm" name="agency_name" value="<?= $faculty_awards_data['agency_name'] ?>">
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
                                <td>Faculty (Department/Designation)</td>
                                <td>Awards Date</td>
                                <td>Gallery</td>
                                <td>upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($faculty_awards as $key => $value) { ?>
                        <?php $mapping_data = $faculty_awards_mapping_model->get_by_faculty_award_id($value['id']); ?>
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
                                        <ul style="padding: 10px; margin : 0;">
                                            <?php foreach ($mapping_data as $key => $value2) { ?>
                                                <li>
                                                    <?= $value2['faculty_name'] ?>
                                                    (
                                                        <?= $department_model->get($value2['department_id'])['name'] ?? '' ?> / 
                                                        <?= $designation_model->get($value2['designation_id'])['name'] ?? '' ?>
                                                    )
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </td>
                                    <td><?= $value['award_date'] ?></td>
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
                                            <a href="<?= base_url() ?>admin/edit-faculty-awards/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-faculty-awards/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure..!')"><i class="far fa-trash-alt"></i></a>
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

<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        

    });
</script>

<?= $this->endSection() ?>