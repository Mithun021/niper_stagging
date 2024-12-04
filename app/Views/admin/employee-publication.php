<!-- app/Views/emppublicationdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Publication Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <div class="alert alert-success">
                        <?= esc(session()->getFlashdata('status')) ?>
                    </div>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="/emppublicationdetails/store" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Employee ID -->
                        <div class="form-group">
                            <span for="Empid">Employee:</span>
                            <select name="Empid" id="Empid" class="form-control form-control-sm" required >
                                <option value="">Select Employee</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Publication Title -->
                        <div class="form-group">
                            <span for="Pubtitle">Publication Title:</span>
                            <input type="text" name="Pubtitle" id="Pubtitle" class="form-control form-control-sm" required >
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <!-- Publication Description -->
                        <div class="form-group">
                            <span for="Pubdesc">Publication Description:</span>
                            <textarea id="editor" name="content"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Keywords -->
                        <div class="form-group">
                            <span for="Pubkeyword">Keywords:</span>
                            <input type="text" name="Pubkeyword" id="Pubkeyword" class="form-control form-control-sm" placeholder="e.g., machine learning, AI">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Photo Upload -->
                        <div class="form-group">
                            <span for="Pubphotoupload">Photo Upload:</span>
                            <input type="file" name="Pubphotoupload" id="Pubphotoupload" class="form-control form-control-sm">
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
                                            <input type="text" class="form-control" id="service_price" name="service_price[]" placeholder="Enter Author Name">
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
                         <!-- DOI Details -->
                        <div class="form-group">
                            <span for="DoIdetails">DOI Details:</span>
                            <input type="text" name="DoIdetails" id="DoIdetails" class="form-control form-control-sm" value="<?= esc(old('DoIdetails')) ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Publication Year -->
                        <div class="form-group">
                            <span for="Pubyear">Publication Year:</span>
                            <input type="number" name="Pubyear" id="Pubyear" class="form-control form-control-sm" min="1900" max="<?= date("Y") ?>" required value="<?= esc(old('Pubyear')) ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Publication Type -->
                        <div class="form-group">
                            <span for="Pubtype">Publication Type:</span>
                            <select name="Pubtype" id="Pubtype" class="form-control form-control-sm" required>
                                <option value="">Select Type</option>
                                <option value="Research Article">Research Article</option>
                                <option value="Review Article">Review Article</option>
                                <option value="Book Chapter">Book Chapter</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Publication Status -->
                        <div class="form-group">
                            <span for="Pubstatus">Publication Status:</span>
                            <select name="Pubstatus" id="Pubstatus" class="form-control form-control-sm" required>
                                <option value="">Select Status</option>
                                <option value="0">In Proceeding</option>
                                <option value="1">Published</option>
                            </select>
                        </div>
                    </div>
                </div>
                    
                <div class="col-lg-12">
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </div>
                    
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title; ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Title</td>
                                <td>Employee</td>
                                <td>Status</td>
                                <td>Type</td>
                                <td>File</td>
                                <td>Publication Year</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dynamically populate rows here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>