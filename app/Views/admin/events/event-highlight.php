<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content") ?>
<?php
    use App\Models\Employee_model;
    use App\Models\Events_model;

    $employee_model = new Employee_model();
    $events_model = new Events_model();
?>

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Event Highlights</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')) : ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <form action="<?= base_url() ?>admin/event-highlight" method="post">
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

                    <!-- Highlight Title -->
                    <div class="form-group">
                        <span for="evthightitle">Highlight Title <span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="evthightitle" id="evthightitle" placeholder="Enter Highlight Title" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary btn-sm" id="saveHighlightBtn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Event Highlights List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Event ID</td>
                                <td>Highlight Title</td>
                                <td>Upload by</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($event_highlights) : ?>
                                <?php foreach ($event_highlights as $key => $value) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $events_model->get($value['event_id'])['title'] ?></td>
                                        <td><?= $value['highlight_title'] ?></td>
                                        <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name'] ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>admin/event-fees/<?= $value['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="<?= base_url() ?>admin/event-fees/delete/<?= $value['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5" class="text-center">No data found</td>
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