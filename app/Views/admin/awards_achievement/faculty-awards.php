<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Department_model;
use App\Models\Designation_model;
use App\Models\Employee_model;
use App\Models\Faculty_awards_gallery_model;

$employee_model = new Employee_model();
$department_model = new Department_model();
$designation_model = new Designation_model();
$faculty_awards_gallery_model = new Faculty_awards_gallery_model();
?>
<style>
    #addServicetable #memberTbody #memberTrow:first-child td:last-child button {
        display: none;
    }
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
                <form method="post" action="<?= base_url() ?>admin/faculty-awards" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <span for="">Title<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="title">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Upload Thumbnail(JPG,PNG)</span>
                            <input type="file" class="form-control form-control-sm" name="upload_file" accept=".jpg, .png, .jpeg" required>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Upload Gallery(JPG,PNG)</span>
                            <input type="file" class="form-control form-control-sm" name="file_gallery[]" accept=".jpg, .png, .jpeg" multiple required>
                        </div>
                        <div class="form-group col-md-12">
                            <span for="">Description</span>
                            <textarea id="editor" name="description"></textarea>
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
                                    <tbody id="memberTbody">
                                        <tr id="memberTrow">
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm" name="faculty_name" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control form-control-sm" name="department" required>
                                                        <option value="">--Select--</option>
                                                        <?php foreach ($departments as $key => $value) { ?>
                                                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control form-control-sm" name="designation" required>
                                                        <option value="">--Select--</option>
                                                        <?php foreach ($designations as $key => $value) { ?>
                                                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td><button type="button" class="btn btn-sm btn-danger" id="removenewMemberRow">-</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <span for="">Awards Date<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="awards_date" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="">Awarding Agency Name</span>
                            <input type="text" class="form-control form-control-sm" name="agency_name">
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
                                <td>Faculty Name</td>
                                <td>Department</td>
                                <td>Designation</td>
                                <td>Awards Date</td>
                                <td>Gallery</td>
                                <td>upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            
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
        // Create Service Clone for add and remove rows also calculate price
        var cloneLimit = 10;
        var currentClones = 0;
        $("#addnewMemberRow").click(function(e) {
            e.preventDefault();
            if (currentClones < cloneLimit) {
                currentClones++;
                var cloneCatrow = $('#memberTrow').clone().appendTo('#memberTbody');
                $(cloneCatrow).find('input').val('');
            }

        });

        $('#memberTbody').on('click', '#removenewMemberRow', function() {
            $(this).closest('tr').remove();
        });

    });
</script>

<?= $this->endSection() ?>