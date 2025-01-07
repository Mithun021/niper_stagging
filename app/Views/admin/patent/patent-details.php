<?= $this->extend("admin/layouts/master") ?>

<?= $this->section("body-content"); ?>

<!-- Patent Details Form -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status'); ?>
                <?php endif; ?>
                <form method="post" action="<?= base_url() ?>admin/patent-details" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6 form-group">
                        <span>Patent Title <span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="patent_title" placeholder="Enter patent title" required>
                    </div>
                    <div class="col-lg-6 form-group">
                        <span>Patent Number <span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="patent_number" placeholder="Enter patent number" required>
                    </div>
                    <div class="col-lg-12 form-group">
                        <span>Patent Description</span>
                        <textarea id="editor" name="description"></textarea>
                    </div>
                    
                    <div class="col-lg-6 form-group">
                        <span>Patent Date <span class="text-danger">*</span></span>
                        <input type="date" class="form-control form-control-sm" name="patent_date" required>
                    </div>
                    <div class="col-lg-6 form-group">
                        <span>Upload File (PDF, JPG, PNG)</span>
                        <input type="file" class="form-control form-control-sm" name="patent_file" accept=".pdf,.jpg,.png" required>
                    </div>
                    <div class="col-lg-6 form-group">
                        <span>Employee ID <span class="text-danger">*</span></span>
                        <select class="form-control form-control-sm" name="emp_id" required>
                            <option value="">--Select--</option>
                        <?php foreach ($employees as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['first_name']." ".$value['middle_name']." ".$value['last_name'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-3 form-group">
                        <span>Author Name <span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="author_name" required>
                    </div>
                    <div class="col-lg-3 form-group">
                        <span>Patent Status <span class="text-danger">*</span></span>
                        <select class="form-control form-control-sm" name="patent_status" required>
                            <option value="0">Draft</option>
                            <option value="1">Active</option>
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
                                <td>Patent Date</td>
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
