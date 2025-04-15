<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">Menu</li>

        <li>
            <a href="<?= base_url() ?>admin/" class="waves-effect"><i class="mdi mdi-home-analytics"></i><span>Dashboard</span></a>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                    class="mdi mdi-table-merge-cells"></i><span>Tournament Details</span></a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="<?= base_url() ?>admin/add-tournament">Add Tournament</a></li>
                <li><a href="<?= base_url() ?>admin/tournament-list">Tournament List</a></li>
            </ul>
        </li>
        
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                    class="mdi mdi-table-merge-cells"></i><span>Master</span></a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="<?= base_url() ?>admin/sports-category">Sports Category</a></li>
                <li><a href="<?= base_url() ?>admin/sports-subcategory">Sports Subcategory</a></li>
                <li><a href="<?= base_url() ?>admin/league-session">League Session</a></li>
                <li><a href="<?= base_url() ?>admin/teams">Teams</a></li>
                <li><a href="<?= base_url() ?>admin/players-category">Players Category</a></li>
            </ul>
        </li>
        <li>
            <a href="<?= base_url() ?>admin/logout" class="waves-effect"><i class="mdi mdi-table-merge-cells"></i><span>Logout</span></a>
        </li>
        

        <!-- <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                    class="mdi mdi-share-variant"></i><span>Patent & Copyrights</span></a>
            <ul class="sub-menu" aria-expanded="true">
                <li><a href="javascript: void(0);" class="has-arrow">Patent</a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="javascript: void(0);">Level 2.1</a></li>
                        <li><a href="javascript: void(0);">Level 2.2</a></li>
                    </ul>
                </li>
            </ul>
        </li> -->
        

        <!-- <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                    class="mdi mdi-table-merge-cells"></i><span>Tables</span></a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="tables-basic.html">Basic Tables</a></li>
                <li><a href="tables-datatables.html">Data Tables</a></li>
            </ul>
        </li> -->

        

    </ul>
</div>