<?= $this->extend("student/stdlayouts/master") ?>
<?= $this->section("student-content"); ?>

<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0"><?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>student/academic-details" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <?php if (session()->getFlashdata('status')): ?>
                        <?= session()->getFlashdata('status') ?>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Degree Type <span class="text-danger">*</span></span>
                                <select class="form-control form-control-sm" name="degree_type" value="" required>
                                    <option value="">Select Degree Type</option>
                                    <option value="10th">10th</option>
                                    <option value="12th">12th</option>
                                    <option value="Under Graduate">Under Graduate</option>
                                    <option value="Post Graduate">Post Graduate</option>
                                    <option value="Other">Other</option>
                                </select>
                                <input type="text" class="form-control form-control-sm" name="other_degree_name" value="">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Board/ Institute	Name<span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="board_institute_name" value="">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Subjects Studied<span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="subject_studied" value="">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Marks Type <span class="text-danger">*</span></span>
                                <select class="form-control form-control-sm" name="marks_type" value="" required>
                                    <option value="">Select Marks Type</option>
                                    <option value="CGPA">CGPA</option>
                                    <option value="GPA">GPA</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Marks Obtained<span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="marks_obtained" value="">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Date of Result Declaration<span class="text-danger">*</span></span>
                                <input type="month" class="form-control form-control-sm" name="marks_obtained" value="">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Date of Degree <span class="text-danger">*</span></span>
                                <input type="month" class="form-control form-control-sm" name="marks_obtained" value="">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>File Upload Option(.pdf)<span class="text-danger">*</span></span>
                                <input type="file" class="form-control form-control-sm" name="marks_obtained" accept=".pdf">
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