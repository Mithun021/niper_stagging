<?= $this->extend("student/stdlayouts/master") ?>
<?= $this->section("student-content"); ?>

<style>
    p,
    h3,
    h4,
    h5,
    h6 {
        margin: 0px;
        padding: 0px;
    }

    .flex-div {
        display: flex;
        justify-content: flex-start;
        /* align-items: center; */
    }

    .justify-div,.justify-div50 {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .justify-div p {
        width: 30%;
        text-align: left;
    }
    .justify-div50 p {
        width: 50%;
        text-align: left;
    }

    .resume-header img.header-profile-user {
        width: auto;
        height: 150px;
    }

    .resume-summery {
        margin-top: 20px;
    }

    .resume-summery h5 {
        margin-bottom: 10px;
        color: #00366d;
        border-bottom: 2px solid #00366d;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    .resume-content-box{
        margin-bottom: 10px;
    }
    .signature{
        margin-top: 60px;
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
            <div class="resume-summery">
                <h5>PHD Details</h5>
                <div class="justify-div">
                    <h6>This is heading of details content</h6>
                    <h6>Reg. Date : 25-Apr-2025</h6>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio quasi quaerat sequi ad consectetur! Esse assumenda quo saepe tenetur, similique voluptates maxime facere amet eos ipsa autem adipisci facilis impedit!</p>
                <br>
                <p>Supervisor Name : </p>
                <p>Status : </p>
                <!-- SUbmit and Award date embed -->
            </div>

            <div class="resume-summery">
                <h5>Publication Details</h5>
                <div class="resume-content-box">
                    <div class="justify-div">
                        <div>
                            <h6>This is heading of details content</h6>
                        </div>
                        <h6>Pub Year : 2025</h6>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio quasi quaerat sequi ad consectetur! Esse assumenda quo saepe tenetur, similique voluptates maxime facere amet eos ipsa autem adipisci facilis impedit!</p>
                    <div class="justify-div">
                        <p>Journal Name : </p>
                        <p>Volume Number : </p>
                        <p>Page Number</p>
                    </div>
                    <div class="justify-div">
                        <p>Publication Type : </p>
                        <p>ISSN no : </p>
                        <p>ISBN no</p>
                    </div>
                    <div class="justify-div">
                        <p>DOI Details : </p>
                        <p>Impact Factor : </p>
                    </div>
                    <p><b>Author Name : </b></p>
                </div>
            </div>

            <div class="resume-summery">
                <h5>Book Chapter Details</h5>
                <div class="resume-content-box">
                    <div class="justify-div">
                        <div>
                            <h6>This is heading of details content</h6>
                            <span>Book Title Name</span>
                        </div>
                        <h6>Pub Year : 2025</h6>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio quasi quaerat sequi ad consectetur! Esse assumenda quo saepe tenetur, similique voluptates maxime facere amet eos ipsa autem adipisci facilis impedit!</p>
                    <div class="justify-div">
                        <p>Publisher Name : </p>
                        <p>Volume Number : </p>
                        <p>Page Number</p>
                    </div>
                    <div class="justify-div">
                        <p>ISSN no : </p>
                        <p>ISBN no</p>
                    </div>
                    <div class="justify-div">
                        <p>DOI Details : </p>
                        <p>Impact Factor : </p>
                    </div>
                    <p><b>Author Name : </b></p>
                </div>
            </div>

            <div class="resume-summery">
                <h5>Patent Details</h5>
                <div class="resume-content-box">
                    <div class="justify-div">
                        <div>
                            <h6>This is heading of details content</h6>
                        </div>
                        <h6>Filing Year : 2025</h6>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio quasi quaerat sequi ad consectetur! Esse assumenda quo saepe tenetur, similique voluptates maxime facere amet eos ipsa autem adipisci facilis impedit!</p>
                    <div class="justify-div">
                        <p>Patent Number : </p>
                        <p>Patent Status : </p>
                    </div>
                    <div class="justify-div">
                        <p>Patent Filing Date : </p>
                        <p>Patent Grant Date</p> <!-- Show only when status granted -->
                    </div>
                    <div class="justify-div">
                        <p>Patent Level : </p>
                        <p>Fund Generated : </p>
                    </div>
                    <p><b>Author Name : </b></p>
                </div>
            </div>

            <div class="resume-summery">
                <h5>Conference/Workshop Details</h5>
                <div class="resume-content-box">
                    <div class="justify-div">
                        <div>
                            <h6>This is heading of details content</h6>
                        </div>
                        <h6>Date : 25-Apr-2025</h6>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio quasi quaerat sequi ad consectetur! Esse assumenda quo saepe tenetur, similique voluptates maxime facere amet eos ipsa autem adipisci facilis impedit!</p>
                    <div class="justify-div">
                        <p>Duration of Conference/ Workshop : </p>
                        <p>Paper details : </p>
                    </div>
                </div>
            </div>

            <div class="resume-summery">
                <h5>Copyright Details</h5>
                <div class="resume-content-box">
                    <h6>This is heading of details content</h6>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio quasi quaerat sequi ad consectetur! Esse assumenda quo saepe tenetur, similique voluptates maxime facere amet eos ipsa autem adipisci facilis impedit!</p>
                    <div class="justify-div">
                        <p>Copyright Number : </p>
                        <p>Copyright Status : </p>
                    </div>
                    <div class="justify-div">
                        <p>Copyright Filing Date: </p>
                        <p>Copyright Grant Date:</p> <!-- Show only when status granted -->
                    </div>
                    <p><b>Author Name : </b></p>
                </div>
            </div>

            <div class="resume-summery">
                <h5>Achievements Details</h5>
                <div class="resume-content-box">
                    <div class="justify-div">
                        <div>
                            <h6>This is heading of details content</h6>
                        </div>
                        <h6>Date : 25-Apr-2025</h6>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio quasi quaerat sequi ad consectetur! Esse assumenda quo saepe tenetur, similique voluptates maxime facere amet eos ipsa autem adipisci facilis impedit!</p>
                    <div class="justify-div">
                        <p>Awarded Agency : </p>
                        <p>Award Level : </p>
                    </div>
                </div>
            </div>

            <div class="resume-summery">
                <h5>Experience Details</h5>
                <table>
                    <tr>
                        <td>Designation</td>
                        <td>Name of Organization</td>
                        <td>Organization Type</td>
                        <td>Date of Joining</td>
                        <td>Date of Relieving</td>
                    </tr>
                </table>
            </div>

            <div class="resume-summery">
                <h5>Additional Details</h5>
                <div class="resume-content-box">
                    <p><b>Skills : </b></p>
                    <p><b>Area of Interest : </b></p>
                    <p><b>Language : </b></p>
                    <p><b>Hobbies : </b></p>
                </div>
            </div>

            <div class="resume-summery">
                <h5>Personal Details</h5>
                <div class="resume-content-box">
                    <div class="justify-div50">
                        <p>Father's Name :</p>
                        <p>Mother's Name :</p>
                    </div>
                    <div class="justify-div50">
                        <p>Date of Birth :</p>
                        <p>Blood Group :</p>
                    </div>
                    <div class="justify-div50">
                        <p>Offical Email ID :</p>
                        <p>Gender :</p>
                    </div>
                    <div class="justify-div50">
                        <p>Permanent Address :</p>
                        <p>Correspondence Address :</p>
                    </div>
                    <div class="justify-div50">
                        <p>Category :</p>
                        <p>Religion :</p>
                    </div>
                    <div class="justify-div50">
                        <p>Department :</p>
                        <p>Course :</p>
                    </div>
                    <div class="justify-div50">
                        <p>Semester :</p>
                        <p>Batch :</p>
                    </div>
                    <div class="justify-div50">
                        <p>State :</p>
                        <p>City :</p>
                    </div>
                    <div class="justify-div50">
                        <p>Pincode :</p>
                    </div>

                    <div class="signature">
                        <p>Signature:</p>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>