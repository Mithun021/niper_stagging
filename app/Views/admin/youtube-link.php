<?= $this->extend("admin/layouts/master") ?>

<?=  $this->section("body-content"); ?>
<style>
    
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Youtube Video </h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form method="post" action="<?= base_url() ?>admin/youtube-link">
                    <div class="form-group">
                        <span for="">Youtube Video URL<span class="text-danger">*</span></span>
                        <input type="url" class="form-control form-control-sm" name="youtube_url" required>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Youtube Video List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped table-hover" id="basic-datatable">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Video URL</td>
                            <td>Create at</td>
                            <td>Upload by</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($youtube_link as $link): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><a href="<?= $link['link_url'] ?>" target="_blank"><?= $link['link_url'] ?></a></td>
                                <td><?= date('d M Y', strtotime($link['created_at'])) ?></td>
                                <td><?= $link['upload_by'] ?></td>
                                <td>
                                    <a href="<?= base_url() ?>admin/youtube-link/<?= $link['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="<?= base_url() ?>admin/youtube-link/<?= $link['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>