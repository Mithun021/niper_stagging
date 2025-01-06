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

                <form action="/eventorganizers/store" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <span>Event ID:</span>
                                <select name="event_id" class="form-control form-control-sm">
                                    <option value="">Select Event</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <span>Organizer Type:</span>
                            <select name="evtorg_type" class="form-control form-control-sm" required>
                                <option value="Department">Department</option>
                                <option value="Institute">Institute</option>
                                <option value="Industry">Industry</option>
                            </select>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-12">
                            <span>Organizer Name:</span>
                            <input type="text" name="evtorg_name" class="form-control form-control-sm" value="<?= old('evtorg_name') ?>" required>
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

                <h4 class="card-title m-0">Events Orgnizer Lists</h4>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-striped table-hover" id="basic-datatable">

                        <thead>

                            <tr>

                                <td>SN</td>

                                <td>Event ID</td>

                                <td>Organizer Type</td>

                                <td>Organizer Name</td>
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

<?= $this->endSection() ?>