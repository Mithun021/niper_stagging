<?= $this->extend("admin/layouts/master") ?>

<?=  $this->section("body-content"); ?>
<?php
    use App\Models\Employee_model;
    $employee_model = new Employee_model();
?>
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

                <!-- <div class="form-group">
                    <span>Question Title</span>
                    <input type="text" class="form-control form-control-sm" name="question_type" required minlength="3">
                </div>
                <div class="form-group">
                    <span>Question Description</span>
                    <input type="text" class="form-control form-control-sm" name="question_description" id="editor">
                </div> -->

                <div class="form-group">
                    <span>Question Type</span>
                    <select class="form-control form-control-sm" name="question_type" id="question_type">
                        <option value="">--Select--</option>
                        <option value="Short Text">Short Text</option>
                        <option value="Paragraph">Paragraph</option>
                        <option value="Checkbox">Checkbox</option>
                        <option value="Radio Button">Radio Button</option>
                        <option value="Drop Down">Drop Down</option>
                        <option value="Linear Scale">Linear Scale</option>
                        <option value="Date">Date</option>
                        <option value="Time">Time</option>
                        <option value="File Upload">File Upload</option>
                    </select>
                </div>

                <div class="form-group">
                    <span>Question Details</span>
                    <select class="form-control form-control-sm my-select" name="question_details" id="question_details">
                        <option value="">--Select--</option>
                    <?php foreach ($question as $key => $value) { ?>
                        <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                    <?php } ?>
                    </select>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const questionType = document.getElementById("question_type");
    const questionDetails = document.getElementById("question_details");

    questionType.addEventListener("change", function () {
        const selectedType = this.value;
        if (selectedType === "Checkbox" || selectedType === "Radio Button" || selectedType === "Drop Down") {
            questionDetails.setAttribute("multiple", "multiple");
        } else {
            questionDetails.removeAttribute("multiple");
        }
    });
});

</script>

<?= $this->endSection() ?>