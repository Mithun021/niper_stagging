<?= $this->extend("student/stdlayouts/master") ?>
<?=  $this->section("student-content"); ?>

<style>
    p,h3,h4,h5,h6{
        margin: 0;
        padding: 0;
    }
    .flex-div{
        display: flex;
        justify-content: flex-start;
        /* align-items: center; */
    }
    .justify-div{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }<?= $this->extend("student/stdlayouts/master") ?>
<?=  $this->section("student-content"); ?>

<style>
    p,h3,h4,h5,h6{
        margin: 0;
        padding: 0;
    }
    .flex-div{
        display: flex;
        justify-content: flex-start;
        /* align-items: center; */
    }
    .justify-div{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>

<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card card-body p-1">
            <div class="resume-header flex-div">
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
            <div class="logs">
                <h4>Logs</h4>
                <ul>
                    <li>Login History</li>
                    <li>Activity Logs</li>
                    <li>System Logs</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
</style>

<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card card-body p-1">
            <div class="resume-header flex-div">
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