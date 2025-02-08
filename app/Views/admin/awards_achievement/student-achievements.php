<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Courses_model;
use App\Models\Department_model;
use App\Models\Employee_model;
use App\Models\Program_model;

$department_model = new Department_model();
$program_model = new Program_model();
$employee_model = new Employee_model();
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
                <h4 class="card-title m-0">Student Achievements </h4>
            </div>
            <div class="card-body">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form method="post" action="<?= base_url('admin/student-achievements') ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <span for="">Title<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="title">
                        </div>
                        <div class="form-group col-md-6">
                            <span for="">Upload File(JPG,PNG)</span>
                            <input type="file" class="form-control form-control-sm" name="upload_file" accept=".jpg, .png" required>
                        </div>

                        <div class="form-group col-md-12">
                            <span for="">Desription</span>
                            <textarea id="editor" name="description"></textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="addServicetable">
                                    <thead class="bg-light">
                                        <tr>
                                            <td>Student Name</td>
                                            <td>Department</td>
                                            <td>Course Details</td>
                                            <td>Superviser</td>
                                            <td><button type="button" class="btn btn-sm btn-primary" id="addnewMemberRow">+</button></td>
                                        </tr>
                                    </thead>
                                    <tbody id="memberTbody">
                                        <tr id="memberTrow">
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm" name="student_name[]" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control form-control-sm" name="department[]" required>
                                                        <option value="">--Select--</option>
                                                        <?php foreach ($department as $key => $value) { ?>
                                                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control form-control-sm" name="course[]" required>
                                                        <option value="">--Select--</option>
                                                        <?php foreach ($program as $key => $value) { ?>
                                                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control form-control-sm" name="supervisor[]" required>
                                                        <option value="">--Select--</option>
                                                        <?php foreach ($employee as $key => $value) { ?>
                                                            <option value="<?= $value['id'] ?>"><?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></option>.
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
                            <span for="">Awards Date</span>
                            <input type="date" class="form-control form-control-sm" name="awards_date">
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
                <h4 class="card-title m-0">Student Achievements List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Files</td>
                                <td>Student Name</td>
                                <td>Title</td>
                                <td>Description</td>
                                <td>Course</td>
                                <td>Department</td>
                                <td>Supervisor</td>
                                <td>Award Date</td>
                                <td>Agency Name</td>
                                <td>Upload by</td>
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