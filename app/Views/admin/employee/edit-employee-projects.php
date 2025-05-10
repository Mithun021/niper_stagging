<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php

use App\Models\Employee_model;

$employee_model = new Employee_model();
?>

<style>
    #clone_content #clone_employee_data:first-child button#remove-clone {
        display: none;
    }
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Add <?= $title; ?></h4>
            </div>
            <form action="<?= base_url() ?>admin/edit-employee-projects" method="post">
                <div class="card-body">
                    <?php if (session()->getFlashdata('msg')): ?>
                        <?= session()->getFlashdata('msg') ?>
                    <?php endif; ?>

                    <!-- Form Start -->

                    <div class="card card-body mb-1">
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                <span for="Empid">Employee:</span>
                                <select name="Empid" id="Empid" class="form-control form-control-sm" required>
                                    <option value="">Select Employee</option>
                                    <?php foreach ($employee as $value) { ?>
                                        <option value="<?= $value['id'] ?>" <?php if($value['id'] == $employee_projects_detail['emplyee_id']){ echo "selected"; } ?>><?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="clone_content">
                        <div class="card card-body" id="clone_employee_data">
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <span for="projecttitle">Project Title:<span class="text-danger">*</span></span>
                                    <textarea type="text" name="projecttitle" id="" class="form-control form-control-sm clone_editor"><?= $employee_projects_detail['project_title'] ?></textarea>
                                </div>
                                <!-- <div class="col-lg-12">
                            <span for="projectdesc">Project Description:</span>
                            <textarea name="projectdesc" id="" class="form-control form-control-sm clone_editor" rows="4"></textarea>
                        </div> -->
                                <div class="col-lg-4 form-group">
                                    <span for="projectstartdatetime">Project Start Date:<span class="text-danger">*</span></span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" name="project_start_date" placeholder="Start Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                        <!-- <input type="text" class="form-control form-control-sm" name="project_start_time"  placeholder="Start Time" onfocus="(this.type='time')" onblur="(this.type='text')"> -->
                                    </div>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <span for="projectenddatetime">Project End Date:<span class="text-danger">*</span></span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" name="project_end_date" placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                        <!-- <input type="text" class="form-control form-control-sm" name="project_end_time"  placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')"> -->
                                    </div>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <span for="projectenddatetime">Sanctioned Year:</span>
                                    <input type="number" class="form-control form-control-sm" name="sanctioned_year" placeholder="Sanctioned  Year">
                                </div>
                                <div class="col-lg-4 form-group">
                                    <span for="projectstatus">Project Status:<span class="text-danger">*</span></span>
                                    <select name="projectstatus" id="projectstatus" class="form-control form-control-sm" required>
                                        <option value="Not Started">Not Started</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <span for="projectsponseredby">Sponsored By:<span class="text-danger">*</span></span>
                                    <input type="text" name="projectsponseredby" id="projectsponseredby" class="form-control form-control-sm">
                                </div>
                                <div class="col-lg-4 form-group">
                                    <span for="projectvalue">Project Value (in INR):<span class="text-danger">*</span></span>
                                    <input type="number" name="projectvalue" id="projectvalue" class="form-control form-control-sm" step="0.01">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <span for="projectvalue">Role</span>
                                    <select name="role" id="role" class="form-control form-control-sm">
                                        <option value="">--Select--</option>
                                        <option value="PI">PI</option>
                                        <option value="Co-PI">Co-PI</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <span for="funding_source">Funding Source </span>
                                    <select name="funding_source" class="form-control form-control-sm">
                                        <option value="">--Select--</option>
                                        <option value="Government">Government</option>
                                        <option value="Private">Private</option>
                                        <option value="Industry">Industry</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <div class="other_funding_source_container" style="display: none;">
                                        <span>Other Funding Source</span>
                                        <input type="text" class="form-control form-control-sm" name="other_funding_source">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table to display existing empprojectdetails -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title; ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Employee ID</td>
                                <td>Project Title</td>
                                <td>Sanctioned Year</td>
                                <td>Project Status</td>
                                <td>Project Date</td>
                                <td>Sponsored by</td>
                                <td>Project Value</td>
                                <td>Role</td>
                              	<td>Funding Source</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employee_projects as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?php $emp = $employee_model->get($value['emplyee_id']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td><?= $value['project_title'] ?></td>
                                    <td><?= $value['sanctioned_year'] ?></td>
                                    <td><?= $value['project_status'] ?></td>
                                    <td><?= $value['start_date'] . " - " . $value['end_date'] ?></td>
                                    <td><?= $value['sponsored_by'] ?></td>
                                    <td><?= $value['project_value'] ?></td>
                                    <td><?= $value['role'] ?></td>
                              	    <td><?= $value['funding_source'] ?> <?= $value['other_funding_source'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <!-- <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a> -->
                                            <a href="<?= base_url() ?>admin/edit-employee-projects/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-employee-projects/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure...!')"><i class="far fa-trash-alt"></i></a>
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


<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<!-- jQuery Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<?= $this->endSection() ?>