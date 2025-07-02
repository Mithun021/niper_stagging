<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Employee_model;

$employee_model = new Employee_model();
?>

<!-- Patent Details Form -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status'); ?>
                <?php endif; ?>
                <form method="post" action="<?= base_url() ?>admin/edit-patent-details/<?= $patentid ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <span>Patent Title <span class="text-danger">*</span></span>
                            <textarea class="form-control form-control-sm" name="patent_title" id="editor2"><?= $patent_data['patent_title'] ?></textarea>
                        </div>
                        <div class="col-lg-12 form-group">
                            <span>Patent Description</span>
                            <textarea id="editor" name="description"><?= $patent_data['description'] ?></textarea>
                        </div>
                        <div class="col-lg-4 form-group">
                            <span>IPR No <span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="ipr_number" placeholder="Enter IPR number" value="<?= $patent_data['ipr_number'] ?>" required>
                        </div>
                        <div class="col-lg-4 form-group">
                            <span>Patent Type</span>
                            <select class="form-control form-control-sm" name="patent_type" >
                                <option value="">--Select--</option>
                            <?php foreach ($patent_type as $key => $value) { ?>
                                <option value="<?= $value['name'] ?>" <?php if($patent_data['patent_type'] == $value['name']){ echo "selected"; } ?>><?= $value['name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                      	<div class="col-lg-4 form-group">
                            <span>Patent Number</span>
                            <input type="text" class="form-control form-control-sm" name="patent_number" placeholder="Enter patent number" value="<?= $patent_data['patent_no'] ?>">
                        </div>
                        <div class="col-lg-3 form-group">
                            <span>Date of Filing <span class="text-danger">*</span></span>
                            <input type="date" class="form-control form-control-sm" name="filling_date" value="<?= $patent_data['filling_date'] ?>" required>
                        </div>
                        <div class="col-lg-3 form-group">
                            <span>Field Grant Date </span>
                            <input type="date" class="form-control form-control-sm" name="grant_date" value="<?= $patent_data['grant_date'] ?>" required>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span>Current Status </span>
                            <!-- <input type="text" class="form-control form-control-sm" name="current_status" required> -->
                            <select class="form-control form-control-sm" name="current_status" >
                                <option value="">--Select--</option>
                            <?php foreach ($patent_current_status as $key => $value) { ?>
                                <option value="<?= $value['name'] ?>" <?php if($patent_data['current_status'] == $value['name']){ echo "selected"; } ?>><?= $value['name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span>Upload File (PDF, JPG, PNG)</span>
                            <input type="file" class="form-control form-control-sm" name="patent_file" accept=".pdf,.jpg,.png">
                            <?php if (!empty($patent_data['upload_file']) && file_exists('public/admin/uploads/patent/' . $patent_data['upload_file'])): ?>
                                <a href="<?= base_url() ?>public/admin/uploads/patent/<?= $patent_data['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/folder.png" alt="" height="30px"></a>
                            <?php else: ?>
                                <img src="<?= base_url() ?>public/admin/uploads/patent/invalid_image.png" alt="" height="40px">
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span>Employee ID <span class="text-danger">*</span></span>
                            <select class="form-control form-control-sm my-select" name="emp_id[]" multiple required>
                                <option value="">--Select--</option>
                                <?php foreach ($employees as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>" <?php if (in_array($value['id'], explode(",", $patent_data['employee_id']))) { echo "selected"; } ?>><?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-12 form-group">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="bg-light">
                                        <tr>
                                            <td scope="col">Author Details</td>
                                            <td scope="col"><button type="button" class="btn btn-sm btn-primary" onclick="openauthorModal()">+</button></td>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php foreach ($patent_author as $key => $author) { ?>
                                        <tr>
                                            <td>
                                                <?= $author['author_name'] ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger" onclick="deletePatentAuthor(<?= $author['id'] ?>)">-</button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-4 form-group">
                            <span>Patent Status <span class="text-danger">*</span></span>
                            <select class="form-control form-control-sm" name="patent_status" required>
                                <option value="0" <?php if($patent_data['status'] == 0){ echo "selected"; } ?>>Draft</option>
                                <option value="1" <?php if($patent_data['status'] == 1){ echo "selected"; } ?>>Active</option>
                            </select>
                        </div>
                        <div class="col-lg-12 form-group">
                            <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Title</td>
                                <td>Type</td>
                                <td>Number</td>
                                <td>Current Status</td>
                                <td>Patent Date</td>
                                <td>Status</td>
                                <td>Emp. ID</td>
                                <td>Uploaded by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($patent as $key => $value) { ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td>
                                    <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/patent/' . $value['upload_file'])): ?>
                                        <a href="<?= base_url() ?>public/admin/uploads/patent/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/folder.png" alt="" height="30px"></a>
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>public/admin/uploads/patent/invalid_image.png" alt="" height="40px">
                                    <?php endif; ?>
                                </td>
                                <td><?= $value['patent_title'] ?></td>
                                <td><?= $value['patent_type'] ?></td>
                                <td><?= $value['ipr_number'] ?></td>
                                <td><?= $value['current_status'] ?></td>
                                <td><?= $value['filling_date'] ?></td>
                                <td><?= $value['status'] == 0 ? '<span class="badge badge-danger badge-pill">Draft</span>' : '<span class="badge badge-success badge-pill">Active</span>' ?></td>
                                <td> <?php
                                    $emp_ids = explode(',',$value['employee_id']);
                                    foreach ($emp_ids as $key => $ids) {
                                        $emp = $employee_model->get($ids); if($emp){
                                        echo '<i class="fa fa-angle-right"></i> '.$emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name'] . "<br>";
                                        }
                                    }
                                ?>
                                </td>
                                <td><?php $emp = $employee_model->get($value['upload_by']);
                                    echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        <a href="<?= base_url() ?>admin/edit-patent-details/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                        <a href="<?= base_url() ?>admin/delete-patent-details/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure...!')"><i class="far fa-trash-alt"></i></a>
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

<div class="modal fade" id="authorModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Author</h5>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url() ?>admin/add-copyright-author/<?= $copyrightid ?>" method="post">
            <div class="modal-body">
                <input type="text" class="form-control" id="author_name" name="author_name" placeholder="Enter Author Name">
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
    function openauthorModal(){
        $('#authorModal').modal('show');
    }
    function deleteCopyrightAuthor(id) {
        if (confirm("Are you sure you want to delete this author?")) {
            $.ajax({
                url: "<?= base_url() ?>admin/delete-copyright-author/" + id,
                type: "GET",
                success: function(response) {
                    if (response == 'success') {
                        alert("Author deleted successfully.");
                        location.reload();
                    } else {
                        alert("Failed to delete author.");
                    }
                },
                error: function() {
                    alert("An error occurred while deleting the author.");
                }
            });
        }
    }
</script>

<?= $this->endSection(); ?>