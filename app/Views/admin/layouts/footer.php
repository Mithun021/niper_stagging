                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <?= date('Y') ?> © NIPER Raebareli
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-right d-none d-sm-block">
                                    Design & Develop by Vocman
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Overlay-->
        <div class="menu-overlay"></div>


        <!-- jQuery  -->
        <script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>
        <script src="<?= base_url() ?>public/admin/assets/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url() ?>public/admin/assets/js/metismenu.min.js"></script>
        <script src="<?= base_url() ?>public/admin/assets/js/waves.js"></script>
        <script src="<?= base_url() ?>public/admin/assets/js/simplebar.min.js"></script>

        <!-- App js -->
        <script src="<?= base_url() ?>public/admin/assets/js/theme.js"></script>

         <!-- third party js -->
        <script src="<?= base_url() ?>public/admin/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/dataTables.bootstrap4.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/responsive.bootstrap4.min.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/buttons.html5.min.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/buttons.flash.min.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/buttons.print.min.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/dataTables.select.min.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/pdfmake.min.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/vfs_fonts.js"></script>
        <!-- third party js ends -->

        <!--dropify-->
        <script src="<?= base_url() ?>public/admin/plugins/dropify/dropify.min.js"></script>

        <!-- Init js-->
        <script src="<?= base_url() ?>public/admin/assets/pages/fileuploads-demo.js"></script>

        <!-- Datatables init -->
        <script src="<?= base_url() ?>public/admin/assets/pages/datatables-demo.js"></script>
        <script src="<?= base_url() ?>public/admin/assets/js/adminScript.js"></script>

        <!-- Jquery Validation Plugin -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
        
        
            <!-- jQuery UI Library (must be loaded after jQuery) -->
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
            <!-- jQuery UI Sortable Script -->
            <script>
                $(document).ready(function() {
                    // Make the table rows sortable for each accordion section
                    <?php for ($i = 1; $i <= count($menu_name); $i++) { ?>
                        $("#sortableTable<?= $i ?> tbody").sortable({
                            placeholder: "ui-state-highlight", // Placeholder when dragging
                            handle: "td", // Optionally set a specific handle to drag the rows
                            update: function(event, ui) {
                                // This will be triggered whenever the order of rows is changed
                                var newOrder = [];
                                
                                // Collect the new order of the rows
                                $("#sortableTable<?= $i ?> tbody tr").each(function(index) {
                                    var headingId = $(this).data('heading-id'); // Make sure you set data-heading-id in your rows
                                    newOrder.push({
                                        id: headingId,
                                        sort_order: index + 1 // Starting from 1
                                    });
                                });

                                // Send the updated order to the server via AJAX
                                $.ajax({
                                    url: "<?= base_url('admin/save_menu_heading_sort_order') ?>",
                                    type: "POST",
                                    data: {
                                        menu_id: <?= $value['id'] ?>,
                                        new_order: newOrder
                                    },
                                    success: function(response) {
                                        console.log("Table order updated!");
                                    },
                                    error: function(error) {
                                        console.error("Error updating order", error);
                                    }
                                });
                            }
                        });
                    <?php } ?>

                    // Make the nested tables inside each row also sortable
                    $(".mytable").each(function() {
                        $(this).sortable({
                            placeholder: "ui-state-highlight", // Placeholder for nested tables
                            handle: "td",  // You can make it draggable by clicking on any td
                            update: function(event, ui) {
                                var newOrder = [];

                                // Collect the new order of the rows
                                $(this).find('tr').each(function(index) {
                                    var pageId = $(this).data('page-id'); // Make sure you set data-page-id in your rows
                                    newOrder.push({
                                        id: pageId,
                                        sort_order: index + 1 // Starting from 1
                                    });
                                });

                                // Send the updated order to the server via AJAX
                                $.ajax({
                                    url: "<?= base_url('admin/save_menu_page_sort_order') ?>",
                                    type: "POST",
                                    data: {
                                        menu_id: <?= $value['id'] ?>,
                                        heading_id: $(this).closest('tr').data('heading-id'),
                                        new_order: newOrder
                                    },
                                    success: function(response) {
                                        console.log("Nested table order updated!");
                                    },
                                    error: function(error) {
                                        console.error("Error updating page order", error);
                                    }
                                });
                            }
                        });
                    });
                });

            </script>
        
        <script>
            const editors = ['#editor', '#editor2', '#editor3', '#editor4'];

            editors.forEach(selector => {
                ClassicEditor
                    .create(document.querySelector(selector))
                    .catch(error => {
                        console.error(error);
                    });
            });



            $(document).ready(function () {
                // Create Service Clone for add and remove rows also calculate price
                var cloneLimit = 10;
                var currentClones = 0;
                $("#addnewservicerow").click(function(e){
                    e.preventDefault();
                    if (currentClones < cloneLimit) {
                        currentClones++;
                        var cloneCatrow = $('#stockTrow').clone().appendTo('#stockTbody');
                        $(cloneCatrow).find('input').val('');
                    }
                    
                });
                $("#addnewexpenserow").click(function(e){
                    e.preventDefault();
                        var cloneExpCatrow = $('#expenseTrow').clone().appendTo('#expenseTbody');
                        $(cloneExpCatrow).find('input').val('');
                });

                $('#stockTbody').on('click','#removenewServicerow', function(){
                    $(this).closest('tr').remove();
                });
                $('#expenseTbody').on('click','#removenewExpenserow', function(){
                    $(this).closest('tr').remove();
                });

                // $('#assign_page_btn').on('click', function() {
                //     $('#assign_page_model').modal('show');
                // });


            });

            
        </script>

    </body>

</html>