<?= $this->extend("admin/layouts/master") ?>

<?= $this->section("body-content"); ?>
<?php

use App\Models\Employee_model;
use App\Models\Question_type_model;

$employee_model = new Employee_model();
$question_type_model = new Question_type_model();
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
            <form action="<?= base_url() ?>admin/manage-questions/<?= $form_id ?>" method="post">
                <div class="card-body">
                    <?php
                    if (session()->getFlashdata('status')) {
                        echo session()->getFlashdata('status');
                    }
                    ?>

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
                        <select class="form-control form-control-sm my-select" name="question_details[]" id="question_details">
                            <!-- <option value="">--Select--</option> -->
                            <?php foreach ($question as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <br><br><br>

                    <div class="form-group multiple-choice" style="display: none;">
                        <span>Question Title</span>
                        <input type="text" class="form-control form-control-sm" name="question_title" minlength="3">
                    </div>
                    <div class="form-group multiple-choice" style="display: none;">
                        <span>Question Description</span>
                        <input type="text" class="form-control form-control-sm" name="descripition" id="editor">
                    </div>

                </div>
                <div class="card-footer py-1">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Question Details -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> Details </h4>
            </div>
            <div class="card-body">
                <?php if($manage_question){ 
                    echo '<h4>'.$form_section['name'].'</h4>';
                    echo $form_section['description'];
                    foreach ($manage_question as $key => $value) {
                        $question_ids = explode(',', $value['question_details_id']);
                        $question_type = $value['question_type'];
                        $question_data = $question_type_model->get($question_ids);
                        if (!empty($question_data)) {
                            echo '<div class="card card-body">';
                            echo $question_type;
                            foreach ($question_data as $question) {
                                echo '<h4 class="m-0">' . $question['title'] . '</h4>';
                                echo '<p>' . $question['description'] . '</p>';
                            }
                            echo '</div>';
                        }
                    }    
                ?>

                <?php }else{ ?>
                <div class="alert alert-danger">No question details found.</div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        let editorInstance; // Store CKEditor instance

        function initializeEditor() {
            if (!editorInstance) {
                ClassicEditor.create(document.querySelector('#editor'))
                    .then(editor => {
                        editorInstance = editor;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        }

        function destroyEditor() {
            if (editorInstance) {
                editorInstance.destroy()
                    .then(() => {
                        editorInstance = null; // Reset instance
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        }

        $('#question_type').on('change', function () {
            let selectedType = $(this).val();
            let multipleChoiceDiv = $('.multiple-choice');

            if (selectedType === "Checkbox" || selectedType === "Radio Button" || selectedType === "Drop Down") {
                multipleChoiceDiv.show();
                destroyEditor(); // Destroy existing instance
                initializeEditor(); // Initialize CKEditor
            } else {
                multipleChoiceDiv.hide();
                destroyEditor(); // Destroy editor when not needed
            }
        });

        // Ensure CKEditor content is passed in form submission
        $('form').on('submit', function () {
            if (editorInstance) {
                editorInstance.updateSourceElement();
            }
        });

        // Initialize CKEditor on page load (if visible)
        if ($('.multiple-choice').is(':visible')) {
            initializeEditor();
        }
    });
</script>

<?= $this->endSection() ?>