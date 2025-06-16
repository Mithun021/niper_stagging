<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Classified_mou_value_model;
use App\Models\Collaboration_faculties_model;
use App\Models\Employee_model;

$employee_model = new Employee_model();
$classified_mou_value_model = new Classified_mou_value_model();
$collaboration_faculties_model = new Collaboration_faculties_model()
?>

<!-- Page title and form layout -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title; ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/edit-collaboration/<?= $collab_id ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="Collabtitle">Collaboration Title:<span class="text-danger">*</span></span>
                                <input type="text" name="Collabtitle" id="Collabtitle" class="form-control form-control-sm" value="<?= $collaboration_data['title'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="Collabinstitutename">Institution Name:<span class="text-danger">*</span></span>
                                <input type="text" name="Collabinstitutename" id="Collabinstitutename" class="form-control form-control-sm" value="<?= $collaboration_data['title'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <span for="Mediatitle">Description:</span>
                                <textarea id="editor" name="description"><?= $collaboration_data['description'] ?></textarea>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <span for="Collaborationdatetime">Collaboration Start Date:<span class="text-danger">*</span></span>
                                <input type="date" name="Collaborationdate" id="Collaborationdate" class="form-control form-control-sm" value="<?= $collaboration_data['collaboration_date'] ?>" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <span for="Collaborationdatetime">Collaboration End Date:</span>
                                <input type="date" name="Collaborationenddate" id="Collaborationenddate" class="form-control form-control-sm" value="<?= $collaboration_data['collaboration_end_date'] ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="Collabinstitutelogo">Institution Logo(PNG,JPG,JPEG):<span class="text-danger">*</span></span>
                                <input type="file" name="institutelogo" id="institutelogo" class="form-control form-control-sm" accept=".png,.jpg,.jpeg">
                                 <?php if (!empty($collaboration_data['institute_logo']) && file_exists('public/admin/uploads/collaboration/' . $collaboration_data['institute_logo'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/collaboration/<?= $collaboration_data['institute_logo'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/collaboration/<?= $collaboration_data['institute_logo'] ?>" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/collaboration/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="Collabinstituelink">Institution Link:</span>
                                <input type="url" name="Collabinstituelink" id="Collabinstituelink" class="form-control form-control-sm" collaboration_data="<?= $collaboration_data['institute_link'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="Collabfileupload">Collaboration File Upload(PDF):</span>
                                <input type="file" name="Collabfile" id="Collabfile" class="form-control form-control-sm" accept=".pdf">
                                <?php if (!empty($collaboration_data['collaboration_file']) && file_exists('public/admin/uploads/collaboration/' . $collaboration_data['collaboration_file'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/collaboration/<?= $collaboration_data['collaboration_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/collaboration/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered"> 
                                    <thead class="bg-light">
                                        <tr>
                                            <td scope="col">Faculty Coordinator</td>
                                            <td scope="col"><button type="button" class="btn btn-sm btn-primary" onclick="openFacultyModal()">+</button></td>
                                        </tr>
                            
                                    </thead>
                                    <tbody >
                                    <?php foreach ($collaboration_faculty as $key => $faculty) { ?>
                                        <tr >
                                            <td>
                                                <?= $faculty['faculty_name'] ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger" onclick="deleteCollabFaculty(<?= $collab_id ?>)">-</button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <span for="Collabfileupload">Collaboration Gallery(JPG,PNG):</span>
                                <input type="file" name="collab_gallery[]" id="collab_gallery" class="form-control form-control-sm" accept=".jpg,.png,.jpeg" multiple>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <span for="Collabenddatetime">Classification of MoU:</span>
                                <select name="classified_mou" id="classified_mou" class="form-control form-control-sm">
                                    <option value="">--Select--</option>
                                <?php foreach ($classified_mou as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>" <?php if($collaboration_data['classified_mou'] ==  $value['id']){ echo "selected"; } ?>><?= $value['name'] ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <span for="Collabenddatetime">Collaboration tenure year:<span class="text-danger">*</span></span>
                                <input type="number" name="Collabtenure" id="Collabtenure" class="form-control form-control-sm" required>
                            </div>
                        </div> -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <span for="Collabstatus">Collaboration Status:</span>
                                <select name="Collabstatus" id="Collabstatus" class="form-control form-control-sm" required>
                                    <option value="active" <?php if($collaboration_data['status'] == "active"){ echo "selected"; } ?>>Active</option>
                                    <option value="expired" <?php if($collaboration_data['status'] == "expired"){ echo "selected"; } ?>>Expired</option>
                                    <option value="renewed" <?php if($collaboration_data['status'] == "renewed"){ echo "selected"; } ?>>Renewed</option>
                                </select>
                            </div>
                        </div>

                        <!-- Renewal Date field, initially hidden -->
                        <div class="col-md-6" id="renewalDateField" style="display: none;">
                            <div class="form-group">
                                <span for="RenewalDate">Renewal Date:</span>
                                <input type="date" name="RenewalDate" id="RenewalDate" class="form-control form-control-sm" value="<?= $collaboration_data['renewal_date'] ?>">
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title; ?> List</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Title</td>
                                <td>Institute</td>
                                <td>Collaboration Date</td>
                                <td>Coll. Faculty</td>
                                <td>Class. MoU</td>
                                <td>Status</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($collaboration as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?php if (!empty($value['institute_logo']) && file_exists('public/admin/uploads/collaboration/' . $value['institute_logo'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/collaboration/<?= $value['institute_logo'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/collaboration/<?= $value['institute_logo'] ?>" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/collaboration/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>

                                        <?php if (!empty($value['collaboration_file']) && file_exists('public/admin/uploads/collaboration/' . $value['collaboration_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/collaboration/<?= $value['collaboration_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/collaboration/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $value['title'] ?></td>
                                    <td><a href="<?= $value['institute_link'] ?>" target="_blank"><?= $value['institute_name'] ?></a></td>
                                    <td><?= $value['collaboration_date'] ?></td>
                                    <td><?php $faculty = $collaboration_faculties_model->getByColId($value['id']); if ($faculty) {
                                        foreach ($faculty as $key => $value2) {
                                            echo '<i class="fa fa-angle-right"></i> '.$value2['faculty_name']."<br>";
                                        }
                                    } ?></td>
                                    <td><?= $classified_mou_value_model->get($value['classified_mou'])['name'] ?? '' ?></td>
                                    <td><?= $value['status'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <a href="<?= base_url() ?>admin/edit-collaboration/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-collaboration/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure...!')"><i class="far fa-trash-alt"></i></a>
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


<div class="modal fade" id="addFacultyModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new Faculty</h5>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url() ?>admin/add-collab-faculty/<?= $collab_id ?>" method="post">
            <div class="modal-body">
                <span>Faculty Name <span class="text-danger">*</span></span>
                <input type="text" class="form-control form-control-sm" name="collab_faculty_name" required>
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

    function openFacultyModal(){
        $('#addFacultyModal').modal('show');
    }

    function deleteCollabFaculty(collab_id) { 
        if(confirm('Are you sure...!')){
            $.ajax({
                type: "GET",
                url: "<?= base_url('admin/deleteCollabFaculty/') ?>" + collab_id,
                success : function(response){
                    if(response == 'success'){
                        alert('Collaboration Faculty deleted successfully');
                        window.location.reload();
                    }else{
                        alert('Error deleting collaboration faculty');
                    }
                }
            });
        }
     }

    function toggleRenewalDateField() {
        var collabStatus = document.getElementById('Collabstatus');
        var renewalDateField = document.getElementById('renewalDateField');

        if (collabStatus.value === 'renewed') {
            renewalDateField.style.display = 'block'; // Show
        } else {
            renewalDateField.style.display = 'none'; // Hide
        }
    }

    // Call on load
    window.onload = toggleRenewalDateField;

    // Call on dropdown change
    document.getElementById('Collabstatus').addEventListener('change', toggleRenewalDateField);
</script>

<?= $this->endSection() ?>