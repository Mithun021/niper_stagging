<!-- app/Views/studentdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <!-- Form Section for Adding Student Details -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <div class="alert alert-success">
                        <?= esc(session()->getFlashdata('status')) ?>
                    </div>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="/studentdetails/store" method="post">
                    <!-- Student Enrollment ID -->
                    <div class="form-group">
                        <span for="Stdenrollid">Student Enrollment ID: <span class="text-danger">*</span></span>
                        <input type="text" name="Stdenrollid" id="Stdenrollid" class="form-control form-control-sm" required>
                    </div>

                    <!-- Student Name -->
                    <div class="form-group">
                        <span for="Stdname">Student Name:<span class="text-danger">*</span></span>
                        <input type="text" name="Stdname" id="Stdname" class="form-control form-control-sm" required>
                    </div>

                    <!-- Student Email ID -->
                    <div class="form-group">
                        <span for="Stdemailid">Student Email ID:<span class="text-danger">*</span></span>
                        <input type="email" name="Stdemailid" id="Stdemailid" class="form-control form-control-sm" required>
                    </div>

                    <!-- Student Email ID -->
                    <div class="form-group">
                        <span for="Stdemailid">Student Phone No.:<span class="text-danger">*</span></span>
                        <input type="email" name="Stdphone" id="Stdphone" class="form-control form-control-sm" required>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Students (Optional) -->
    <div class="col-lg-8">
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