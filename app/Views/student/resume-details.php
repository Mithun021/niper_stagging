<?= $this->extend("student/stdlayouts/master") ?>
<?= $this->section("student-content"); ?>

<!-- start page title -->
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Add Skills</h4>
            </div>
            <form action="<?= base_url() ?>student/student-skills" method="post" enctype="multipart/form-data">
                <div class="card-body p-1">
                    <?php if (session()->getFlashdata('status')): ?>
                        <?= session()->getFlashdata('status') ?>
                    <?php endif; ?>
                    <div class="form-group">
                        <span for="skills" class="form-span">Skills</span>
                        <input type="text" class="form-control" id="skills" name="skills" placeholder="Enter your skills">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Add Skills">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Area of Interest</h4>
            </div>
            <form action="<?= base_url() ?>student/student-area-interest" method="post" enctype="multipart/form-data">
                <div class="card-body p-1">
                    <?php if (session()->getFlashdata('status')): ?>
                        <?= session()->getFlashdata('status') ?>
                    <?php endif; ?>
                    <div class="form-group">
                        <span for="skills" class="form-span">Area Interest</span>
                        <input type="text" class="form-control" id="area_interest" name="area_interest" placeholder="Enter your insterest">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Language</h4>
            </div>
            <form action="<?= base_url() ?>student/student-language" method="post" enctype="multipart/form-data">
                <div class="card-body p-1">
                    <?php if (session()->getFlashdata('status')): ?>
                        <?= session()->getFlashdata('status') ?>
                    <?php endif; ?>
                    <div class="form-group">
                        <span for="skills" class="form-span">Language</span>
                        <input type="text" class="form-control" id="language" name="language" placeholder="Englis,Hindi...">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Hobbies</h4>
            </div>
            <form action="<?= base_url() ?>student/student-hobbies" method="post" enctype="multipart/form-data">
                <div class="card-body p-1">
                    <?php if (session()->getFlashdata('status')): ?>
                        <?= session()->getFlashdata('status') ?>
                    <?php endif; ?>
                    <div class="form-group">
                        <span for="skills" class="form-span">Hobbies</span>
                        <input type="text" class="form-control" id="hobbies" name="hobbies" placeholder="Cricket, Football...">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<?= $this->endSection() ?>