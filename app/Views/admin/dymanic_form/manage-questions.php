<?= $this->extend("admin/layouts/master") ?>

<?= $this->section("body-content"); ?>
<?php

use App\Models\Employee_model;
use App\Models\Question_type_model;

$employee_model = new Employee_model();
$question_type_model = new Question_type_model();
?>
<style>
    #choice-question {
        display: flex;
        align-items: flex-start;
    }

    #choice-question:first-child {
        margin-top: 20px;
    }

    #choice-question div {
        padding-left: 10px;
    }

    #choice-question div p {
        margin: 0;
    }

    .question_type {
        position: absolute;
        top: -10px;
        left: -10px;
        background-color: red;
        color: #FFF;
        padding: 5px 8px;
        border-radius: 20px;
    }
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
                        <select class="form-control form-control-sm my-select" name="question_details" id="question_details">
                            <option value="">--Select--</option>
                            <?php foreach ($question as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <br><br><br>

                    <div class="form-group multiple-choice" style="display: none;">
                        <span>Select Answer Option</span>
                        <select class="form-control form-control-sm my-select" name="answer_option[]" id="answer_option" multiple>

                        </select>
                    </div>
                    <!-- <div class="form-group multiple-choice" style="display: none;">
                        <span>Question Description</span>
                        <input type="text" class="form-control form-control-sm" name="question_description">
                    </div> -->

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
                <?php if ($manage_question) {
                    echo '<h4>' . $form_section['name'] . '</h4>';
                    echo $form_section['description'];
                    foreach ($manage_question as $key => $value) {
                        $question_ids = explode(',', $value['question_details_id']);
                        $question_type = $value['question_type'];
                        $question_data = $question_type_model->get($question_ids);
                        if (!empty($question_data)) {
                            echo '<div class="card card-body">';
                            echo '<span class="question_type">' . $question_type . '</span>';
                            if ($value['title'] !== "") {
                                echo "<h5 class='m-0 text-danger'>" . $value['title'] . "</h5>";
                            }
                            if ($value['descripition'] !== "") {
                                echo $value['descripition'];
                            }
                            echo '<br>';
                            foreach ($question_data as $question) {
                                if ($value['question_type'] == "Radio Button") {
                                    echo '<div id="choice-question">';
                                    echo '<input type="radio" name="choice1" ><div>';
                                    echo '<h6 class="m-0 text-secondary">' . $question['title'] . '</h6>';
                                    echo '<p>' . $question['description'] . '</p>';
                                    echo "</div>";
                                    echo '</div>';
                                } else {
                                    echo '<h6 class="m-0 text-secondary">' . $question['title'] . '</h6>';
                                    echo '<p>' . $question['description'] . '</p>';
                                }
                            }
                            echo '</div>';
                        }
                    }
                ?>

                <?php } else { ?>
                    <div class="alert alert-danger">No question details found.</div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script>
$(document).ready(function () {
    // Initialize Select2
    $('.my-select').select2({
        placeholder: "--Select--",
        allowClear: true,
        width: '100%'
    });

    function loadAnswerOptions(questionId) {
        $.ajax({
            url: '<?= base_url('get-answer-options') ?>',
            type: 'POST',
            dataType: 'json',
            data: { question_id: questionId },
            success: function (data) {
                console.log(data);
                let options = $('#answer_option');
                options.empty();           // Clear old options
                options.attr("multiple", "multiple"); // Add 'multiple' attribute here

                data.forEach(function (item) {
                    options.append('<option value="' + item.id + '">' + item.title + '</option>');
                });
            },
            error: function (xhs,t, error) {
                console.error("Error loading answer options:", xhs, t, error);
                // alert('Failed to load options.');
            }
        });
    }

    $('#question_type').on('change', function () {
        let type = $(this).val();
        let answerDiv = $('.multiple-choice');
        $('#answer_option').removeAttr("multiple"); // Remove any previous 'multiple'

        if (type === "Checkbox" || type === "Radio Button" || type === "Drop Down") {
            answerDiv.show();

            // Optionally fetch immediately if already selected
            let selectedDetail = $('#question_details').val();
            if (selectedDetail) {
                loadAnswerOptions(selectedDetail);
            }
        } else {
            answerDiv.hide();
            $('#answer_option').empty();
        }
    });

    $('#question_details').on('change', function () {
        let type = $('#question_type').val();
        let id = $(this).val();

        if ((type === "Checkbox" || type === "Radio Button" || type === "Drop Down") && id) {
            loadAnswerOptions(id);
        }
    });
});
</script>

<?= $this->endSection() ?>