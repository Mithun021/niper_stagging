<?= $this->extend("admin/layouts/master") ?>

<?= $this->section("body-content"); ?>

<!-- Copyright Details Form -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('status'); ?>
                    </div>
                <?php endif; ?>
                <form id="CopyrightForm" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6 form-group">
                        <span>Copyright Title <span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="Copyright_title" placeholder="Enter Copyright title" required>
                    </div>
                    <div class="col-lg-6 form-group">
                        <span>Copyright Number <span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="Copyright_number" placeholder="Enter Copyright number" required>
                    </div>
                    <div class="col-lg-12 form-group">
                        <span>Copyright Description</span>
                        <textarea id="editor" name="content"></textarea>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <span for="">Copyright start datetime<span class="text-danger">*</span></span>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" name="news_date"  placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                <input type="text" class="form-control form-control-sm" name="news_date"  placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <span for="">Copyright end datetime<span class="text-danger">*</span></span>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" name="news_date"  placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                <input type="text" class="form-control form-control-sm" name="news_date"  placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <span>Upload File (PDF, JPG, PNG)</span>
                        <input type="file" class="form-control form-control-sm" name="Copyright_file" accept=".pdf,.jpg,.png" required>
                    </div>
                    <div class="col-lg-6 form-group">
                        <span>Employee ID <span class="text-danger">*</span></span>
                        <select class="form-control form-control-sm" name="emp_id" required>
                            <option value="">--Select--</option>
                        </select>
                    </div>
                    <div class="col-lg-6 form-group">
                        <span>Author Name <span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="Copyright_date" required>
                    </div>
                    <div class="col-lg-6 form-group">
                        <span>Copyright Status <span class="text-danger">*</span></span>
                        <select class="form-control form-control-sm" name="Copyright_status" required>
                            <option value="Draft">Draft</option>
                            <option value="Active">Active</option>
                        </select>
                    </div>
                    <div class="col-lg-12 form-group">
                        <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
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
                                <td>Number</td>
                                <td>Start Date</td>
                                <td>End Date</td>
                                <td>Status</td>
                                <td>Uploaded by</td>
                                <td>Create at</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table data goes here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
