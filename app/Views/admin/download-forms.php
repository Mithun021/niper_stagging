<!-- app/Views/downloadforms_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <!-- Form Section for Adding Download Form -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Download Form</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/download-forms" method="post" enctype="multipart/form-data">
                    
                    <!-- Form Title -->
                    <div class="form-group">
                        <span for="Formtitle">Form Title:</span>
                        <input type="text" name="Formtitle" id="Formtitle" class="form-control form-control-sm" required value="<?= esc(old('Formtitle')) ?>">
                    </div>

                    <!-- Form Description -->
                    <div class="form-group mt-3">
                        <span for="Formdesc">Form Description:</span>
                        <textarea name="Formdesc" id="editor" class="form-control form-control-sm" rows="4" required><?= esc(old('Formdesc')) ?></textarea>
                    </div>

                    <!-- Form File Upload -->
                    <div class="form-group mt-3">
                        <span for="Formfileupload">Upload Form File:</span>
                        <input type="file" name="Formfileupload" id="Formfileupload" class="form-control form-control-sm" accept=".pdf,.docx,.xlsx,.zip,.rar" required>
                    </div>

                    <!-- Form Status -->
                    <div class="form-group mt-3">
                        <span for="Formstatus">Form Status:</span>
                        <select name="Formstatus" id="Formstatus" class="form-control form-control-sm" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Download Forms (Optional) -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Download Forms List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Form Title</td>
                                <td>Description</td>
                                <td>Status</td>
                                <td>File</td>
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