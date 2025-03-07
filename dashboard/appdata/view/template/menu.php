
<div class="col-md-3 left_col" style="position: fixed;overflow: scroll; height: 100%;">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">

            <a href="/" class="site_title"><i style="font-weight: bold" class="fa fa-code"></i> <img src="/img/logo_orma.png" alt="..." width="140px"></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile" style="height: 100px">
            <div class="profile_info" style="padding: 25px 23px 10px;">
                <span><?= _("Benvenuto") ?></span>
                <h2 class="currentUsername"></h2>

            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">

                    <li><a href="/"><i class="fa fa-desktop"></i>Home</a></li>
                    <li><a href="/person/edit"><i class="fa fa-user"></i>Utenti</a></li>
                    <li><a href="/contact/edit"><i class="fa fa-user"></i>Contatti</a></li>
                    <li><a href="/node/edit"><i class="fa fa-building"></i>Nodi</a></li>
                    <li><a href="/region/edit"><i class="fa fa-calendar"></i>Regioni</a></li>
                    
                    <li><a href="/detection/edit"><i class="fa fa-star"></i>Detections</a></li>
                    <li><a href="/event/edit"><i class="fa fa-tags"></i>Eventi</a></li>
                    <li><a href="/calibrationExecutionHistory/edit"><i class="fa fa-sun-o"></i>Calibrazioni giornaliere</a></li>
                    <li><a href="/monthlyCalibration/edit"><i class="fa fa-sun-o"></i>Calibrazioni mensili</a></li>
                    <!-- <li><a href="/results/edit"><i class="fa fa-suitcase"></i>Risultati</a></li> -->

                    <li style="display:none"><a href="/logProgramFile/edit"><i class="fa fa-cogs"></i>Log di esecuzione (WIP)</a></li>

                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small" style="display: none">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>

<!-- top navigation -->
<div class="top_nav">

    <div class="nav_menu">
        <nav class="" role="navigation">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span style="margin-right: 5px" class="currentUsername"></span>
                        <span class=" fa fa-angle-down"></span> 
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="#" id="logout" onclick="logout()"><i class="fa fa-sign-out pull-right"></i> <?= _("Log Out") ?></a>
                    </ul>
                </li>
                <!--                <li role="presentation" class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle info-number" id="bundle_notifica" data-toggle="dropdown" aria-expanded="false" style="padding-top: 21px;">
                                        <i class="fa fa-envelope-o"></i>
                                        <span class="badge bg-green" id="notify-length" style="display: none">6</span>
                                    </a>
                                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                        <li id='visualizzaAppuntamentiNotifica'>
                                            <div class="text-center" >
                                                <a href="/appuntamento/list" style="color: black">
                                                    <strong>Visualizza tutti gli appuntamenti</strong>
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="text-center" >
                                                <a href="#" onclick="segnaComeLetto(0);" style="color: black">
                                                    <strong>Segna come letti</strong>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>-->

            </ul>
        </nav>
    </div>

</div>

<!-- /menu footer buttons -->
