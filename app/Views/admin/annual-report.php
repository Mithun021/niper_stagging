<!-- app/Views/annualreports_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <!-- Form Section for Adding Annual Report -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Annual Report</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>
                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/annual-report" method="post" enctype="multipart/form-data">
                    <!-- Annual Report Title -->
                    <div class="form-group">
                        <span for="Annualreporttitle">Annual Report Title:</span>
                        <input type="text" name="Annualreporttitle" id="Annualreporttitle" class="form-control form-control-sm" required>
                    </div>

                    <!-- Annual Report Description -->
                    <div class="form-group">
                        <span for="Annualreportdesc">Annual Report Description:</span>
                        <textarea name="Annualreportdesc" id="editor" class="form-control form-control-sm" rows="4"></textarea>
                    </div>

                    <!-- Annual Report Photo Upload -->
                    <div class="form-group">
                        <span for="Annualreportphotoupload">Upload Photo .jpg,.jpeg,.png (Optional):</span>
                        <input type="file" name="Annualreportphotoupload" id="Annualreportphotoupload" class="form-control form-control-sm" accept=".jpg,.jpeg,.png">
                    </div>

                    <!-- Annual Report File Upload -->
                    <div class="form-group">
                        <span for="Annualreportfileupload">Upload Report File(.pdf):</span>
                        <input type="file" name="Annualreportfileupload" id="Annualreportfileupload" class="form-control form-control-sm" accept=".pdf" required>
                    </div>
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Annual Reports (Optional) -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Annual Reports List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Report Title</td>
                                <td>Description</td>
                                <td>File</td>
                                <td>Photo</td>
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