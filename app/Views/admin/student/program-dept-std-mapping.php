<!-- app/Views/progdeptstudentmap_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <!-- Form Section for Adding  -->
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
                <form action="/progdeptstudentmap/store" method="post">
                    <?= csrf_field() ?>

                    <!-- Program-Department Mapping ID -->
                    <div class="form-group">
                        <span for="Deptid">Department ID:</span>
                        <select name="Deptid" id="Deptid" class="form-control form-control-sm" required >
                            <option value="">Select Deparrtment</option>
                        <?php foreach ($department as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <!-- Program ID -->
                    <div class="form-group">
                        <span for="Progid">Program ID:</span>
                        <select name="Progid" id="Progid" class="form-control form-control-sm" required >
                            <option value="">Select Program</option>
                        </select>
                    </div>

                    <!-- Student ID -->
                    <div class="form-group">
                        <span for="Studentid">Student ID:</span>
                        <select name="Studentid" id="Studentid" class="form-control form-control-sm" required >
                            <option value="">Select Program</option>
                        </select>
                    </div>

                    <!-- Semester -->
                    <div class="form-group">
                        <span for="semester">Semester:</span>
                        <input type="number" name="semester" id="semester" class="form-control form-control-sm" required min="1" max="12" value="<?= esc(old('semester')) ?>">
                    </div>

                    <!-- Batch -->
                    <div class="form-group">
                        <span for="Batch">Batch:</span>
                        <input type="text" name="Batch" id="Batch" class="form-control form-control-sm" required value="<?= esc(old('Batch')) ?>">
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Mappings (Optional) -->
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
                                <td>Program-Dept Map</td>
                                <td>Student</td>
                                <td>Semester</td>
                                <td>Batch</td>
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