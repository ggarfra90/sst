<!-- Header -->
<header class="top-head container-fluid">
    <button type="button" class="navbar-toggle pull-left" title="Opciones" onclick="ocultarMenu();">
        <span class="sr-only">Navegación</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <!-- Left navbar -->
    <nav class=" navbar-default hidden-xs" role="navigation">
        <ul class="nav navbar-nav">
        </ul>
    </nav>

    <!-- Right navbar -->
    <ul class="list-inline navbar-right top-menu top-right-menu">
        <!-- user login dropdown start-->
        <li class="dropdown text-center">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <!--GCLV: Foto del usuario-->
                <!--<img alt="" src="vistas/images/nophoto.jpg" class="img-circle profile-img thumb-sm" >-->
                <span class="username"><?php echo $_SESSION['ldap_user']; ?></span><span class="caret"></span>
            </a>
            <ul class="dropdown-menu extended pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
                <li>
                    <a href="<?php echo Configuraciones::url_base(); ?>../netafimlogin/logout.php">
                        <i class="fa fa-sign-out"></i>Cerrar sesión
                    </a>
                </li>
            </ul>
        </li>
        <!-- user login dropdown end -->       
    </ul>
    <!-- End right navbar -->

</header>
<!-- Header Ends -->