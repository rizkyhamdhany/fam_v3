<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner ">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <img height="50px" src="<?php echo base_url('metronic/img/logo.png'); ?>" alt="logo" class="logo-default" style="margin-top: 5px;">

                <div class="menu-toggler sidebar-toggler">
                    <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                </div>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN PAGE ACTIONS -->
            <!-- DOC: Remove "hide" class to enable the page header actions -->
            <div class="page-actions hidden">
                <div class="btn-group">
                    <button type="button" class="btn red-haze btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <span class="hidden-sm hidden-xs">Actions&nbsp;</span>
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <!--                        <li>
                                                    <a href="javascript:;">
                                                        <i class="icon-docs"></i> New Post </a>
                                                </li>
                        -->
                        <li>
                            <a href="<?php echo base_url('main/logout'); ?>">
                                <i class="icon-logout"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- END PAGE ACTIONS -->
            <!-- BEGIN PAGE TOP -->
            <div class="page-top">
                <!-- BEGIN HEADER SEARCH BOX -->
                <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
                <!--                    <form class="search-form" action="page_general_search_2.html" method="GET">
                                        <div class="input-group">
                                            <input type="text" class="form-control input-sm" placeholder="Search..." name="query">
                                            <span class="input-group-btn">
                                                <a href="javascript:;" class="btn submit">
                                                    <i class="icon-magnifier"></i>
                                                </a>
                                            </span>
                                        </div>
                                    </form>-->
                <!-- END HEADER SEARCH BOX -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
                            <label id="system-timer" class="" style="margin-top: 28px; font-weight:bold; "></label>

                        </li>

                        <li class="separator hide"> </li>
                        <!-- BEGIN NOTIFICATION DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="icon-bell"></i>
<!--                                <span class="badge badge-success">  </span>-->
                            </a>

                        </li>
                        <!-- END NOTIFICATION DROPDOWN -->
                        <li class="separator hide"> </li>
                        <!-- BEGIN INBOX DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-extended dropdown-inbox dropdown-dark" id="header_inbox_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="icon-envelope-open"></i>
                                <span class="badge badge-danger"> <?php echo $this->session->userdata('usergroup_desc'); ?> </span>
                            </a>

                        </li>
                        <!-- END INBOX DROPDOWN -->
                        <li class="separator hide"> </li>
                        <!-- BEGIN TODO DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-extended dropdown-tasks dropdown-dark hidden" id="header_task_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="icon-calendar"></i>
                                <span class="badge badge-primary" id="id_sessTgltrans"> <?php echo $this->session->userdata('tgl_d'); ?> </span>
                            </a>

                        </li>
                        <!-- END TODO DROPDOWN -->
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-user dropdown-dark">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <span class="username username-hide-on-mobile"> <?php echo $this->session->userdata('namaKyw'); ?> </span>
                                <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used --> 
                                <!--<img alt="" class="img-circle" src="<?php echo base_url('metronic/layouts/layout4/img/avatar9.jpg'); ?>"> </a>-->
                                <img alt="" class="img-circle" src="<?php echo $this->session->userdata('foto'); ?>"> </a>
                            <ul class="dropdown-menu dropdown-menu-default">

                                <li>
                                    <a href="<?php echo base_url('main/logout'); ?>">
                                        <i class="icon-key"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                        <!-- BEGIN QUICK SIDEBAR TOGGLER -->

                        <li class="dropdown dropdown-extended dropdown-tasks dropdown-dark " id="header_task_bar">
                            <a href="<?php echo base_url('main/logout'); ?>" class="dropdown-toggle" >
                                <i class="icon-logout"></i>

                            </a>

                        </li>
                        <!-- END QUICK SIDEBAR TOGGLER -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END PAGE TOP -->
        </div>
        <!-- END HEADER INNER -->
    </div>
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix modal_json"> </div>
    <!--    <div class="modal_json"></div>-->
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <!-- BEGIN SIDEBAR -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <div class="page-sidebar navbar-collapse collapse">
                <!-- BEGIN SIDEBAR MENU -->
                <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                    <li class="nav-item menu_root" id="menu_root_0">
                        <a href="<?php echo base_url('main/'); ?>" id="id_a_menu_0">
                            <i class="icon-home"></i>
                            <span class="title">Home</span>
                        </a>
                    </li>
                    <?php
                    $i = 2;
                    foreach ($multilevel as $data) {
                        echo '<li class="menu_root" id="menu_root_' . $data['id'] . '">';
                        echo '<a href="javascript:;"><i class="icon-folder"></i>';
                        echo '<span class="title">' . $data['nama'] . '</span>';
                        echo '<span class="arrow "></span>';
                        echo '</a>';
                        echo '<ul class="sub-menu">';
                        echo print_recursive_list($data['child']);
                        echo '</ul>';
                        echo '</li>';
                        $i++;
                    }
                    ?>
                </ul>
                <!-- END SIDEBAR MENU -->
            </div>
            <!-- END SIDEBAR -->
        </div>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <?php include "pagehead.inc.php"; ?>
                <!-- BEGIN PAGE BASE CONTENT -->
                <!-- BEGIN DASHBOARD STATS 1-->

                <div class="clearfix"></div>
                <!-- END DASHBOARD STATS 1-->

                <?php echo $contents; ?>

                <!-- END PAGE BASE CONTENT -->
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
        <!-- BEGIN QUICK SIDEBAR -->
        <a href="javascript:;" class="page-quick-sidebar-toggler">
            <i class="icon-login"></i>
        </a>
        <?php include "sidebar.inc.php"; ?>
        <!-- END QUICK SIDEBAR -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <div class="page-footer">
        <div class="page-footer-inner"> 2017 &copy; PT. Mitra Tekno Madani

        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    <!-- END FOOTER -->

</body>

<script>
    /*
     function startTime() {
     var today = new Date();
     var h = today.getHours();
     var m = today.getMinutes();
     var s = today.getSeconds();
     m = checkTime(m);
     s = checkTime(s);
     document.getElementById('system-timer').innerHTML =
     h + ":" + m + ":" + s;
     var t = setTimeout(startTime, 500);
     }
     
     */
    function checkTime(i) {
        if (i < 10) {
            i = "0" + i
        }
        ;  // add zero in front of numbers < 10
        return i;
    }
    var bulan = Array('Jan', 'Peb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nop', 'Des');
    var myVar = setInterval(function () {
        d = new Date();
        t = d.getDate() + ' ' + bulan[d.getMonth()] + ' ' + d.getFullYear() + ', ' + d.getHours() + ':' + checkTime(d.getMinutes()) + ':' + checkTime(d.getSeconds());
        $('#system-timer').html(t);
    }, 1000);
</script>