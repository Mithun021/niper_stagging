<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<style>
</style>

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

                <form action="/eventmembers/store" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <span>Event ID:</span>
                            <select name="event_id" class="form-control form-control-sm">
                                <option value="">Select Event</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <span>Employee ID:</span>
                            <select name="emp_id" class="form-control form-control-sm">
                                <option value="">Select Employee</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <span>Member Type:</span>
                            <select name="member_type" class="form-control form-control-sm" required>
                                <option value="Chairperson">Chairperson</option>
                                <option value="Organizer">Organizer</option>
                                <option value="Coordinator">Coordinator</option>
                                <option value="Speaker">Speaker</option>
                            </select>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-4">
                            <span>Member Designation:</span>
                            <select name="member_designation" id="member_designation" class="form-control form-control-sm" required>
                                <option value="Assistant Professor">Assistant Professor</option>
                                <option value="Associate Professor">Associate Professor</option>
                                <option value="Professor">Professor</option>
                                <option value="Scientist">Scientist</option>
                                <option value="Any Other">Any Other</option>
                            </select>
                        </div>
                        <div class="col-md-4" id="other_designation" style="display: none;">
                            <span>Specify Other Designation:</span>
                            <input type="text" name="member_desig_other" class="form-control form-control-sm" value="<?= old('member_desig_other') ?>">
                        </div>
                        <div class="col-md-4">
                            <span>Member Affiliation:</span>
                            <input type="text" name="member_affiliation" class="form-control form-control-sm" value="<?= old('member_affiliation') ?>" required>
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
                                <td>Action</td>

                            </tr>

                        </thead>

                        <tbody>



                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>
<script>
    // Show/Hide "Specify Other Designation" field
    document.getElementById("member_designation").addEventListener("change", function() {
        if (this.value === "Any Other") {
            document.getElementById("other_designation").style.display = "block";
        } else {
            document.getElementById("other_designation").style.display = "none";
        }
    });
</script>

<?= $this->endSection() ?>