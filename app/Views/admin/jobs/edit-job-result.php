<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Job_detail_model;
use App\Models\Employee_model;
use App\Models\Result_category_model;

$job_detail_model = new Job_detail_model();
$employee_model = new Employee_model();
$result_category_model = new Result_category_model();
?>
<style>
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title; ?></h4>
            </div>
            <div class="card-body p-2">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form action="<?= base_url() ?>admin/edit-job-result/<?= $job_id ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="advid">Advertisement ID:</span>
                                <select name="advid" id="advid" class="form-control form-control-sm">
                                    <option value="">Select Advertisement</option>
                                    <?php foreach ($job_details as $key => $value) { ?>
                                        <option value="<?= $value['id'] ?>" <?php if($job_result_data['jobs_id'] == $value['id']){ echo "selected"; } ?> ><?= $value['title'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="resultitle">Result Title:</span>
                                <input type="text" name="resultitle" id="resultitle" class="form-control form-control-sm" value="<?= $job_result_data['result_title'] ?? '' ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <span>Result Description:</span>
                                <textarea name="resultdesc" id="editor" class="form-control form-control-sm"><?= $job_result_data['result_description'] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <span for="resultfile">Result File Upload:</span>
                                <input type="file" name="resultfile" id="resultfile" class="form-control form-control-sm">
                                <?php if (!empty($job_result_data['file_upload']) && file_exists('public/admin/uploads/jobs/' . $job_result_data['file_upload'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/jobs/<?= $job_result_data['file_upload'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/jobs/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <span for="resultfile">Corrigendum:</span>
                                <input type="text" name="corrigendum" id="corrigendum" class="form-control form-control-sm">
                            </div>
                        </div> -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <span for="resulttype">Result Type:</span>
                                <select name="resulttype" id="resulttype" class="form-control form-control-sm" required>
                                    <option value="">--Select--</option>
                                <?php foreach ($result_category as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>"  <?php if($job_result_data['result_type'] == $value['id']){ echo "selected"; } ?>><?= $value['name'] ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="bg-light">
                                        <tr>
                                            <td scope="col">Post Code</td>
                                            <td scope="col">Post Name</td>
                                            <td scope="col">Description</td>
                                            <td scope="col">Upload File</td>
                                            <td scope="col"><button type="button" class="btn btn-sm btn-primary" onclick="openjobresultpostModal()">+</button></td>
                                        </tr>

                                    </thead>
                                    <tbody id="stockTbody">
                                    <?php foreach ($job_result_postdata as $key => $data) { ?>
                                        <tr id="stockTrow">
                                            <td><?= $data['postcode'] ?></td>
                                            <td><?= $data['postname'] ?></td>
                                            <td><?= $data['description'] ?></td>
                                            <td>
                                                <?php if (!empty($data['upload_file']) && file_exists('public/admin/uploads/jobs/' . $data['upload_file'])): ?>
                                                    <a href="<?= base_url() ?>public/admin/uploads/jobs/<?= $data['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png<?= $data['upload_file'] ?>" alt="" height="30px"></a>
                                                <?php else: ?>
                                                    <img src="<?= base_url() ?>public/admin/uploads/jobs/invalid_image.png" alt="" height="40px">
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger">-</button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <span for="result_status">Result Status:</span>
                                <select name="result_status" id="result_status" class="form-control form-control-sm" required>
                                    <option value="1" <?php if($job_result_data['status'] == 1){ echo "selected"; } ?>>Publish</option>
                                    <option value="0" <?php if($job_result_data['status'] == 0){ echo "selected"; } ?>>Draft</option>
                                    <option value="2" <?php if($job_result_data['status'] == 2){ echo "selected"; } ?>>Archive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Status</td>
                                <td>Advestisment ID</td>
                                <td>Result Title</td>
                                <td>Result type</td>
                                <!-- <td>Corrigendum</td> -->
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($job_result as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?php if (!empty($value['file_upload']) && file_exists('public/admin/uploads/jobs/' . $value['file_upload'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/jobs/<?= $value['file_upload'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/jobs/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?=
                                        ($value['status'] == "0") ? "<span class='badge badge-danger badge-pill'>Draft</span>" : (($value['status'] == "1") ? "<span class='badge badge-success badge-pill'>Active</span>" : (($value['status'] == "2") ? "<span class='badge badge-warning badge-pill'>Archive</span>" : ""))
                                        ?>
                                    </td>
                                    <td><?php $jobs = $job_detail_model->get($value['jobs_id']);
                                        echo $jobs['title'] ?? ''; ?></td>
                                    <td><?= $value['result_title'] ?></td>
                                    <td><?= $result_category_model->get($value['result_type'])['name'] ?? '' ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <a href="<?= base_url() ?>admin/edit-job-result/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-job-result/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure...!')"><i class="far fa-trash-alt"></i></a>
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


<div class="modal fade" id="jobresultpostModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <input type="text" class="form-control form-control-sm" aria-colcount="job_result_id" value="<?= $job_id ?>">
                <div class="form-group">
                    <span>Post Code</span>
                    <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Post Code">
                </div>
                <div class="form-group">
                    <span>Post Name</span>
                    <input type="text" class="form-control" id="postname" name="postname" placeholder="Post Name">
                </div>
                <div class="form-group">
                    <span>Description</span>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                </div>
                <div class="form-group">
                    <span>Upload File</span>
                    <input type="file" class="form-control" id="upload_file" name="upload_file" accept=".pdf">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>
<script>
    function openjobresultpostModal(){
        $('#jobresultpostModal').modal('show');
    }
</script>

<?= $this->endSection() ?>