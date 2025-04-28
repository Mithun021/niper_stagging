<?= $this->extend("student/stdlayouts/master") ?>
<?=  $this->section("student-content"); ?>

<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card card-body p-1">
            <div class="resume-header">
                <div class="student-image">
                    <img class="header-profile-user" src="<?= base_url() ?>public/assets/image/avatar.png"
                alt="Header Avatar">
                </div>
                <div class="student-personal-details">
                    <h4>MITHUN KUMAR</h4>
                    <p>Email :</p>
                    <p>Phone :</p>
                    <p>Father's Name :</p>
                    <p>Address :</p>
                    <p>LinkedIn :</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>