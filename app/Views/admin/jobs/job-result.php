<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<style>
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title; ?></h4>
            </div>
            <div class="card-body">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form action="/jobresults/store" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="advid">Advertisement ID:</span>
                                <select name="advid" id="advid" class="form-control form-control-sm">
                                    <option value="">Select Advertisement</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="resultitle">Result Title:</span>
                                <input type="text" name="resultitle" id="resultitle" class="form-control form-control-sm" value="<?= old('resultitle') ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <span for="resultdesc">Result Description:</span>
                                <textarea name="resultdesc" id="editor" class="form-control form-control-sm" required><?= old('resultdesc') ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <span for="resultfile">Result File Upload:</span>
                                <input type="file" name="resultfile" id="resultfile" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <span for="resulttype">Result Type:</span>
                                <select name="resulttype" id="resulttype" class="form-control form-control-sm" required>
                                    <option value="Eligibility">Eligibility</option>
                                    <option value="Non Eligibility">Non Eligibility</option>
                                    <option value="Admit Card">Admit Card</option>
                                    <option value="Cancellation">Cancellation</option>
                                    <option value="Interview">Interview</option>
                                    <option value="Screening">Screening</option>
                                    <option value="Phase 1">Phase 1</option>
                                    <option value="Phase 2">Phase 2</option>
                                    <option value="Phase 3">Phase 3</option>
                                    <option value="Phase 4">Phase 4</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <span for="result_status">Result Status:</span>
                                <select name="result_status" id="result_status" class="form-control form-control-sm" required>
                                    <option value="Publish">Publish</option>
                                    <option value="Draft">Draft</option>
                                    <option value="Archive">Archive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
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
                            <td>Status</td>
                            <td>Result Title</td>
                            <td>Result type</td>
                            <td>Advestisment ID</td>
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
