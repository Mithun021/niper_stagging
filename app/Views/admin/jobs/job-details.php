<?= $this->extend("admin/layouts/master") ?>

<?=  $this->section("body-content"); ?>
<style>
    
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> </h4>
            </div>
            <div class="card-body p-2">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form method="post" action="<?= base_url() ?>admin/job-details" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <span for="">Adv Title<span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="job_title" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <span for="">Adv Desription</span>
                                <textarea id="editor" name="description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Adv reference no<span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="reference_no" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Adv Apply Link<span class="text-danger">*</span></span>
                                <input type="url" class="form-control form-control-sm" name="apply_link" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span>Adv Type<span class="text-danger">*</span></span>
                                <select name="adv_type" id="adv_type" class="form-control form-control-sm" required>
                                    <option value="" selected>Select Anyone</option>
                                <?php foreach($job_category as $key => $value){ ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span>Department<span class="text-danger">*</span></span>
                                <select name="department" id="department" class="form-control form-control-sm" required>
                                    <option value="" selected>Select Anyone</option>
                                <?php foreach($department as $key => $value){ ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Application Start Date & Time<span class="text-danger">*</span></span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="application_start_date"  placeholder="Start Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    <input type="text" class="form-control form-control-sm" name="application_start_time"  placeholder="Start Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Application End Date & Time<span class="text-danger">*</span></span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="application_end_date"  placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    <input type="text" class="form-control form-control-sm" name="application_end_time"  placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Hardcopy Last Date & Time<span class="text-danger">*</span></span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="hardcopy_last_date"  placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    <input type="text" class="form-control form-control-sm" name="hardcopy_last_time"  placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Extension notice title<span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="ext_notice_title">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Extension notice file upload(JPG,PNG,PDF)<span class="text-danger">*</span></span>
                                <input type="file" class="form-control form-control-sm" name="ext_notice_file" accept=".jpg, .png, .pdf" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Revised application last datetime<span class="text-danger">*</span></span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="revised_app_last_date"  placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    <input type="text" class="form-control form-control-sm" name="revised_app_last_time"  placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Revised hardcopy last datetime<span class="text-danger">*</span></span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="revised_copy_last_date"  placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    <input type="text" class="form-control form-control-sm" name="revised_copy_last_time"  placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Payment Link<span class="text-danger">*</span></span>
                                <input type="url" class="form-control form-control-sm" name="payment_link" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Adv file upload(JPG,PNG,PDF)<span class="text-danger">*</span></span>
                                <input type="file" class="form-control form-control-sm" name="adv_file" accept=".jpg, .png, .pdf" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Syllabus file upload(JPG,PNG,PDF)<span class="text-danger">*</span></span>
                                <input type="file" class="form-control form-control-sm" name="syllabus_file" accept=".jpg, .png, .pdf" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span>Job Status<span class="text-danger">*</span></span>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="0" selected>Draft</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header p-2">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                <table class="table table-striped table-hover" id="basic-datatable">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Status</td>
                            <td>Adv Title</td>
                            <td>Adv Date & Time</td>
                            <td>Adv type</td>
                            <td>Hardcopy Last Date Time</td>
                            <td>Create at</td>
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