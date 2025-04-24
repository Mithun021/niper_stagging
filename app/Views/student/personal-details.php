<?= $this->extend("student/stdlayouts/master") ?>
<?= $this->section("student-content"); ?>

<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0"><?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>admin/students" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <?php if (session()->getFlashdata('status')): ?>
                        <?= session()->getFlashdata('status') ?>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Upload Profile Image <span class="text-danger">*</span></span>
                                <input type="file" class="form-control form-control-sm" name="std_profile_image" accept=".png,.jpg,.jpeg">
                                <?php if (!empty($studentData['profile_image']) && file_exists('public/admin/uploads/students/' . $studentData['profile_image'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/students/<?= $studentData['profile_image'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/students/<?= $studentData['profile_image'] ?>" alt="" height="40px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/students/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Student Enrollment ID -->
                            <div class="form-group">
                                <span for="Stdenrollid">Student Enrollment ID: <span class="text-danger">*</span></span>
                                <input type="text" name="Stdenrollid" id="Stdenrollid" class="form-control form-control-sm" value="<?= $studentData['enrollment_no'] ?>" readonly required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>First Name <span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="std_first_name" required minlength="3">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Middle Name</span>
                                <input type="text" class="form-control form-control-sm" name="std_middle_name">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Last Name</span>
                                <input type="text" class="form-control form-control-sm" name="std_last_name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Father's Name</span>
                                <input type="text" class="form-control form-control-sm" name="std_father_name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Mother's Name</span>
                                <input type="text" class="form-control form-control-sm" name="std_mother_name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Date of Birth</span>
                                <input type="date" class="form-control form-control-sm" name="std_date_of_birth" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Blood Group</span>
                                <input type="text" class="form-control form-control-sm" name="std_blood_group">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Student Email ID -->
                            <div class="form-group">
                                <span for="Stdemailid">Personal Email ID:<span class="text-danger">*</span></span>
                                <input type="email" name="std_personal_mail" id="std_personal_mail" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Student Email ID -->
                            <div class="form-group">
                                <span for="Stdemailid">Offical Email ID:<span class="text-danger">*</span></span>
                                <input type="email" name="std_official_mail" id="std_official_mail" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Stdemailid">Student Phone No.:<span class="text-danger">*</span></span>
                                <input type="tel" name="Stdphone" id="Stdphone" class="form-control form-control-sm" pattern="[6-9]{1}[0-9]{9}" required maxlength="10" minlength="10">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Stdemailid">Gender:<span class="text-danger">*</span></span>
                                <select name="gender" id="gender" class="form-control form-control-sm" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Stdemailid">Permanent Address:<span class="text-danger">*</span></span>
                                <textarea name="std_permanent_address" id="std_permanent_address" class="form-control form-control-sm" required></textarea>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="copyCheckbox" /> Check if the Correspondence Address and Permanent Address are the same.
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Stdemailid">Correspondence Address:<span class="text-danger">*</span></span>
                                <textarea name="std_corrospondence_address" id="std_corrospondence_address" class="form-control form-control-sm" required></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer py-1">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>