<!-- app/Views/recruiterdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <!-- Form Section for Adding Recruiter Details -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Recruiter Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <div class="alert alert-success">
                        <?= esc(session()->getFlashdata('status')) ?>
                    </div>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="/recruiterdetails/store" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <!-- Recruiter Title -->
                    <div class="form-group">
                        <span for="Recruitertitle">Recruiter Title:</span>
                        <input type="text" name="Recruitertitle" id="Recruitertitle" class="form-control form-control-sm" required>
                    </div>

                    <!-- Recruiter Description -->
                    <div class="form-group">
                        <span for="Recruiterdsc">Recruiter Description:</span>
                        <textarea name="Recruiterdsc" id="editor" class="form-control form-control-sm" rows="4" required></textarea>
                    </div>

                    <!-- Recruiter Image Upload -->
                    <div class="form-group">
                        <span for="Recruiterimage">Upload Recruiter Image(.jpg,.jpeg,.png):</span>
                        <input type="file" name="Recruiterimage" id="Recruiterimage" class="form-control form-control-sm" accept=".jpg,.jpeg,.png" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Recruiter Details (Optional) -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Recruiter Details List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Recruiter Title</td>
                                <td>Recruiter Description</td>
                                <td>Recruiter Image</td>
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