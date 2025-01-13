<?= $this->extend("admin/layouts/master") ?>

<?= $this->section("body-content"); ?>
<style>

</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Announcement </h4>
            </div>
            <div class="card-body p-2">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form id="noticeBoardForm">
                    <div class="form-group">
                        <span for="">Anouncement Date<span class="text-danger">*</span></span>
                        <input type="date" id="annoncement_date" name="annoncement_date" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <span for="">Title<span class="text-danger">*</span></span>
                        <textarea id="editor2" name="content"></textarea>
                    </div>
                    <div class="form-group">
                        <span for="">Upload File(JPG,PNG,PDF)</span>
                        <input type="file" class="form-control form-control-sm" name="notice_file" accept=".jpg, .png, .pdf" required>
                    </div>

                    <div class="form-group">
                        <span for="">Desription</span>
                        <textarea id="editor" name="content"></textarea>
                    </div>
                    <div class="form-group">
                        <span>Announcement Status</span>
                        <select name="status" id="Announcementstatus" class="form-control form-control-sm">
                            <option value="1">Publish</option>
                            <option value="2">Archive</option>
                            <option value="0">Draft</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <span>Marquee Status</span>
                        <select name="Marqueestatus" id="Marqueestatus" class="form-control form-control-sm">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>

                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Announcement List</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Title</td>
                                <td>Files</td>
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