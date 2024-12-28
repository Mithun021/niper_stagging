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
    // Loop through all the tables to make each one sortable
    $("table.mytable2").each(function() {
        var collapseId = $(this).data("collapse-id");
        var menuId = $(this).data("menu-id");

        // Apply sortable to each table
        $(this).find("tbody").sortable({
            placeholder: "ui-state-highlight", // Placeholder when dragging
            handle: "td", // Optionally set a specific handle to drag the rows
            update: function(event, ui) {
                // This will be triggered whenever the order of rows is changed
                let sortedHeadings = [];
                $(this).find("tr").each(function(index) {
                    let headingId = $(this).data("heading-id");
                    sortedHeadings.push({ order: index + 1, headingId: headingId });
                });

                let headingOutput = sortedHeadings.map(function(item) {
                    return `Order: ${item.order}, Heading ID: ${item.headingId}`;
                }).join("\n");

                console.log("Sorted Headings for Collapse " + collapseId + " (Menu ID " + menuId + "):\n" + headingOutput);
            }
        });
    });

    // Make the nested tables inside each row also sortable
    $(".mytable2 table.mytable").each(function() {
        $(this).sortable({
            placeholder: "ui-state-highlight", // Placeholder for nested tables
            handle: "td",  // You can make it draggable by clicking on any td
            update: function(event, ui) {
                // This will be triggered whenever the order of rows is changed
                let sortedPages = [];
                $(this).find("tr").each(function(index) {
                    let pageId = $(this).data("page-id");

                    // Check if pageId is missing
                    if (pageId === undefined) {
                        console.log("Missing page-id for row:", $(this));
                    } else {
                        sortedPages.push({ order: index + 1, pageId: pageId });
                    }
                });

                // Output sorted pages with a formatted message
                let pageOutput = sortedPages.map(function(item) {
                    return `Order: ${item.order}, Page ID: ${item.pageId}`;
                }).join("\n");

                console.log("Sorted Pages:\n" + pageOutput);
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