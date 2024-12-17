<!-- app/Views/progdeptstudentmap_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <!-- Form Section for Adding  -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="/progdeptstudentmap/store" method="post">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Deptid">Department ID:</span>
                            <select name="Deptid" id="Deptid" class="form-control form-control-sm" required >
                                <option value="">Select Deparrtment</option>
                            <?php foreach ($department as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Program ID -->
                        <div class="form-group">
                            <span for="Progid">Program ID:</span>
                            <select name="Progid" id="Progid" class="form-control form-control-sm" required >
                                <option value="">Select Program</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Batch -->
                        <div class="form-group">
                            <span for="Batch">Batch Strat and End Year:</span>
                            <div class="input-group">
                                <input type="number" class="form-control form-control-sm" name="batch_start_year"  placeholder="Start Year" min="2000">
                                <input type="number" class="form-control form-control-sm" name="batch_end_year"  placeholder="End Year" min="2000">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Semester -->
                        <div class="form-group">
                            <span for="semester">Semester:</span>
                            <select name="semester" id="semester" class="form-control form-control-sm" required>
                                <option value="I">I</option>
                                <option value="II">II</option>
                                <option value="III">III</option>
                                <option value="IV">IV</option>
                                <option value="V">V</option>
                                <option value="VI">VI</option>
                                <option value="VII">IVI</option>
                                <option value="VIII">VIII</option>
                                <option value="IX">IX</option>
                                <option value="X">X</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Batch">Student Details:</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </div>
                </div>
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
                                <td>Department</td>
                                <td>Program</td>
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