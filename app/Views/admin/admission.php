<!-- app/Views/gradedetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <!-- Form Section for Adding <?= $title ?> -->
    <div class="col-lg-5">
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
                <form action="/gradedetails/store" method="post">
                    <?= csrf_field() ?>

                    <!-- Grade -->
                    <div class="form-group">
                        <span for="Grade">Title:</span>
                        <input type="text" name="Grade" id="Grade" class="form-control form-control-sm" required value="<?= esc(old('Grade')) ?>">
                    </div>

                    <!-- Performance -->
                    <div class="form-group">
                        <span for="Performances">Performance Description:</span>
                        <textarea name="Performances" id="editor" class="form-control form-control-sm" required></textarea>
                    </div>

                    <!-- Grade Point -->
                    <div class="form-group">
                        <span for="Gradepoint">Upload File:</span>
                        <input type="file" name="Gradepoint" id="Gradepoint" class="form-control form-control-sm" step="0.1" min="0" max="4.0" required value="<?= esc(old('Gradepoint')) ?>">
                    </div>

                    <div class="form-group">
                        <span>Status</span>
                        <select name="" id="" class="form-control form-control-sm">
                            <option value="1">Active</option>
                            <option value="0">Draft</option>
                        </select>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Grade Details (Optional) -->
    <div class="col-lg-7">
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
                                <td>Title</td>
                                <td>Description</td>
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