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
        height: 150px;
    }
    .resume-summery{
        margin-top: 20px;
    }
    .resume-summery h5{
        margin-bottom: 10px;
        color: #00366d;
        border-bottom: 2px solid #00366d;
    }
    table{
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
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
            <div class="resume-summery">
                <h5>Career Objective</h5>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque fugiat odit eligendi, blanditiis eveniet iste quisquam nostrum ad quidem omnis ex pariatur numquam quae hic porro repellendus odio perferendis vitae!</p>
            </div>
            <div class="resume-summery">
                <h5>Academic Details</h5>
                <table>
                    <tr>
                        <td>Degree Type</td>
                        <td>Board/Institute Name</td>
                        <td>Subjects Studied</td>
                        <td>Marks Type</td>
                        <td>Marks Obtained</td>
                        <td>Result Declaration Date</td>
                        <td>Date of Degree</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>