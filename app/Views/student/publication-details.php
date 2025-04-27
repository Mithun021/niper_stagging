<?= $this->extend("student/stdlayouts/master") ?>
<?=  $this->section("student-content"); ?>

<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0"><?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>student/publication-details" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <?php if (session()->getFlashdata('status')): ?>
                        <?= session()->getFlashdata('status') ?>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Publication Title -->
                            <div class="form-group">
                                <span for="Pubtitle">Publication Title:</span>
                                <textarea name="Pubtitle" id="editor2" class="form-control form-control-sm" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <span for="Pubdesc">Publication Description:</span>
                                <textarea id="editor" name="description"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="addServicetable"> 
                                    <thead class="bg-light">
                                        <tr>
                                            <td scope="col">Author Details</td>
                                            <td scope="col"><button type="button" class="btn btn-sm btn-primary" id="addnewservicerow">+</button></td>
                                        </tr>
                            
                                    </thead>
                                    <tbody id="stockTbody">
                                        <tr id="stockTrow">
                                            <td>
                                                <input type="text" class="form-control" id="author_name" name="author_name[]" placeholder="Enter Author Name">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger" id="removenewServicerow">-</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="DoIdetails">Published Name</span>
                                <input type="text" name="published_name" id="published_name" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="DoIdetails">Volume Number</span>
                                <input type="text" name="volume_number" id="volume_number" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>