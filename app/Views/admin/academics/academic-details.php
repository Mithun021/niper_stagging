<!-- app/Views/academicdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <!-- Form Section for Adding Academic Details -->
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Academic Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <div class="alert alert-success">
                        <?= esc(session()->getFlashdata('status')) ?>
                    </div>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="/academicdetails/store" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <!-- Academic Year -->
                    <div class="form-group">
                        <span for="Acdyear">Academic Year:</span>
                        <input type="text" name="Acdyear" id="Acdyear" class="form-control form-control-sm" required >
                    </div>

                    <!-- Upload Academic Calendar -->
                    <div class="form-group mt-3">
                        <span for="Acdcalenderfileupload">Upload Academic Calendar(.pdf,.doc,.docx,.jpg,.png):</span>
                        <input type="file" name="Acdcalenderfileupload" id="Acdcalenderfileupload" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png" required>
                    </div>

                    <!-- Upload Academic Fees File -->
                    <div class="form-group mt-3">
                        <span for="Acdfeesfileupload">Upload Fees File(.pdf,.doc,.docx,.jpg,.png):</span>
                        <input type="file" name="Acdfeesfileupload" id="Acdfeesfileupload" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png" required>
                    </div>
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Academic Details (Optional) -->
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Academic Details List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Academic Year</td>
                                <td>Calendar</td>
                                <td>Fees File</td>
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