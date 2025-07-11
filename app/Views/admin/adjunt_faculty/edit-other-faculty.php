<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php
use App\Models\Adjunt_faculty_webpage_model;
use App\Models\Employee_model;
$employee_model = new Employee_model();
$adjunt_faculty_webpage_model = new Adjunt_faculty_webpage_model();
?>

<style>
    /* Add your custom styles here if needed */
</style>

<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                } ?>
                <form method="post" action="<?= base_url('admin/edit-other-faculty/'.$faculty_id) ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <span>First Name<span class="text-danger">*</span></span>
                            <div class="input-group">
                                <select class="form-control form-control-sm" name="annotation" required>
                                    <option value="Mr." <?php if($adjunt_other_faculty_data['annotation'] == "Mr."){ echo "selected"; } ?>>Mr.</option>
                                    <option value="Mrs." <?php if($adjunt_other_faculty_data['annotation'] == "Mrs."){ echo "selected"; } ?>>Mrs.</option>
                                    <option value="Prof." <?php if($adjunt_other_faculty_data['annotation'] == "Prof."){ echo "selected"; } ?>>Prof.</option>
                                    <option value="Dr." <?php if($adjunt_other_faculty_data['annotation'] == "Dr."){ echo "selected"; } ?>>Dr.</option>
                                </select>
                                <input type="text" class="form-control form-control-sm" name="first_name" value="<?= $adjunt_other_faculty_data['first_name'] ?>" required>
                            </div>

                        </div>
                        <div class="form-group col-md-4">
                            <span>Middle Name</span>
                            <input type="text" class="form-control form-control-sm" name="middle_name" value="<?= $adjunt_other_faculty_data['middle_name'] ?>" >
                        </div>
                        <div class="form-group col-md-4">
                            <span>Last Name<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="last_name" value="<?= $adjunt_other_faculty_data['last_name'] ?>"  required>
                        </div>
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered"> 
                                    <thead class="bg-light">
                                        <tr>
                                            <td scope="col">Designation</td>
                                            <td scope="col">Organisation</td>
                                            <td scope="col">Organisation Address</td>
                                            <td scope="col"><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">+</button></td>
                                        </tr>
                            
                                    </thead>
                                    <tbody>
                                    <?php if (!empty($adjunt_other_faculty_designation_data)) { ?>
                                        <?php foreach ($adjunt_other_faculty_designation_data as $key => $destination_data) { ?>
                                            <tr>
                                                <td><?= $destination_data['designation'] ?></td>
                                                <td><?= $destination_data['organisation_name'] ?></td>
                                                <td><?= $destination_data['organisation_address'] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteOtherFacultyDestination(<?= $destination_data['id'] ?>)">-</button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <span>Personal Email</span>
                            <input type="email" class="form-control form-control-sm" name="personal_email" value="<?= $adjunt_other_faculty_data['personal_email'] ?>" >
                        </div>
                        <div class="form-group col-md-4">
                            <span>Official Email</span>
                            <input type="email" class="form-control form-control-sm" name="official_email" value="<?= $adjunt_other_faculty_data['official_email'] ?>" >
                        </div>
                        <div class="form-group col-md-4">
                            <span>Mobile</span>
                            <input type="tel" class="form-control form-control-sm" name="mobile" value="<?= $adjunt_other_faculty_data['mobile'] ?>" >
                        </div>
                        <div class="form-group col-md-4">
                            <span>LinkedIn</span>
                            <input type="url" class="form-control form-control-sm" name="linkedin" value="<?= $adjunt_other_faculty_data['linkedin'] ?>" >
                        </div>
                        <div class="form-group col-md-4">
                            <span>Twitter</span>
                            <input type="url" class="form-control form-control-sm" name="twitter" value="<?= $adjunt_other_faculty_data['twitter'] ?>" >
                        </div>
                        <div class="form-group col-md-4">
                            <span>Facebook</span>
                            <input type="url" class="form-control form-control-sm" name="facebook" value="<?= $adjunt_other_faculty_data['facebook'] ?>" >
                        </div>
                        <div class="form-group col-md-12">
                            <span>Research Interest</span>
                            <textarea class="form-control form-control-sm" name="research_interest" id="editor"><?= $adjunt_other_faculty_data['research_interest'] ?></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <span>Description</span>
                            <textarea class="form-control form-control-sm" name="description" id="editor2"><?= $adjunt_other_faculty_data['description'] ?></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Photo Upload</span>
                            <input type="file" class="form-control form-control-sm" name="photo">
                            <?php if (!empty($adjunt_other_faculty_data['photo']) && file_exists('public/admin/uploads/adjunt_faculty/' . $adjunt_other_faculty_data['photo'])): ?>
                                <a href="<?= base_url() ?>public/admin/uploads/adjunt_faculty/<?= $adjunt_other_faculty_data['photo'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/adjunt_faculty/<?= $adjunt_other_faculty_data['photo'] ?>" alt="" height="30px"></a>
                            <?php else: ?>
                                <img src="<?= base_url() ?>public/admin/uploads/adjunt_faculty/invalid_image.png" alt="" height="40px">
                            <?php endif; ?>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Resume File Upload</span>
                            <input type="file" class="form-control form-control-sm" name="resume">
                            <?php if (!empty($adjunt_other_faculty_data['resume']) && file_exists('public/admin/uploads/adjunt_faculty/' . $adjunt_other_faculty_data['resume'])): ?>
                                <a href="<?= base_url() ?>public/admin/uploads/adjunt_faculty/<?= $adjunt_other_faculty_data['resume'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                            <?php else: ?>
                                <img src="<?= base_url() ?>public/admin/uploads/adjunt_faculty/invalid_image.png" alt="" height="40px">
                            <?php endif; ?>
                        </div>
                        <!--<div class="form-group col-md-6">
                            <span>Faculty Type<span class="text-danger">*</span></span>
                            <select class="form-control form-control-sm" name="faculty_type" required>
                                <option value="">--Select--</option>
                                <option value="Permanent">Permanent</option>
                                <option value="Visiting">Visiting</option>
                            </select>
                        </div>-->
                      	<div class="form-group col-md-6">
                            <span>Adjunt Faculty Notification<span class="text-danger">*</span></span>
                            <select class="form-control form-control-sm" name="adjunt_faculty_webpage_id" required>
                                <option value="">--Select--</option>
                            <?php foreach ($adjunt_faculty_webpage as $key => $value) { ?>
                               <option value="<?= $value['id'] ?>" <?php if($adjunt_other_faculty_data['adjunt_faculty_webpage_id'] == $value['id']){ echo "selected"; } ?>><?= $value['section_title'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Status<span class="text-danger">*</span></span>
                            <select class="form-control form-control-sm" name="status" required>
                                <option value="1" <?php if($adjunt_other_faculty_data['status'] == 1){ echo "selected"; } ?>>Active</option>
                                <option value="0" <?php if($adjunt_other_faculty_data['status'] == 0){ echo "selected"; } ?>>Draft</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
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
                                <td>Files</td>
                      			<td>Status</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Mobile</td>
                              	<td>Faculty Webpage</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($adjunt_other_faculty as $key => $value) { ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td>
                                    <?php if (!empty($value['photo']) && file_exists('public/admin/uploads/adjunt_faculty/' . $value['photo'])): ?>
                                        <a href="<?= base_url() ?>public/admin/uploads/adjunt_faculty/<?= $value['photo'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/adjunt_faculty/<?= $value['photo'] ?>" alt="" height="30px"></a>
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>public/admin/uploads/adjunt_faculty/invalid_image.png" alt="" height="40px">
                                    <?php endif; ?>
                                    <?php if (!empty($value['resume']) && file_exists('public/admin/uploads/adjunt_faculty/' . $value['resume'])): ?>
                                        <a href="<?= base_url() ?>public/admin/uploads/adjunt_faculty/<?= $value['resume'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>public/admin/uploads/adjunt_faculty/invalid_image.png" alt="" height="40px">
                                    <?php endif; ?>
                                </td>
                              	<td><?= ($value['status'] == "0") ? "<span class='badge badge-danger badge-pill'>Inactive</span>" : (($value['status'] == "1") ? "<span class='badge badge-success badge-pill'>Active</span>" : "") ?></td>
                                <td><?= $value['annotation']." ".$value['first_name']." ".$value['middle_name']." ".$value['last_name'] ?></td>
                                
                                <td><?= $value['personal_email'] ?> <?php if($value['official_email']){ echo "<br>".$value['official_email']; }  ?></td>
                                <td><?= $value['mobile'] ?></td>
                              	<td><?= $adjunt_faculty_webpage_model->get($value['adjunt_faculty_webpage_id'])['section_title'] ?? '' ?></td>
                                <td><?php $emp = $employee_model->get($value['upload_by']); if($emp){ echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']; }  ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        <!-- <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a> -->
                                        <a href="<?= base_url('admin/edit-other-faculty/'.$value['id']) ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                        <a href="<?= base_url('admin/delete-other-faculty/'.$value['id']) ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure...!')"><i class="far fa-trash-alt"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url() ?>admin/add-new-other-faculty-organisation/<?= $faculty_id ?>" method="post">
            <div class="modal-body">
                <div class="form-group">
                    <span>Designation</span>
                    <input type="text" class="form-control form-control-sm" name="designation" required>
                </div>
                <div class="form-group">
                    <span>Organisation Name</span>
                    <input type="text" class="form-control form-control-sm" name="organisation_name" required>
                </div>
                <div class="form-group">
                    <span>Organisation Address</span>
                    <input type="text" class="form-control form-control-sm" name="organisation_address" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>
<script>
    function deleteOtherFacultyDestination(id){
        if(confirm("Are you sure you want to delete this?")){
            $.ajax({
                url: "<?= base_url('admin/delete-other-faculty-organisation/') ?>" + id,
                type: "GET",
                data: { id: id },
                success: function(response) {
                    if (response && (response.success || response === "success" || response == 1)) {
                        location.reload();
                    } else {
                        alert("Failed to delete organisation.");
                    }
                },
                error: function(xhr, status, error) {
                    alert("Failed to delete organisation.");
                }
            });
        }
    }
</script>

<?= $this->endSection() ?>