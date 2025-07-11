<!-- app/Views/rankingdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Employee_model;

$employee_model = new Employee_model();
?>

<div class="row">
    <!-- Form Section for Adding Ranking Details -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Ranking Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/edit-ranking/<?= $ranking_id ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Rank Year -->
                            <div class="form-group">
                                <span for="Rankyear">Ranking Type:</span>
                                <select name="ranking_type" id="ranking_type" class="form-control form-control-sm" required>
                                    <option value="">--Select--</option>
                                    <option value="NIRF" <?php if($ranking_data['ranking_type'] == "NIRF"){ echo "selected"; } ?>>NIRF</option>
                                    <option value="ARIIA" <?php if($ranking_data['ranking_type'] == "ARIIA"){ echo "selected"; } ?>>ARIIA</option>
                                    <option value="Any other" <?php if($ranking_data['ranking_type'] == "Any other"){ echo "selected"; } ?>>Any other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6" id="other_input_field" style="display: none;">
                            <div class="form-group">
                                <span for="Rankyear">Please specify other ranking type:</span>
                                <input type="text" id="other_ranking" name="other_ranking" class="form-control form-control-sm" value="<?= $ranking_data['other_ranking'] ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <span for="Mediatitle">Description:</span>
                                <textarea id="editor" name="description"><?= $ranking_data['description'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Rank Year -->
                            <div class="form-group">
                                <span for="Rankyear">Rank Year:</span>
                                <input type="number" name="ranking_year" id="ranking_year" class="form-control form-control-sm" value="<?= $ranking_data['ranking_year'] ?>" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Rank Source -->
                            <div class="form-group">
                                <span for="Ranksource">Ranking Category :</span>
                                <select name="ranking_category" id="ranking_category" class="form-control form-control-sm" required>
                                    <option value="" disabled selected>Select Rank Source</option>
                                    <option value="Overall" <?php if($ranking_data['ranking_category'] == "Overall"){ echo "selected"; } ?>>Overall</option>
                                    <option value="Pharmacy" <?php if($ranking_data['ranking_category'] == "Pharmacy"){ echo "selected"; } ?>>Pharmacy</option>
                                    <option value="Any other" <?php if($ranking_data['ranking_category'] == "Any other"){ echo "selected"; } ?>>Any other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6" id="other_category_field" style="display: none;">
                            <div class="form-group">
                                <span for="Rankyear">Please specify other ranking category:</span>
                                <input type="text" id="other_ranking_category" name="other_ranking_category" class="form-control form-control-sm" value="<?= $ranking_data['other_ranking_category'] ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Rank Number -->
                            <div class="form-group">
                                <span for="Ranknumber">Rank Number:</span>
                                <input type="number" name="ranking_number" id="ranking_number" class="form-control form-control-sm" value="<?= $ranking_data['ranking_number'] ?>" required min="1">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Rank File Upload -->
                            <div class="form-group">
                                <span for="Rankfileupload">Upload Rank File:(.pdf,.jpg,.png,.jpeg)</span>
                                <input type="file" name="upload_file" id="upload_file" class="form-control-file" accept=".pdf,.jpg,.png,.jpeg" required>
                                <?php if (!empty($ranking_data['upload_file']) && file_exists('public/admin/uploads/ranking/' . $ranking_data['upload_file'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/ranking/<?= $ranking_data['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/ranking/<?= $ranking_data['upload_file'] ?>" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/ranking/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!-- Data Submitted Pharmacy -->
                            <div class="form-group">
                                <span for="Datasubmittedpharmacy">Data Submitted for Pharmacy:</span>
                                <select name="datasubmittedpharmacy" id="datasubmittedpharmacy" class="form-control form-control-sm" required>
                                    <option value="Yes" <?php if($ranking_data['datasubmittedpharmacy'] == "Yes"){ echo "selected"; } ?>>Yes</option>
                                    <option value="No" <?php if($ranking_data['datasubmittedpharmacy'] == "No"){ echo "selected"; } ?>>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3" style="display: none;">
                            <!-- Data Submitted Pharmacy -->
                            <div class="form-group">
                                <span for="Datasubmittedpharmacy">File of Data Submitted for Pharmacy:</span>
                                <input type="file" name="data_submitted_file" id="data_submitted_file" class="form-control-file" accept=".pdf,.jpg,.png,.jpeg">
                                <?php if (!empty($ranking_data['pharmacy_file']) && file_exists('public/admin/uploads/ranking/' . $ranking_data['pharmacy_file'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/ranking/<?= $ranking_data['pharmacy_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/folder.png" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/ranking/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <span for="Datasubmittedoverall">Data Submitted Overall:</span>
                                <select name="datasubmittedoverall" id="datasubmittedoverall" class="form-control form-control-sm" required>
                                    <option value="Yes" <?php if($ranking_data['datasubmittedoverall'] == "Yes"){ echo "selected"; } ?>>Yes</option>
                                    <option value="No" <?php if($ranking_data['datasubmittedoverall'] == "No"){ echo "selected"; } ?>>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3" style="display: none;">
                            <div class="form-group">
                                <span for="Datasubmittedpharmacy">File of Data Submitted Overall:</span>
                                <input type="file" name="data_submitted_overall_file" id="data_submitted_overall_file" class="form-control-file" accept=".pdf,.jpg,.png,.jpeg">
                                <?php if (!empty($ranking_data['overall_file']) && file_exists('public/admin/uploads/ranking/' . $ranking_data['overall_file'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/ranking/<?= $ranking_data['overall_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/folder.png" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/ranking/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Ranking Details (Optional) -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Ranking Details List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Ranking Type</td>
                                <td>Rank Year</td>
                                <td>Ranking Category</td>
                                <td>Rank Number</td>
                                <td>Pharmacy Data Submitted</td>
                                <td>Overall Data Submitted</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ranking as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/ranking/' . $value['upload_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/ranking/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/ranking/<?= $value['upload_file'] ?>" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/ranking/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $value['ranking_type'] ?> <?php if ($value['other_ranking']) {
                                                                            echo " , " . $value['other_ranking'];
                                                                        } ?></td>
                                    <td><?= $value['ranking_year'] ?></td>
                                    <td><?= $value['ranking_category'] ?> <?php if ($value['other_ranking_category']) {
                                                                                echo " , " . $value['other_ranking_category'];
                                                                            } ?></td>
                                    <td><?= $value['ranking_number'] ?></td>
                                    <td><?= $value['datasubmittedpharmacy'] ?>
                                        <?php if($value['datasubmittedpharmacy'] == 'Yes'){ ?>
                                        <?php if (!empty($value['pharmacy_file']) && file_exists('public/admin/uploads/ranking/' . $value['pharmacy_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/ranking/<?= $value['pharmacy_file'] ?>" target="_blank">View</a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/ranking/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>
                                        <?php } ?>
                                    </td>
                                    <td><?= $value['datasubmittedoverall'] ?>
                                        <?php if($value['datasubmittedoverall'] == 'Yes'){ ?>
                                            <?php if (!empty($value['overall_file']) && file_exists('public/admin/uploads/ranking/' . $value['overall_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/ranking/<?= $value['overall_file'] ?>" target="_blank">View</a>
                                            <?php else: ?>
                                                <img src="<?= base_url() ?>public/admin/uploads/ranking/invalid_image.png" alt="" height="40px">
                                            <?php endif; ?>
                                        <?php } ?>
                                    </td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <a href="<?= base_url() ?>admin/edit-ranking/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-ranking/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure...!')"><i class="far fa-trash-alt"></i></a>
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

<script>
   function toggleOtherRankingField() {
        var rankingType = document.getElementById('ranking_type').value;
        var otherInputField = document.getElementById('other_input_field');
        if (rankingType === 'Any other') {
            otherInputField.style.display = 'block';
        } else {
            otherInputField.style.display = 'none';
        }
    }

    // Run on page load
    window.onload = function() {
        toggleOtherRankingField();
    };

    // Run on dropdown change
    document.getElementById('ranking_type').addEventListener('change', toggleOtherRankingField);



    document.addEventListener('DOMContentLoaded', function () {
        var rankingCategory = document.getElementById('ranking_category');
        var otherCatInputField = document.getElementById('other_category_field');

        function toggleOtherCategoryField() {
            if (rankingCategory.value === 'Any other') {
                otherCatInputField.style.display = 'block';
            } else {
                otherCatInputField.style.display = 'none';
            }
        }

        // Trigger on page load
        toggleOtherCategoryField();

        // Trigger on change
        rankingCategory.addEventListener('change', toggleOtherCategoryField);
    });



    document.addEventListener("DOMContentLoaded", function () {
        // Function to toggle file input visibility
        function toggleFileInput(selectId, fileInputId) {
            const selectElement = document.getElementById(selectId);
            const fileInputElement = document.getElementById(fileInputId);

            function toggleVisibility() {
                if (selectElement.value === "Yes") {
                    fileInputElement.parentElement.parentElement.style.display = "block"; // Show
                } else {
                    fileInputElement.parentElement.parentElement.style.display = "none"; // Hide
                }
            }

            // Attach change listener
            selectElement.addEventListener("change", toggleVisibility);

            // Run once on page load
            toggleVisibility();
        }

        // Initialize toggling for both selects
        toggleFileInput("datasubmittedpharmacy", "data_submitted_file");
        toggleFileInput("datasubmittedoverall", "data_submitted_overall_file");
    });
</script>

<?= $this->endSection() ?>