<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<style>
    .nav-tabs-wrapper {
        overflow-x: auto;
        /* Enables horizontal scrolling */
        white-space: nowrap;
        /* Prevents wrapping to multiple lines */
        -webkit-overflow-scrolling: touch;
        /* Smooth scrolling on mobile */
        border-bottom: 1px solid #ddd;
        /* Optional border */
    }

    .nav-tabs {
        display: flex;
        flex-wrap: nowrap;
        /* Prevents wrapping */
    }

    .nav-item {
        flex-shrink: 0;
        /* Prevents items from shrinking */
    }

    /* Optional: Hide scrollbar in Webkit browsers */
    .nav-tabs-wrapper::-webkit-scrollbar {
        display: none;
    }
</style>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs nav-justified mb-3">
                        <li class="nav-item">
                            <a href="#profile1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                <i class="mdi mdi-account-circle d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Profile</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#home1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-home-variant d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Experience</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#projects" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Projects</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#publications" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Publications</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#awards" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Awards</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#booksChapter" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Books Chapter</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#patents" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Patents</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#academicDetail" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Academic Details</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#otherAcademic" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Other Academic Details</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#phdDetail" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">PHD Detail</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#mphil" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">MPhil/PG/UG</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#ongoingPHD" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Ongoing PHD</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#courseTought" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Course Taught</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#membership" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Membership/Fellowship</span>
                            </a>
                        </li>
                    </ul>
                </div>


                <div class="tab-content mt-3">
                    <div class="tab-pane show active" id="profile1">
                        <div class="row">
                            <div class="col-md-4">
                                <div>
                                    <?php if (!empty($employee_details['profile_photo']) && file_exists('public/admin/uploads/employee/' . $employee_details['profile_photo'])): ?>
                                        <a href="<?= base_url() ?>public/admin/uploads/employee/<?= $employee_details['profile_photo'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/employee/<?= $employee_details['profile_photo'] ?>" alt="" class="d-flex align-self-center rounded mr-3 border" height="80px"></a>
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>public/admin/uploads/employee/invalid_image.png" alt="" height="40px">
                                    <?php endif; ?>
                                    <h4 class="mb-0">Mark A. McKnight</h4>
                                    <p class="text-muted">@Webdesigner</p>
                                    <button type="button" class="btn btn-primary btn-xs waves-effect waves-light">Follow</button>
                                    <button type="button" class="btn btn-danger btn-xs waves-effect waves-light">Message</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="home1">
                        <p>Leggings occaecat dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                        <p class="mb-0">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                    </div>
                    <div class="tab-pane" id="settings1">
                        <p>Food truck quinoa dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                        <p class="mb-0">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                    </div>
                </div>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>

<?= $this->endSection() ?>