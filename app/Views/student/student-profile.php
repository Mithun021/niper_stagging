<?= $this->extend("student/stdlayouts/master") ?>
<?=  $this->section("student-content"); ?>

<style>
    #student-profile{
        position: relative;
        width: 100%;
    }
    p,h3,h4,h5,h6{
        margin: 0px;
        padding: 0px;
    }
    .flex-div{
        display: flex;
        justify-content: flex-start;
        /* align-items: center; */
    }
    .justify-div{
        position: relative;
        width: 100%;
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
    .justify-div.parciate_div30{
        width: 30%;
    }
</style>

<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card card-body p-1" id="student-profile">
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
            <div class="resume-summery">
                <h5>PHD Details</h5>
                <div class="justify-div">
                    <h6>This is heading of details content</h6>
                    <h6>Reg. Date : 25-Apr-2025</h6>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio quasi quaerat sequi ad consectetur! Esse assumenda quo saepe tenetur, similique voluptates maxime facere amet eos ipsa autem adipisci facilis impedit!</p>
                <p>Supervisor Name : </p>
                <p>Status : </p>
                <!-- SUbmit and Award date embed -->
            </div>
            <div class="resume-summery">
                <h5>Publication Details</h5>
                <div class="justify-div">
                    <div>
                        <h6>This is heading of details content</h6>
                    </div>
                    <h6>Punb Year : 2025</h6>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio quasi quaerat sequi ad consectetur! Esse assumenda quo saepe tenetur, similique voluptates maxime facere amet eos ipsa autem adipisci facilis impedit!</p>
                <div class="justify-div parciate_div30">
                    <p>Journal Name : </p>
                    <p>Volume Number : </p>
                    <p>Page Number</p>
                </div>
                <div class="justify-div parciate_div30">
                    <p>Publication Type : </p>
                    <p>ISSN no : </p>
                    <p>ISBN no</p>
                </div>
                <div class="justify-div parciate_div30">
                    <p>DOI Details : </p>
                    <p>Impact Factor : </p>
                </div>
                <p><b>Author Name : </b></p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>