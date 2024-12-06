<!-- app/Views/empexpdetails_form.php -->

<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title; ?></h4>
            </div>

            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('status') ?>
                    </div>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="/empexpdetails/store" method="post">
                    <!-- Empid -->
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <span for="Empid">Employee:</span>
                            <select name="Empid" id="Empid" class="form-control form-control-sm" required >
                                <option value="">Select Employee</option>
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span for="designation">Designation:</span>
                            <select name="designation" id="designation" class="form-control form-control-sm" required >
                                <option value="">Select Designation</option>
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span for="orgname">Organization Name:</span>
                            <input type="text" name="orgname" id="orgname" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-lg-3 form-group">
                            <span for="startdate">Start Date:</span>
                            <input type="date" name="startdate" id="startdate" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-lg-3 form-group">
                            <span for="enddate">End Date:</span>
                            <input type="date" name="enddate" id="enddate" class="form-control form-control-sm">
                        </div>
                        <div class="col-lg-12 form-group">
                            <span for="expdesc">Experience Description:</span>
                            <textarea name="expdesc" id="editor" class="form-control form-control-sm" rows="4"></textarea>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span for="orgtype">Organization Type:</span>
                            <select name="orgtype" id="orgtype" class="form-control form-control-sm" required>
                                <option value="Central Government">Central Government</option>
                                <option value="State Government">State Government</option>
                                <option value="Autonomous">Autonomous</option>
                                <option value="PSU">PSU</option>
                                <option value="Private">Private</option>
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span for="natureofwork">Nature of Work:</span>
                            <select name="natureofwork" id="natureofwork" class="form-control form-control-sm" required>
                                <option value="Teaching">Teaching</option>
                                <option value="Research">Research</option>
                                <option value="Administrative">Administrative</option>
                                <option value="Post Doc">Post Doc</option>
                            </select>
                        </div>
                        <div class="col-lg-12 form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        
                    </div><!-- Close row -->
                </form>
            </div>
        </div>
    </div>

    <!-- Table to display existing empexpdetails -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title; ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Employee</td>
                                <td>Designation</td>
                                <td>Org. Name</td>
                                <td>Start & End Date</td>
                                <td>Org. Type</td>
                                <td>Work Nature</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>