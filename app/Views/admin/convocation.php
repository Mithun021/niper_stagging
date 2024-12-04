<!-- app/Views/convocationdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <!-- Form Section for Adding Convocation Details -->
    <div class="col-lg-6">
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
                <form action="/convocationdetails/store" method="post" enctype="multipart/form-data">

                    <!-- Convocation Number -->
                    <div class="form-group">
                        <span for="Convnumber">Convocation Number:</span>
                        <input type="text" name="Convnumber" id="Convnumber" class="form-control form-control-sm" required>
                    </div>

                    <!-- Upload Awardee File -->
                    <div class="form-group mt-3">
                        <span for="Awardeefileupload">Upload Awardee File:</span>
                        <input type="file" name="Awardeefileupload" id="Awardeefileupload" class="form-control form-control-sm" accept=".pdf,.doc,.docx,.jpg,.png" required>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Convocation Details (Optional) -->
    <div class="col-lg-6">
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
                                <td>Convocation Number</td>
                                <td>Awardee File</td>
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