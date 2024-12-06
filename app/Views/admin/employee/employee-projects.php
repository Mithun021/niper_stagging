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
                <form action="/empprojectdetails/store" method="post">
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <span for="Empid">Employee: <span class="text-danger">*</span></span>
                            <select name="Empid" id="Empid" class="form-control form-control-sm" required >
                                <option value="">Select Employee</option>
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span for="projecttitle">Project Title:<span class="text-danger">*</span></span>
                            <input type="text" name="projecttitle" id="projecttitle" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-lg-12">
                            <span for="projectdesc">Project Description:</span>
                            <textarea name="projectdesc" id="editor" class="form-control form-control-sm" rows="4"></textarea>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span for="projectstartdatetime">Project Start Date & Time:<span class="text-danger">*</span></span>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" name="project_start_date"  placeholder="Start Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                <input type="text" class="form-control form-control-sm" name="project_start_time"  placeholder="Start Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                            </div>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span for="projectenddatetime">Project End Date & Time:<span class="text-danger">*</span></span>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" name="project_end_date"  placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                <input type="text" class="form-control form-control-sm" name="project_end_time"  placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                            </div>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span for="projectstatus">Project Status:<span class="text-danger">*</span></span>
                            <select name="projectstatus" id="projectstatus" class="form-control form-control-sm" required>
                                <option value="Not Started">Not Started</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span for="projectsponseredby">Sponsored By:<span class="text-danger">*</span></span>
                            <input type="text" name="projectsponseredby" id="projectsponseredby" class="form-control form-control-sm">
                        </div>
                        <div class="col-lg-6 form-group">
                            <span for="projectvalue">Project Value (in INR):<span class="text-danger">*</span></span>
                            <input type="number" name="projectvalue" id="projectvalue" class="form-control form-control-sm" step="0.01">
                        </div>
                        <div class="col-lg-12 mt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Table to display existing empprojectdetails -->
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
                                <td>Employee ID</td>
                                <td>Project Title</td>
                                <td>Project Status</td>
                                <td>Project Date</td>
                                <td>Project Value</td>
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