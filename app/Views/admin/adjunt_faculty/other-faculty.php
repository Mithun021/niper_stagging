<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

?>

<style>
    /* Add your custom styles here if needed */
</style>

<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Faculty Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                } ?>
                <form method="post" action="<?= base_url('admin/faculty-save') ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <span>First Name<span class="text-danger">*</span></span>
                            <div class="input-group">
                                <select class="form-control form-control-sm" name="annotation" required>
                                    <option value="">--Select--</option>
                                    <option value="Mr.">Mr.</option>
                                    <option value="Mrs.">Mrs.</option>
                                    <option value="Prof.">Prof.</option>
                                    <option value="Dr.">Dr.</option>
                                </select>
                                <input type="text" class="form-control form-control-sm" name="first_name" required>
                            </div>

                        </div>
                        <div class="form-group col-md-4">
                            <span>Middle Name</span>
                            <input type="text" class="form-control form-control-sm" name="middle_name">
                        </div>
                        <div class="form-group col-md-4">
                            <span>Last Name<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="last_name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Designation<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="designation" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Organisation Name</span>
                            <input type="text" class="form-control form-control-sm" name="organisation_name">
                        </div>
                        <div class="form-group col-md-6">
                            <span>Organisation Address</span>
                            <input type="text" class="form-control form-control-sm" name="organisation_address">
                        </div>
                        <div class="form-group col-md-6">
                            <span>Personal Email<span class="text-danger">*</span></span>
                            <input type="email" class="form-control form-control-sm" name="personal_email" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Official Email</span>
                            <input type="email" class="form-control form-control-sm" name="official_email">
                        </div>
                        <div class="form-group col-md-6">
                            <span>Mobile<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="mobile" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>LinkedIn</span>
                            <input type="url" class="form-control form-control-sm" name="linkedin">
                        </div>
                        <div class="form-group col-md-6">
                            <span>Twitter</span>
                            <input type="url" class="form-control form-control-sm" name="twitter">
                        </div>
                        <div class="form-group col-md-6">
                            <span>Facebook</span>
                            <input type="url" class="form-control form-control-sm" name="facebook">
                        </div>
                        <div class="form-group col-md-6">
                            <span>Research Interest</span>
                            <textarea class="form-control form-control-sm" name="research_interest"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Description</span>
                            <textarea class="form-control form-control-sm" name="description"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Photo Upload</span>
                            <input type="file" class="form-control-file" name="photo">
                        </div>
                        <div class="form-group col-md-6">
                            <span>Resume File Upload</span>
                            <input type="file" class="form-control-file" name="resume">
                        </div>
                        <div class="form-group col-md-6">
                            <span>Faculty Type<span class="text-danger">*</span></span>
                            <select class="form-control form-control-sm" name="faculty_type" required>
                                <option value="">--Select--</option>
                                <option value="Permanent">Permanent</option>
                                <option value="Visiting">Visiting</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Faculty List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Annotation</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Organisation</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Action</th>
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