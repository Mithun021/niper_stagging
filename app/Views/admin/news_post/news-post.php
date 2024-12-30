<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>
<?php

use App\Models\Department_model;
use App\Models\Employee_model;
    $employee_model = new Employee_model();
    $department_model = new Department_model();
?>
<style>
    
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form method="post" action="<?= base_url() ?>admin/news-post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Publish Date<span class="text-danger">*</span></span>
                                <input type="date" class="form-control form-control-sm" name="news_date" value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Titles<span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="news_title" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Upload File(JPG,PNG)</span>
                                <input type="file" class="form-control form-control-sm" name="news_file" accept=".jpg, .png" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span>Department</span>
                                <select name="department_id" id="department_id" class="form-control form-control-sm" required >
                                <option value="">Select Deparrtment</option>
                                <?php foreach ($department as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span>Marquee Status</span>
                                <select name="marquee_status" id="marquee_status" class="form-control form-control-sm">
                                    <option value="0" selected>Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span>News Status</span>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="1">Publish</option>
                                    <option value="2">Archive</option>
                                    <option value="0">Draft</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <span for="">Desription</span>
                                <textarea id="editor" name="description"></textarea>
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
                <h4 class="card-title m-0">New Post List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped table-hover" id="basic-datatable">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Files</td>
                            <td>Title</td>
                            <td>Department</td>
                            <td>News Date</td>
                            <td>Status</td>
                            <td>Marquee Status</td>
                            <td>Upload by</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($variable as $key => $value) { ?>
                        <tr>
                            <td><?php echo $key+1; ?></td>
                            <td>
                                <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/news/' . $value['upload_file'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/news/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/news/<?= $value['upload_file'] ?>" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/news/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                            </td>
                            <td><?= $value['title'] ?></td>
                            <td><?php $department = $department_model->get($value['department_id']); echo $department['name']; ?></td>
                            <td><?= date("d-m-Y", strtotime($value['publish_date'])) ?></td>
                            <td>
                                <?= 
                                    ($value['status'] == "0") ? "<span class='badge badge-danger badge-pill'>Draft</span>" : 
                                    (($value['status'] == "1") ? "<span class='badge badge-success badge-pill'>Active</span>" : 
                                    (($value['status'] == "2") ? "<span class='badge badge-warning badge-pill'>Pending</span>" : ""))
                                ?>
                            </td>
                            <td><td><?= ($value['marquee_status'] == "0") ? "<span class='badge badge-danger badge-pill'>Inactive</span>" : (($value['marquee_status'] == "1") ? "<span class='badge badge-success badge-pill'>Active</span>" : "") ?></td></td>
                            <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
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