<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form method="post" action="<?= base_url() ?>admin/event-extension-notice" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <span>Event ID:</span>
                                <select name="event_id" class="form-control form-control-sm">
                                    <option value="">Select Event</option>
                                    <?php foreach ($events as $key => $value) { ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Extension Status</span>
                                <input type="text" class="form-control form-control-sm" name="extension_status">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Extension Notice File(PDF)<span class="text-danger">*</span></span>
                                <input type="file" class="form-control form-control-sm" name="extension_file" accept=".pdf" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Extension End Date & Time<span class="text-danger">*</span></span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="extension_end_date" placeholder="Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    <input type="text" class="form-control form-control-sm" name="extension_end_time" placeholder="Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>