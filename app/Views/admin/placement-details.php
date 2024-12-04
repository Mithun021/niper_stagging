<!-- app/Views/placementdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <!-- Form Section for Adding Placement Details -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Placement Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <div class="alert alert-success">
                        <?= esc(session()->getFlashdata('status')) ?>
                    </div>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="/placementdetails/store" method="post">
                    <?= csrf_field() ?>

                    <!-- Placement Batch -->
                    <div class="form-group">
                        <span for="Plcbatch">Placement Batch:</span>
                        <input type="text" name="Plcbatch" id="Plcbatch" class="form-control form-control-sm" required>
                    </div>

                    <!-- Department Name -->
                    <div class="form-group">
                        <span for="Deptname">Department Name:</span>
                        <input type="text" name="Deptname" id="Deptname" class="form-control form-control-sm" required>
                    </div>

                    <!-- Total Students -->
                    <div class="form-group">
                        <span for="Totalstudents">Total Students:</span>
                        <input type="number" name="Totalstudents" id="Totalstudents" class="form-control form-control-sm" required>
                    </div>

                    <!-- Number of Placed Students -->
                    <div class="form-group">
                        <span for="Numberofplacedstudent">Number of Placed Students:</span>
                        <input type="number" name="Numberofplacedstudent" id="Numberofplacedstudent" class="form-control form-control-sm" required>
                    </div>

                    <!-- Not Interested Students -->
                    <div class="form-group">
                        <span for="Notinterested">Not Interested Students:</span>
                        <input type="number" name="Notinterested" id="Notinterested" class="form-control form-control-sm" required>
                    </div>

                    <!-- PhD Students -->
                    <div class="form-group">
                        <span for="phd">PhD Students:</span>
                        <input type="number" name="phd" id="phd" class="form-control form-control-sm" required >
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Placement Details (Optional) -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Placement Details List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Batch</td>
                                <td>Dept Name</td>
                                <td>Total Std</td>
                                <td>No. Placed Std</td>
                                <td>Not Interested</td>
                                <td>PhD Std</td>
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