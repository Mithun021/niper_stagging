<?= $this->extend("student/stdlayouts/master") ?>
<?=  $this->section("student-content"); ?>

<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0"><?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>student/experience-details" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <?php if (session()->getFlashdata('status')): ?>
                        <?= session()->getFlashdata('status') ?>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Pubtitle">Designation:<span class="text-danger">*</span></span>
                                <input name="designation" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Pubtitle">Name of Organization:<span class="text-danger">*</span></span>
                                <input name="organization_name" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Pubtitle">Organization Type :<span class="text-danger">*</span></span>
                                <select name="organization_type" class="form-control form-control-sm" required>
                                    <option value="">--Select--</option>
                                    <option value="Central Government">Central Government</option>
                                    <option value="State Government">State Government</option>
                                    <option value="Autonomous">Autonomous</option>
                                    <option value="Private">Private</option>
                                    <option value="PSU">PSU</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Pubtitle">Date of Joining:<span class="text-danger">*</span></span>
                                <input name="joining_date" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Pubtitle">Date of Relieving:</span>
                                <input name="releiving_date" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>File Upload Option(.pdf)<span class="text-danger">*</span></span>
                                <input type="file" class="form-control form-control-sm" name="file_upload" accept=".pdf" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer py-1">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>