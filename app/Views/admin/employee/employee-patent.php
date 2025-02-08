<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Employee_model;

$employee_model = new Employee_model();
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
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form method="post" action="<?= base_url('admin/organisation-type') ?>">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <span for="">Employee Id<span class="text-danger">*</span></span>
                            <select class="form-control form-control-sm" name="employee_id" required>
                                <option value="">--Select--</option>
                            <?php foreach ($employee as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['first_name']." ".$value['middle_name']." ".$value['last_name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="">Reason of Awarding<span class="text-danger">*</span></span>
                            <select class="form-control form-control-sm" name="award_reason" required>
                                <option value="">--Select--</option>
                                <option value="Academic">Academic</option>
                                <option value="Research">Research</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="">Name of Awarding<span class="text-danger">*</span></span>
                            <input type="text" name="name_of_awarding" id="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-6">
                            <span for="">Date of Awarding<span class="text-danger">*</span></span>
                            <input type="date" name="date_of_awarding" id="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-6">
                            <span for="">Body name of Awarding<span class="text-danger">*</span></span>
                            <input type="text" name="body_name_of_awarding" id="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-6">
                            <span for="">Level<span class="text-danger">*</span></span>
                            <select class="form-control form-control-sm" name="level" required>
                                <option value="">--Select--</option>
                                <option value="National">National</option>
                                <option value="International">International</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="">Document Upload(.pdf,.jpg,.jpeg,.png)<span class="text-danger">*</span></span>
                            <input type="file" name="document_file" id="" class="form-control form-control-sm" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="form-group col-md-12">
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
                                <td>Organization Type</td>
                                <td>Upload By</td>
                                <td>Upload Date</td>
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

<?= $this->endSection() ?>