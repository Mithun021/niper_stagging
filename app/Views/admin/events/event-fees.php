<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content") ?>
<?php
    use App\Models\Employee_model;
use App\Models\Event_fee_category_model;
use App\Models\Events_model;

    $employee_model = new Employee_model();
    $events_model = new Events_model();
    $event_fee_category_model = new Event_fee_category_model();
?>

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Event Fees Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')) : ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <form action="<?= base_url() ?>admin/event-fees" method="post">
                    <!-- Event ID -->
                    <div class="form-group">
                        <span>Event ID:</span>
                        <select name="event_id" class="form-control form-control-sm">
                            <option value="">Select Event</option>
                        <?php foreach ($events as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                        <?php } ?>
                        </select>
                    </div>

                    <!-- Fee Type -->
                    <div class="form-group">
                        <span for="evtfeestype">Fee Type <span class="text-danger">*</span></span>
                        <select class="form-control form-control-sm" name="evtfeestype" id="evtfeestype" required>
                            <option value="">Select Fee Type</option>
                        <?php foreach ($events_fee as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                        <?php } ?>
                        </select>
                        <!-- <select class="form-control form-control-sm" name="evtfeestype" id="evtfeestype" required>
                            <option value="">-- Select Fee Type --</option>
                            <option value="All">All</option>
                            <option value="Research Scholar">Research Scholar</option>
                            <option value="Post Doc.">Post Doc.</option>
                            <option value="Faculty">Faculty</option>
                            <option value="Graduate">Graduate</option>
                            <option value="Postgraduate">Postgraduate</option>
                            <option value="Govt. Affiliation">Govt. Affiliation</option>
                            <option value="Private Affiliation">Private Affiliation</option>
                            <option value="Industry Professionals">Industry Professionals</option>
                        </select> -->
                    </div>
                    <div class="form-group">
                        <span for="evtfees">Event Fees Value <span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="evtfeesvalue" id="evtfeesvalue" placeholder="Enter Fees Value" required>
                    </div>
                    <!-- Event Fees -->
                    <div class="form-group">
                        <span for="evtfees">Event Fees (in INR) <span class="text-danger">*</span></span>
                        <input type="number" class="form-control form-control-sm" name="evtfees" id="evtfees" placeholder="Enter Fees Amount" min="0" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary btn-sm" id="saveFeesBtn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Event Fees List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Event ID</td>
                                <td>Fee Type</td>
                                <td>Event Fee Value</td>
                                <td>Fees</td>
                                <td>Upload by</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($event_fees) : ?>
                                <?php foreach ($event_fees as $key => $value) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $events_model->get($value['event_id'])['title'] ?></td>
                                        <td><?= $event_fee_category_model->get($value['fee_type'])['name'] ?? '' ?></td>
                                        <td><?= $value['evtfeesvalue'] ?></td>
                                        <td><?= $value['event_fees'] ?></td>
                                        <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name'] ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>admin/event-fees/<?= $value['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="<?= base_url() ?>admin/event-fees/delete/<?= $value['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6" class="text-center">No data found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>