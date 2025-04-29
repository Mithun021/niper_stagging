<?= $this->extend("student/stdlayouts/master") ?>
<?= $this->section("student-content"); ?>
<?php
use App\Models\Employee_model;
$employee_model = new Employee_model();

use App\Models\Student_publication_author_model;
$student_publication_author_model = new Student_publication_author_model();
?>

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
    .justify-div h6{
        color: #cf1c7e;
    }

    .resume-header img.header-profile-user {
        width: auto;
        height: 130px;
    }
    .student-personal-details{
        margin-left: 10px;
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
    th{
        font-size: 12px;
        font-weight: 500;
        color: #000;
    }
    .resume-content-box{
        margin-bottom: 10px;
    }
    .signature{
        margin-top: 60px;
    }
    .content-box{
        margin-bottom: 20px;
    }
    .normal-flex{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .normal-flex div{
        padding-right: 30px;
        font-weight: 500;

    }
    .normal-flex h6{
        width: 300px;
    }
</style>

<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card card-body p-1">
            <div class="resume-header flex-div">
                <div class="student-image">
                    <?php if (!empty($studentData['profile_image']) && file_exists('public/admin/uploads/students/' . $studentData['profile_image'])): ?>
                        <img src="<?= base_url() ?>public/admin/uploads/students/<?= $studentData['profile_image'] ?>" alt="" class="header-profile-user">
                    <?php else: ?>
                        <img class="header-profile-user" src="<?= base_url() ?>public/assets/image/avatar.png"
                        alt="Header Avatar">
                    <?php endif; ?>
                </div>
                <div class="student-personal-details">
                    <h4><?= $studentData['first_name']. " " . $studentData['middle_name']. " " . $studentData['last_name'] ?></h4>
                    <p>Email : <?= $studentData['personal_mail'] ?></p>
                    <p>Phone : <?= $studentData['phone_no'] ?></p>
                    <p>Father's Name : <?= $studentData['father_name'] ?></p>
                    <p>Address : <?= $studentData['permanent_address'] ?></p>
                    <p>LinkedIn : <a href="<?= $studentData['linkedin_id'] ?>" target="_blank" rel="noopener noreferrer"><?= $studentData['linkedin_id'] ?></a></p>
                </div>
            </div>
            <div class="resume-summery">
                <h5>Career Objective</h5>
                <p><?= $studentData['career_objective'] ?></p>
            </div>
            <?php if ($studentAcademicDetails){ ?>
            <div class="resume-summery">
                <h5>Academic Details</h5>
                <table>
                    <tr>
                        <th>Degree Type</th>
                        <th>Board/Institute Name</th>
                        <th>Subjects Studied</th>
                        <th>Marks Type</th>
                        <th>Marks Obtained</th>
                        <th>Result Declaration Date</th>
                        <th>Date of Degree</th>
                    </tr>
                <?php foreach ($studentAcademicDetails as $detail): ?>
                    <tr>
                        <td><?= $detail['degree_type'] ?></td>
                        <td><?= $detail['board_institute_name'] ?></td>
                        <td><?= $detail['subject_studied'] ?></td>
                        <td><?= $detail['marks_type'] ?></td>
                        <td><?= $detail['marks_obtained'] ?></td>
                        <td><?= date('M-Y', strtotime($detail['result_declaration_date'])) ?></td>
                        <td><?= date('M-Y', strtotime($detail['degree_date'])) ?></td>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </table>
            </div>
            <?php } ?>

            <?php if ($phdstudentData){ ?>

            <div class="resume-summery">
                <h5>PHD Details</h5>
            <?php foreach ($phdstudentData as $phd): ?>
                <div class="content-box">
                <div class="justify-div">
                    <h6><?= $phd['phd_title'] ?></h6>
                    <h6>Reg. Date : <?= $phd['registration_date'] ?></h6>
                </div>
                <div><?= $phd['description'] ?></div>
                <!-- <br> -->
                <p>Supervisor Name : <?php $emp = $employee_model->get($phd['supervisor_name']); if($emp) { echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']; }  ?></p>
                <p>Status : <?= $phd['current_status'] ?></p>
                <?php if(!empty($phd['submission_date']) && $phd['submission_date'] != '0000-00-00') {
                    echo '<p>Submission Date : '.$phd['submission_date'].'</p>';
                } ?>

                <?php if(!empty($phd['award_date']) && $phd['award_date'] != '0000-00-00') {
                    echo '<p>Award Date : '.$phd['award_date'].'</p>';
                } ?>
                <!-- SUbmit and Award date embed -->
                </div>
            <?php endforeach; ?>
            </div>
            <?php } ?>

            <?php if ($pubstudentData){ ?>
            <div class="resume-summery">
                <h5>Publication Details</h5>
            <?php foreach ($pubstudentData as $pub): ?>
                <div class="resume-content-box">
                    <div class="normal-flex">
                        <div>
                            <?= $pub['publication_title'] ?>
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
                    <p><b>Author Name : </b>
                    <?php $authors = $student_publication_author_model->getByPublication($pub['id']); ?>
                    <?php if ($authors): ?>
                        <?php foreach ($authors as $author): ?>
                            <?= $author['author_name']."," ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        No Author Found
                    <?php endif; ?>
                    </p>
                </div>
            <?php endforeach; ?>
            </div>

            <?php } ?>

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
                        <p>Father's Name : <?= $studentData['father_name'] ?></p>
                        <p>Mother's Name : <?= $studentData['mother_name'] ?></p>
                    </div>
                    <div class="justify-div50">
                        <p>Date of Birth : <?= $studentData['date_of_birth'] ?></p>
                        <p>Blood Group : <?= $studentData['blood_group'] ?></p>
                    </div>
                    <div class="justify-div50">
                        <p>Offical Email ID : <?= $studentData['official_mail'] ?></p>
                        <p>Gender : <?= $studentData['gender'] ?></p>
                    </div>
                    <div class="justify-div50">
                        <p>Permanent Address : <?= $studentData['permanent_address'] ?></p>
                        <p>Correspondence Address : <?= $studentData['correspondence_address'] ?></p>
                    </div>
                    <div class="justify-div50">
                        <p>Category : <?= $studentData['category'] ?></p>
                        <p>Religion : <?= $studentData['relegion'] ?> <?php echo $studentData['other_relegion'] ?></p>
                    </div>
                    <div class="justify-div50">
                        <p>Department : <?= $studentDataCourses['department_name'] ?? '' ?></p>
                        <p>Course : <?= $studentDataCourses['program_name'] ?? '' ?></p>
                    </div>
                    <div class="justify-div50">
                        <p>Semester : <?= $studentDataCourses['semester'] ?? '' ?></p>
                        <p>Batch : <?= ($batchName['batch_start'] ?? '') . " - " . ($batchName['batch_end'] ?? '') ?></p>
                    </div>
                    <div class="justify-div50">
                        <p>State : <?= $studentData['state'] ?></p>
                        <p>City : <?= $studentData['city'] ?></p>
                    </div>
                    <div class="justify-div50">
                        <p>Pincode : <?= $studentData['pincode'] ?></p>
                    </div>

                    <div class="signature">
                        <p>Signature:</p>
                        <?php if (!empty($studentData['signature']) && file_exists('public/admin/uploads/students/' . $studentData['signature'])){ ?>
                           <img src="<?= base_url() ?>public/admin/uploads/students/<?= $studentData['signature'] ?>" alt="" height="40px">
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>