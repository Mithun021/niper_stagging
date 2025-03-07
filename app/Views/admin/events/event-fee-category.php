<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>
<?php
    use App\Models\Employee_model;
use App\Models\Events_model;

    $employee_model = new Employee_model();
    $events_model = new Events_model();
?>
<style>
    
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form method="post" action="<?= base_url('admin/event-fee-category') ?>">
                    <div class="form-group">
                        <span>Event ID:</span>
                        <select name="event_id" class="form-control form-control-sm">
                            <option value="">Select Event</option>
                            <?php foreach ($events as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                
                    <div class="form-group">
                        <span for="">Category Name<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="event_category" required>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
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
                            <td>Event Name</td>
                            <td>Category Name</td>
                            <td>Upload By</td>
                            <td>Upload Date</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($event_categories as $key => $value) { ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= $events_model->get($value['event_id'])['title'] ?? '' ?></td>
                            <td><?= $value['name'] ?></td>
                            <td><?php $emp = $employee_model->get($value['upload_by']); if($emp){ echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']; }  ?></td>
                            <td><?= date("d-m-Y", strtotime($value['created_at'])) ?></td>
                            <td>
                                <a href="<?= base_url('admin/edit-event-fee-category/'.$value['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="<?= base_url('admin/delete-event-fee-category/'.$value['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure...!')">Delete</a>
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