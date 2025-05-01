<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>
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
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>admin/placement-job-details" method="post" enctype="multipart/form-data" id="alumini-page-notification-form">
                <div class="card-body p-1">
                    <?php if (session()->getFlashdata('status')) {
                        echo session()->getFlashdata('status');
                    } ?>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <span for="title">Company Name</span>
                            <select class="form-control form-control-sm" name="company_name" required>
                                <option value="">--Select--</option>
                            <?php foreach ($company_details as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['company_name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Job Title</span>
                            <input type="text" class="form-control form-control-sm" name="job_title" id="job_title" placeholder="Enter Company Name" required>
                        </div>
                        <div class="form-group col-md-12">
                            <span for="title">Job Description</span>
                            <textarea name="description" id="editor" class="form-control form-control-sm"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Number of positions</span>
                            <input type="url" name="no_of_position" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="title">Minimum Salary</span>
                            <input type="number" name="minimum_salary" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="title">Maximum Salary</span>
                            <input type="number" name="maximum_salary" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="title">Hiring Date and time</span>
                            <input type="datetime" name="hiring_date_time" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Venue</span>
                            <input type="text" name="venue" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Meeting link</span>
                            <input type="url" name="meetinf_link" class="form-control form-control-sm" required>
                        </div>
                        
                    </div>
                </div>
                <div class="card-footer p-2">
                    <input type="submit" class="btn btn-primary" value="Submit" id="submit">
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>