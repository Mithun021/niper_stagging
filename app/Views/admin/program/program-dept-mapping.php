<!-- app/Views/programdeptmapping_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <!-- Form Section for Adding Program-Department Mapping -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Program-Department Mapping</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= esc(session()->getFlashdata('status')) ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/program-dept-mapping'" method="post" enctype="multipart/form-data">
                    <!-- Department ID -->
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
                        <?php foreach ($program as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                        <?php } ?>
                        </select>
                    </div>

                    <!-- Eligibility Criteria -->
                    <div class="form-group">
                        <span for="Elligibilitycriteria">Eligibility Criteria:</span>
                        <textarea name="eligibility" id="editor" class="form-control form-control-sm"></textarea>
                    </div>

                    <!-- Number of Seats -->
                    <div class="form-group">
                        <span for="Noofseats">Number of Seats:</span>
                        <input type="number" name="Noofseats" id="Noofseats" class="form-control form-control-sm" required min="1">
                    </div>

                    <div class="form-group">
                        <span for="Noofseats">Batch Sart:</span>
                        <input type="number" name="batchStart" id="batchStart" class="form-control form-control-sm" required min="2000">
                    </div>

                    <div class="form-group">
                        <span for="Noofseats">Batch End:</span>
                        <input type="number" name="batchEnd" id="batchEnd" class="form-control form-control-sm" required min="2000">
                    </div>

                    <!-- Syllabus Upload -->
                    <div class="form-group">
                        <span for="Syllabus">Upload Syllabus(.pdf,.doc,.docx):</span>
                        <input type="file" name="Syllabus" id="Syllabus" class="form-control form-control-sm" accept=".pdf,.doc,.docx" required>
                    </div>

                    <div class="form-group">
                        <span>Status</span>
                        <select name="status" id="status" class="form-control form-control-sm">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Mappings (Optional) -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Program-Department Mapping List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Program</td>
                                <td>Dept.</td>
                                <td>Eligibility Criteria</td>
                                <td>No. of Seats</td>
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