<?= $this->extend("student/stdlayouts/master") ?>
<?=  $this->section("student-content"); ?>

<style>
    p,h3,h4,h5{
        margin: 0px;
        padding: 0px;
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
    .resume-header img.header-profile-user{
        width: auto;
        height: 160px;
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
        </div>
    </div>
</div>

<?= $this->endSection() ?>