<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Department_model;
use App\Models\Designation_model;

$department_model = new Department_model();
$designation_model = new Designation_model();
?>
<style>
    .nav-tabs-wrapper {
        overflow-x: auto;
        /* Enables horizontal scrolling */
        white-space: nowrap;
        /* Prevents wrapping to multiple lines */
        -webkit-overflow-scrolling: touch;
        /* Smooth scrolling on mobile */
        border-bottom: 1px solid #ddd;
        /* Optional border */
    }

    .nav-tabs {
        display: flex;
        flex-wrap: nowrap;
        /* Prevents wrapping */
    }

    .nav-item {
        flex-shrink: 0;
        /* Prevents items from shrinking */
    }

    /* Optional: Hide scrollbar in Webkit browsers */
    .nav-tabs-wrapper::-webkit-scrollbar {
        display: none;
    }

    /* .emp-info{
        display: flex;
        justify-content: space-between;
        padding: 10px;
        width: 100%;
    }
    .emp-info p:first-child{
        font-weight: bold;
        width: 20%;
    }
    .emp-info p:nth-child(2){
        font-weight: bold;
        width: 20%;
    }
    .emp-info p:last-child{
        font-weight: 400;
        width: 60%;
    } */

    .emp-info {
        display: flex;
        flex-wrap: wrap;
        /* Allow wrapping for mobile */
        align-items: center;
        gap: 5px;
        /* Space between elements */
        padding: 10px;
        width: 100%;
    }

    /* Desktop and Tablet View (≥768px) */
    @media (min-width: 768px) {
        .emp-info p {
            margin: 0;
        }

        .emp-info p:first-child {
            font-weight: bold;
            width: 20%;
        }

        .emp-info p:nth-child(2) {
            font-weight: bold;
            width: 5%;
        }

        .emp-info p:last-child {
            font-weight: 400;
            width: 75%;
        }
    }

    /* Mobile View (≤767px) */
    @media (max-width: 767px) {
        .emp-info {
            flex-direction: column;
            /* Stack elements */
            align-items: flex-start;
            /* Align text to left */
        }

        .emp-info p:first-child,
        .emp-info p:nth-child(2) {
            display: inline;
            /* Keep "Joining Date :" in the same line */
            font-weight: bold;
        }

        .emp-info p:nth-child(2) {
            margin-right: 5px;
            /* Add some space between ":" and date */
        }

        .emp-info p:last-child {
            display: block;
            /* Move date to the next line */
            width: 100%;
            margin-left: 10px;
            /* Indent the date slightly */
            margin-top: 3px;
            /* Space between "Joining Date :" and date */
        }
    }
</style>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs nav-justified mb-3">
                        <li class="nav-item">
                            <a href="#profile1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                <i class="mdi mdi-account-circle d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Profile</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#home1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-home-variant d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Experience</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#projects" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Projects</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#publications" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Publications</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#awards" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Awards</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#booksChapter" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Books Chapter</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#patents" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Patents</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#academicDetail" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Academic Details</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#otherAcademic" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Other Academic Details</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#phdDetail" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">PHD Detail</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#mphil" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">MPhil/PG/UG</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#ongoingPHD" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Ongoing PHD</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#courseTought" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Course Taught</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#membership" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Membership/Fellowship</span>
                            </a>
                        </li>
                    </ul>
                </div>


                <div class="tab-content mt-3">
                    <div class="tab-pane show active" id="profile1">
                        <div class="row">
                            <div class="col-md-4 border-right">
                                <div class="text-center">
                                    <?php if (!empty($employee_details['profile_photo']) && file_exists('public/admin/uploads/employee/' . $employee_details['profile_photo'])): ?>
                                        <center><img src="<?= base_url() ?>public/admin/uploads/employee/<?= $employee_details['profile_photo'] ?>" alt="" class="d-flex align-self-center avatar-lg rounded mr-3 border p-1" height="110px"></center>
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>public/admin/uploads/employee/invalid_image.png" alt="" height="40px">
                                    <?php endif; ?>
                                    <h4 class="mb-0 mt-1"><?= $employee_details['sir_name'] . " " . $employee_details['first_name'] . " " . $employee_details['middle_name'] . " " . $employee_details['last_name'] ?></h4>
                                    <p class="text-muted m-0">Emp. ID : <?= $employee_details['employee_unique_id'] ?></p>
                                    <p class="text-primary my-1"><?php $designations = $designation_model->get($employee_details['designation_id']);
                                                                    echo (!empty($designations['name'])) ? $designations['name'] : '____';  ?></p>
                                    <a href="<?= base_url() ?>public/admin/uploads/employee/<?= $employee_details['resume_file'] ?>" class="btn btn-outline-success btn-rounded waves-effect waves-light"><i class="mdi mdi-cloud-download-outline"></i> Download Resume</a>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="emp-info">
                                    <div>
                                        <p class="text-bold">Joining Date</p>
                                        <p>:</p>
                                    </div>
                                    <p><?= $employee_details['joining_date'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="home1">
                        <p>Leggings occaecat dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                        <p class="mb-0">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                    </div>
                    <div class="tab-pane" id="settings1">
                        <p>Food truck quinoa dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                        <p class="mb-0">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                    </div>
                </div>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>

<?= $this->endSection() ?>