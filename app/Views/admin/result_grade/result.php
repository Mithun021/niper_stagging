<!-- app/Views/resultdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <!-- Form Section for Adding Result Details -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Result Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <div class="alert alert-success">
                        <?= esc(session()->getFlashdata('status')) ?>
                    </div>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="/resultdetails/store" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <!-- Result Description -->
                    <div class="form-group">
                        <span for="resultdesc">Result Description:</span>
                        <textarea name="resultdesc" id="editor" class="form-control form-control-sm" required ></textarea>
                    </div>

                    <!-- Program-Department Mapping ID -->
                    <div class="form-group mt-3">
                        <span for="Progdeptmapid">Program-Department Mapping ID:</span>
                        <select name="Progdeptmapid" id="Progdeptmapid" class="form-control form-control-sm" required>
                            <option value="">--Select--</option>
                        </select>
                    </div>

                    <!-- Semester -->
                    <div class="form-group mt-3">
                        <span for="Semester">Semester:</span>
                        <input type="number" name="Semester" id="Semester" class="form-control form-control-sm" required min="1" max="12" >
                    </div>

                    <!-- Result File Upload -->
                    <div class="form-group mt-3">
                        <span for="Resultfileupload">Upload Result File:</span>
                        <input type="file" name="Resultfileupload" id="Resultfileupload" class="form-control form-control-sm" accept=".pdf,.doc,.docx,.jpg,.png" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Result Details (Optional) -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Result Details List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Result Description</td>
                                <td>Program-Dept Map ID</td>
                                <td>Semester</td>
                                <td>Result File</td>
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