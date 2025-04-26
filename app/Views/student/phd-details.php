<?= $this->extend("student/stdlayouts/master") ?>
<?= $this->section("student-content"); ?>

<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0"><?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>student/phd-details" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <?php if (session()->getFlashdata('status')): ?>
                        <?= session()->getFlashdata('status') ?>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <span>Phd Title<span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="phd_title" value="">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <span>Description<span class="text-danger">*</span></span>
                                <textarea class="form-control form-control-sm" name="description" id="editor"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="relegion">Supervisor Name :<span class="text-danger">*</span></span>
                                <select name="supervisor" id="supervisor" class="form-control form-control-sm" required>
                                    <option value="">Select Supervisor</option>
                                <?php foreach ($employeeData as $emp): ?>
                                    <option value="<?= $emp['id'] ?>"><?= $emp['sir_name']." ".$emp['first_name']." ".$emp['middle_name']." ".$emp['last_name'] ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Degree Type <span class="text-danger">*</span></span>
                                <select class="form-control form-control-sm" name="degree_type" id="degree_type" required>
                                    <option value="">Select Degree Type</option>
                                    <option value="10th">10th</option>
                                    <option value="12th">12th</option>
                                    <option value="Under Graduate">Under Graduate</option>
                                    <option value="Post Graduate">Post Graduate</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Board/ Institute Name<span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="board_institute_name" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>