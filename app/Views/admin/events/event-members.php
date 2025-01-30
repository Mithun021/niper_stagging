<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<style>
</style>
<?php

use App\Models\Employee_model;
use App\Models\Events_model;

$employee_model = new Employee_model();
$events_model = new Events_model();
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title; ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status'); ?>
                <?php endif; ?>

                <form action="<?= base_url() ?>admin/event-members" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <span>Event ID:</span>
                            <select name="event_id" class="form-control form-control-sm">
                                <option value="">Select Event</option>
                                <?php foreach ($events as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <span>Member Type:</span>
                            <select name="member_type" class="form-control form-control-sm" required>
                                <?php foreach ($event_members as $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['member_type'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="addServicetable">
                                    <thead class="bg-light">
                                        <tr>
                                            <td>Members Name</td>
                                            <td>Members Designation</td>
                                            <td>Member Affiliation</td>
                                            <td><button type="button" class="btn btn-sm btn-primary" id="addnewservicerow">+</button></td>
                                        </tr>
                                    </thead>
                                    <tbody id="stockTbody">
                                        <tr id="stockTrow">
                                            <td>
                                                <div class="form-group">
                                                    <span>Member Name:</span>
                                                    <input type="text" name="member_name[]" class="form-control form-control-sm" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <span>Member Designation:</span>
                                                    <select name="member_designation" id="member_designation[]" class="form-control form-control-sm" required>
                                                        <option value="Assistant Professor">Assistant Professor</option>
                                                        <option value="Associate Professor">Associate Professor</option>
                                                        <option value="Professor">Professor</option>
                                                        <option value="Scientist">Scientist</option>
                                                        <option value="Any Other">Any Other</option>
                                                    </select>
                                                </div>
                                                <div class="form-group" id="other_designation" style="display: none;">
                                                    <span>Specify Other Designation:</span>
                                                    <input type="text" name="member_desig_other[]" class="form-control form-control-sm" value="<?= old('member_desig_other') ?>">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <span>Member Affiliation:</span>
                                                    <input type="text" name="member_affiliation[]" class="form-control form-control-sm" value="<?= old('member_affiliation') ?>" required>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger" id="removenewServicerow">-</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
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
                                <td>Event ID</td>
                                <td>Employee ID</td>
                                <td>Member Type</td>
                                <td>Member Designation</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        <tbody>
                            <?php foreach ($event_members as $key => $value) { ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?php $event = $events_model->get($value['event_id']);
                                        echo $event['title'] ?></td>
                                    <td><?= $value['member_name'] ?></td>
                                    <td><?= $value['member_type'] ?></td>
                                    <td><?= $value['member_designation'] ?>
                                        <?php if ($value['member_designation'] == "Any Other") {
                                            echo " - " . $value['other_designation'];
                                        } ?>
                                    </td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name'] ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <!-- <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a> -->
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


<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var cloneLimit = 10;
        var currentClones = 0;

        // Add new row
        $("#addnewservicerow").click(function(e) {
            e.preventDefault();
            if (currentClones < cloneLimit) {
                currentClones++;
                var cloneCatrow = $('#stockTrow').clone().appendTo('#stockTbody');
                $(cloneCatrow).find('input').val('');

                // Attach event listener to the new row's "member_designation"
                $(cloneCatrow).find('select[name="member_designation[]"]').change(function() {
                    var otherDesignationField = $(this).closest('td').find('#other_designation');
                    if (this.value === "Any Other") {
                        otherDesignationField.show();
                    } else {
                        otherDesignationField.hide();
                    }
                }).trigger('change'); // Trigger change event on page load for each row
            }
        });

        // Remove row
        $('#stockTbody').on('click', '#removenewServicerow', function() {
            $(this).closest('tr').remove();
        });

        // Handle "Specify Other Designation" for existing rows on page load
        $('#stockTbody').find('select[name="member_designation[]"]').each(function() {
            var otherDesignationField = $(this).closest('td').find('#other_designation');
            if (this.value === "Any Other") {
                otherDesignationField.show();
            } else {
                otherDesignationField.hide();
            }
        });
    });
</script>


<?= $this->endSection() ?>