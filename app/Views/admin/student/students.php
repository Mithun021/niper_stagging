<!-- app/Views/studentdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <!-- Form Section for Adding Student Details -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
                <div>
                    <button type="button" class="btn btn-sm btn-danger" id="export_sample_btn">Export Std. Sample</button>
                    <button class="btn btn-sm btn-primary" id="upload_emp_exp_btn">Import</button>
                </div>
            </div>
            <form action="/studentdetails/store" method="post">
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                        <?= session()->getFlashdata('status') ?>
                <?php endif; ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span>Uload Profile Image <span class="text-danger">*</span></span>
                            <input type="file" class="form-control form-control-sm" name="std_first_name">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Student Enrollment ID -->
                        <div class="form-group">
                            <span for="Stdenrollid">Student Enrollment ID: <span class="text-danger">*</span></span>
                            <input type="text" name="Stdenrollid" id="Stdenrollid" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <span>First Name <span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="std_first_name">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <span>Middle Name</span>
                            <input type="text" class="form-control form-control-sm" name="std_first_name">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <span>Last Name</span>
                            <input type="text" class="form-control form-control-sm" name="std_first_name">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span>Father's Name</span>
                            <input type="text" class="form-control form-control-sm" name="std_first_name">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span>Mother's Name</span>
                            <input type="text" class="form-control form-control-sm" name="std_first_name">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span>Date of Birth</span>
                            <input type="date" class="form-control form-control-sm" name="std_first_name">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span>Blood Group</span>
                            <input type="text" class="form-control form-control-sm" name="std_first_name">
                        </div>
                    </div>
                    <div class="col-lg-6">
                         <!-- Student Email ID -->
                        <div class="form-group">
                            <span for="Stdemailid">Personal Email ID:<span class="text-danger">*</span></span>
                            <input type="email" name="Stdemailid" id="Stdemailid" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                         <!-- Student Email ID -->
                        <div class="form-group">
                            <span for="Stdemailid">Offical Email ID:<span class="text-danger">*</span></span>
                            <input type="email" name="Stdemailid" id="Stdemailid" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Stdemailid">Student Phone No.:<span class="text-danger">*</span></span>
                            <input type="email" name="Stdphone" id="Stdphone" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="col-lg-6"></div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Stdemailid">Permanent Address:<span class="text-danger">*</span></span>
                            <textarea name="Stdemailid" id="Stdemailid" class="form-control form-control-sm" required></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Stdemailid">Correspondence Address:<span class="text-danger">*</span></span>
                            <textarea name="Stdemailid" id="Stdemailid" class="form-control form-control-sm" required></textarea>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="card-footer py-1">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>

    <!-- Table Section to Display Existing Students (Optional) -->
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
                                <td>Enroll ID</td>
                                <td>Std Name</td>
                                <td>Email ID</td>
                                <td>Phone no.</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dynamically populated rows go here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>