<!-- app/Views/committee_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <div class="col-lg-5">
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
                <form action="/committee/store" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="Committeetitle">Committee Title:</span>
                        <input type="text" name="Committeetitle" id="Committeetitle" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <span for="Committeetitle">Parent Committee:</span>
                        <select name="subcommitteeid" id="subcommitteeid" class="form-control form-control-sm" required>
                            <option value="">--Select Committee--</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <span for="Committeedesc">Committee Description:</span>
                        <textarea id="editor" name="content"></textarea>
                    </div>
                    <div class="form-group">
                        <span for="Committeefileupload">File Upload:</span>
                        <input type="file" name="Committeefileupload" id="Committeefileupload" class="form-control form-control-sm" accept=".pdf,.docx,.zip">
                    </div>
                    <div class="form-group">
                        <span for="Committeestatus">Status:</span>
                        <select class="form-control form-control-sm" name="committee_status" required>
                            <option value="0">Draft</option>
                            <option value="1">Active</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Display Committees in a Table -->
    <div class="col-lg-7">
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
                                <td>Comm. name</td>
                                <td>Parent Comm.</td>
                                <td>Status</td>
                                <td>File</td>
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