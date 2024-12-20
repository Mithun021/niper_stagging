<!-- app/Views/studentdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?> 
<?= $this->section("body-content"); ?>

<div class="row">
    <!-- Form Section for Adding Student Details -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
                <div class="d-flex">
                    
                    <form action="<?= base_url() ?>admin/export_student">
                    <button type="submit" class="btn btn-sm btn-danger" id="export_sample_btn" onclick="return confirm('Are you sure...')">Export Std. Sample</button>
                    </form>
                    <button class="btn btn-sm btn-primary" id="upload_emp_exp_btn">Import</button>
                </div>
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
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Student Enrollment ID -->
                        <div class="form-group">
                            <span for="Stdenrollid">Student Enrollment ID: <span class="text-danger">*</span></span>
                            <input type="text" name="Stdenrollid" id="Stdenrollid" class="form-control form-control-sm" required>
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
                            <input type="email" name="std_official_mail" id="std_official_mail" class="form-control form-control-sm" >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Stdemailid">Student Phone No.:<span class="text-danger">*</span></span>
                            <input type="tel" name="Stdphone" id="Stdphone" class="form-control form-control-sm"  pattern="[6-9]{1}[0-9]{9}" required maxlength="10" minlength="10">
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

    <!-- Table Section to Display Existing Students (Optional) -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Enroll ID</td>
                                <td>Std Name</td>
                                <td>Email ID</td>
                                <td>Phone no.</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dynamically populated rows go here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="upload_emp_exp_modal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Student Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url() ?>admin/upload_student_csv" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="alert alert-danger">
            <p class="m-0">1. Ensure that the student is available before uploading the CSV file. Please verify student details beforehand.</p>
            <p class="m-0">2. The student's mobile number and official email ID must be available.</p>
            <p class="m-0">3. Before uploading the CSV, cross-check the student's official email address and mobile number.</p>
            <p class="m-0">4.Please upload only CSV files.</p>
        </div>
        <input type="file" name="csv_file" class="dropify" data-height="300" />
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Upload</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- jQuery Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  document.getElementById('copyCheckbox').addEventListener('change', function() {
    var permanentAddress = document.getElementById('std_permanent_address');
    var correspondenceAddress = document.getElementById('std_corrospondence_address');

    // If the checkbox is checked, copy the permanent address to the correspondence address
    if (this.checked) {
      correspondenceAddress.value = permanentAddress.value;
      correspondenceAddress.readOnly = true; // Disable the correspondence address field
    } else {
      correspondenceAddress.value = ''; // Clear the correspondence address field
      correspondenceAddress.readOnly = false; // Enable the correspondence address field
    }
  });

  $(document).ready(function () {
    // Modal Trigger (Optional Example for Context)
    $('#upload_emp_exp_btn').on('click', function (e) {
        e.preventDefault();
        $('#upload_emp_exp_modal').modal('show');
    });

  });

</script>


<?= $this->endSection() ?>