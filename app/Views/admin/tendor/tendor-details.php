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
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form method="post" action="<?= base_url() ?>admin/tendor-details">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <span for="">Title<span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="tendor_title">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <span for="">Desription</span>
                                <textarea id="editor" name="tendor_description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Tender reference no</span>
                                <input type="text" class="form-control form-control-sm" name="tendor_ref_no">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Bid opening date and time<span class="text-danger">*</span></span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="bidding_date"  placeholder="Start Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    <input type="text" class="form-control form-control-sm" name="bidding_time"  placeholder="Start Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Tendor Start Date & Time<span class="text-danger">*</span></span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="tendor_start_date"  placeholder="Start Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    <input type="text" class="form-control form-control-sm" name="tendor_start_time"  placeholder="Start Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Tendor End Date & Time<span class="text-danger">*</span></span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="tendor_end_date"  placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    <input type="text" class="form-control form-control-sm" name="tendor_end_time"  placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <span>Tendor Status</span>
                                <select name="tendor_status" id="tendor_status" class="form-control form-control-sm">
                                    <option value="Close" selected>Close</option>
                                    <option value="Open">Open</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <span>Marquee Status</span>
                                <select name="marquee_status" id="marquee_status" class="form-control form-control-sm">
                                    <option value="0" selected>Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <span>Current Status</span>
                                <select name="" id="" class="form-control form-control-sm">
                                    <option value="1">Publish</option>
                                    <option value="2">Archive</option>
                                    <option value="0">Draft</option>
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
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped table-hover" id="basic-datatable">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Pubish</td>
                            <td>Title</td>
                            <td>Tendor Date & Time</td>
                            <td>Tendor Status</td>
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