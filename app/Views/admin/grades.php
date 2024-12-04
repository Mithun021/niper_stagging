<!-- app/Views/gradedetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <!-- Form Section for Adding Grade Details -->
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Grade Details</h4>
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
                        <span for="Grade">Grade:</span>
                        <input type="text" name="Grade" id="Grade" class="form-control form-control-sm" required value="<?= esc(old('Grade')) ?>">
                    </div>

                    <!-- Grade Point -->
                    <div class="form-group mt-3">
                        <span for="Gradepoint">Grade Point:</span>
                        <input type="number" name="Gradepoint" id="Gradepoint" class="form-control form-control-sm" step="0.1" min="0" max="4.0" required value="<?= esc(old('Gradepoint')) ?>">
                    </div>

                    <!-- Performance -->
                    <div class="form-group mt-3">
                        <span for="Performances">Performance Description:</span>
                        <textarea name="Performances" id="editor" class="form-control form-control-sm" required></textarea>
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
                <h4 class="card-title m-0">Grade Details List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Grade</td>
                                <td>Grade Point</td>
                                <td>Performance</td>
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