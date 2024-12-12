<!-- app/Views/emppublicationdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php
    use App\Models\Employee_model;
    $employee_model = new Employee_model();
?>

<style>
    #clone_content #clone_employee_data:first-child button#remove-clone {
        display: none;
    }
</style>

<div class="row">
    
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Add Publication Details</h4>
                <div>
                    <button type="button" class="btn btn-sm btn-danger">Export Sample</button>
                    <button class="btn btn-sm btn-primary" id="upload_emp_exp_btn">Import</button>
                </div>
            </div>
            <!-- Form Start -->
            <form action="<?= base_url() ?>admin/employee-publication" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <?php if (session()->getFlashdata('msg')): ?>
                        <?= session()->getFlashdata('msg') ?>
                    <?php endif; ?>
                    <div class="card card-body mb-1">
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                <span for="Empid">Employee:</span>
                                <select name="Empid" id="Empid" class="form-control form-control-sm" required>
                                    <option value="">Select Employee</option>
                                    <?php foreach ($employee as $value) { ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="clone_content">
                        <div class="card card-body" id="clone_employee_data">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Publication Title -->
                                    <div class="form-group">
                                        <span for="Pubtitle">Publication Title:</span>
                                        <textarea name="Pubtitle" id="Pubtitle" class="form-control form-control-sm clone_editor"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <!-- Publication Description -->
                                    <div class="form-group">
                                        <span for="Pubdesc">Publication Description:</span>
                                        <textarea id="Pubdesc" name="description" class="clone_editor"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- Keywords -->
                                    <div class="form-group">
                                        <span for="Pubkeyword">Keywords:</span>
                                        <input type="text" name="Pubkeyword" id="Pubkeyword" class="form-control form-control-sm" placeholder="e.g., machine learning, AI">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- Photo Upload -->
                                    <div class="form-group">
                                        <span for="Pubphotoupload">Photo Upload:</span>
                                        <input type="file" name="Pubphotoupload" id="Pubphotoupload" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="addServicetable">
                                            <thead class="bg-light">
                                                <tr>
                                                    <td scope="col">Author Details</td>
                                                    <td scope="col">
                                                        <button type="button" class="btn btn-sm btn-primary" id="addnewservicerow">+</button>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody id="stockTbody">
                                                <tr id="stockTrow">
                                                    <td>
                                                        <input type="text" class="form-control" id="author_name" name="author_name[]" placeholder="Enter Author Name">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-danger" id="removenewServicerow">-</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- DOI Details -->
                                    <div class="form-group">
                                        <span for="DoIdetails">DOI Details:</span>
                                        <input type="text" name="DoIdetails" id="DoIdetails" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- Publication Year -->
                                    <div class="form-group">
                                        <span for="Pubyear">Publication Year:</span>
                                        <input type="number" name="Pubyear" id="Pubyear" class="form-control form-control-sm" min="1900" max="<?= date("Y") ?>" required value="<?= esc(old('Pubyear')) ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- Publication Type -->
                                    <div class="form-group">
                                        <span for="Pubtype">Publication Type:</span>
                                        <select name="Pubtype" id="Pubtype" class="form-control form-control-sm" required>
                                            <option value="">Select Type</option>
                                            <option value="Research Article">Research Article</option>
                                            <option value="Review Article">Review Article</option>
                                            <option value="Book Chapter">Book Chapter</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- Publication Status -->
                                    <div class="form-group">
                                        <span for="Pubstatus">Publication Status:</span>
                                        <select name="Pubstatus" id="Pubstatus" class="form-control form-control-sm" required>
                                            <option value="">Select Status</option>
                                            <option value="0">In Proceeding</option>
                                            <option value="1">Published</option>
                                        </select>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                            <button type="button" id="remove-clone" class="btn btn-danger" style="width: 120px;">Remove Clone</button>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <button type="button" id="add-clone" class="btn btn-success">Add Clone</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title; ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Employee</td>
                                <td>Title</td>
                                <td>Status</td>
                                <td>Type</td>
                                <td>Publication Year</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($publication as $key => $value){ ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td>
                                    <a href="<?= base_url() ?>public/admin/uploads/publication/<?= $value['publication_photo'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/folder.png" height="30px"></a>
                                </td>
                                <td><?php $emp = $employee_model->get($value['emplyee_id']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                                <td><?= $value['title'] ?></td>
                                <td>
                                <?php
                                    if ($value['status'] == 0) {
                                        echo "<span class='badge badge-warning badge-pill'>In Proceeding</span>";
                                    } elseif ($value['status'] == 1) {
                                        echo "<span class='badge badge-success badge-pill'>Published</span>";
                                    }
                                ?>
                                </td>
                                <td><?= $value['publication_type'] ?></td>
                                <td><?= $value['publication_year'] ?></td>
                                <td><?= $value['upload_by'] ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a>
                                        <a href="#" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                        <a href="#" class="btn btn-danger waves-effect waves-light"><i class="far fa-trash-alt"></i></a>
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

<div class="modal fade" tabindex="-1" role="dialog" id="upload_emp_exp_modal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Employee Experience Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
      <div class="modal-body">
        <input type="file" class="dropify" data-height="300" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Upload</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<!-- jQuery Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Add and remove service rows, with a limit on clones and input resets
        var cloneLimit = 10; // Maximum number of clones allowed
        var currentClones = 0; // Keep track of current clones

        $("#addnewservicerow").click(function (e) {
            e.preventDefault();
            if (currentClones < cloneLimit) {
                currentClones++;
                var cloneCatrow = $('#stockTrow').clone().appendTo('#stockTbody');
                $(cloneCatrow).find('input').val(''); // Clear input fields
            }
        });

        $("#addnewexpenserow").click(function (e) {
            e.preventDefault();
            var cloneExpCatrow = $('#expenseTrow').clone().appendTo('#expenseTbody');
            $(cloneExpCatrow).find('input').val(''); // Clear input fields
        });

        // Remove service row
        $('#stockTbody').on('click', '#removenewServicerow', function () {
            $(this).closest('tr').remove();
        });

        // Remove expense row
        $('#expenseTbody').on('click', '#removenewExpenserow', function () {
            $(this).closest('tr').remove();
        });

        // Add clone for employee data
        $("#add-clone").click(function (e) {
            e.preventDefault();

            var cloneCatrow = $('#clone_employee_data').first().clone();
            cloneCatrow.appendTo('#clone_content');

            // Reset inputs and initialize CKEditor for the cloned textarea
            $(cloneCatrow).find('input, textarea, select').val('');
            initializeEditors(); // Ensure CKEditor instances are initialized properly
        });

        // Remove clone
        $('#clone_content').on('click', '#remove-clone', function () {
            $(this).closest('#clone_employee_data').remove();
        });

        // Show modal for file upload
        $('#upload_emp_exp_btn').on('click', function (e) {
            e.preventDefault();
            $('#upload_emp_exp_modal').modal('show');
        });

        // Synchronize CKEditor data before form submission
        $('form').on('submit', function () {
            $('.clone_editor').each(function () {
                if (this.editorInstance) {
                    this.value = this.editorInstance.getData(); // Sync CKEditor content to textarea
                }
            });
        });

        // Initialize CKEditor for elements
        function initializeEditors() {
            document.querySelectorAll(".clone_editor").forEach((textarea) => {
                if (!textarea.dataset.ckeditorInitialized) {
                    ClassicEditor.create(textarea)
                        .then(editor => {
                            textarea.editorInstance = editor; // Save editor instance for later use
                        })
                        .catch(error => console.error(error));
                    textarea.dataset.ckeditorInitialized = true; // Mark as initialized
                }
            });
        } 

        // Initialize CKEditor for existing elements on page load
        initializeEditors(); 
    });
</script>


<?= $this->endSection() ?>