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

                        <div class="col-lg-12">
                            <!-- Student Enrollment ID -->
                            <div class="form-group">
                                <span for="Stdenrollid">Student Enrollment ID: <span class="text-danger">*</span></span>
                                <input type="text" name="Stdenrollid" id="Stdenrollid" class="form-control form-control-sm" value="" readonly required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>First Name <span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="std_first_name" value="" required minlength="3" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Middle Name</span>
                                <input type="text" class="form-control form-control-sm" name="std_middle_name" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>