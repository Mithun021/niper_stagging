<!-- app/Views/membershipdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php
    use App\Models\Employee_model;
    $employee_model = new Employee_model();
?>

<div class="row">
    <!-- Form Section for Adding Membership Details -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Membership Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/membership" method="post">

                    <div class="form-group mt-3">
                        <span for="Membershiptitle"> Title:</span>
                        <input type="text" name="Membershiptitle" id="Membershiptitle" class="form-control form-control-sm" required >
                    </div>

                    <!-- Membership Description -->
                    <div class="form-group mt-3">
                        <span for="Membershipdesc"> Description:</span>
                        <textarea id="editor" name="description"></textarea>
                    </div>

                    <!-- Membership Start Date -->
                    <div class="form-group mt-3">
                        <span for="Membershipstartdate">Membership Start Date:</span>
                        <input type="date" name="Membershipstartdate" id="Membershipstartdate" class="form-control form-control-sm" required>
                    </div>

                    <!-- Membership End Date -->
                    <div class="form-group mt-3">
                        <span for="Membershipenddate">Membership End Date:</span>
                        <input type="date" name="Membershipenddate" id="Membershipenddate" class="form-control form-control-sm">
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Memberships (Optional) -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Membership List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Title</td>
                                <td>Start Date</td>
                                <td>End Date</td>
                                <td>Upload by</td>
                                <td>Create at</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($membership as $key => $value) { ?>
                            <tr>
                                <td><?= $key+1 ?></td>
                                <td><?= $value['title'] ?></td>
                                <td><?= date("d-m-Y", strtotime($value['start_date'])) ?></td>
                                <td><?= date("d-m-Y", strtotime($value['end_date'])) ?></td>
                                <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                                <td><?= $value['created_at'] ?></td>
                                <td>
                                    <a href="<?= base_url() ?>admin/membership/<?= $value['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="<?= base_url() ?>admin/membership/<?= $value['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
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

<?= $this->endSection() ?>