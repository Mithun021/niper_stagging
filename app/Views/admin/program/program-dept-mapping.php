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
                    <div class="alert alert-success">
                        <?= esc(session()->getFlashdata('status')) ?>
                    </div>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="/programdeptmapping/store" method="post" enctype="multipart/form-data">
                    <!-- Department ID -->
                    <div class="form-group">
                        <span for="Deptid">Department ID:</span>
                        <select name="Deptid" id="Deptid" class="form-control form-control-sm" required >
                            <option value="">Select Deparrtment</option>
                        </select>
                    </div>
                    
                    <!-- Program ID -->
                    <div class="form-group">
                        <span for="Progid">Program ID:</span>
                        <select name="Deptid" id="Deptid" class="form-control form-control-sm" required >
                            <option value="">Select Program</option>
                        </select>
                    </div>

                    <!-- Eligibility Criteria -->
                    <div class="form-group">
                        <span for="Elligibilitycriteria">Eligibility Criteria:</span>
                        <input type="text" name="eligibility" id="eligibility" class="form-control form-control-sm" required>
                    </div>

                    <!-- Number of Seats -->
                    <div class="form-group">
                        <span for="Noofseats">Number of Seats:</span>
                        <input type="number" name="Noofseats" id="Noofseats" class="form-control form-control-sm" required min="1">
                    </div>

                    <!-- Syllabus Upload -->
                    <div class="form-group">
                        <span for="Syllabus">Upload Syllabus(.pdf,.doc,.docx):</span>
                        <input type="file" name="Syllabus" id="Syllabus" class="form-control form-control-sm" accept=".pdf,.doc,.docx" required>
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