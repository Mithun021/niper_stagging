<?= $this->extend("admin/layouts/master") ?>

<?=  $this->section("body-content"); ?>
<style>
    
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Image Gallery </h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form id="noticeBoardForm">
                    <div class="form-group">
                        <span for="">Image Title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="notice_title">
                    </div>
                    <div class="form-group">
                        <span for="">Upload File(JPG,PNG,PDF)</span>
                        <input type="file" class="form-control form-control-sm" name="notice_file" accept=".jpg, .png, .pdf" required>
                    </div>
                    <div class="form-group">
                        <span for="">Event Date<span class="text-danger">*</span></span>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" name="news_date"  placeholder="Start Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                            <input type="text" class="form-control form-control-sm" name="news_date"  placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Image Gallery List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped table-hover" id="basic-datatable">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Title</td>
                            <td>Files</td>
                            <td>Event Date</td>
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