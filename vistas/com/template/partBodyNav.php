<?php
include_once __DIR__ . '/../../../util/Configuraciones.php';
include_once __DIR__ . '/../../../modeloNegocio/itec/UsuarioNegocio.php';
?>
<nav class="navigation">
    <ul class="list-unstyled">
        <?php
        $usuario = UsuarioNegocio::create()->obtenerUsuarioId($_SESSION['ldap_user']);
        $_SESSION['sstUsuarioId'] = $usuario[0]['usuario_id'];
        $_SESSION['sstPerfilId'] = $usuario[0]['perfil_id'];
        
        $menuP = UsuarioNegocio::create()->listarMenuPadre($_SESSION['sstPerfilId']);
        if (ObjectUtil::isEmpty($menuP) || ObjectUtil::isEmpty($menuP[0]['id'])) {
            ?>
            <script src="<?php echo $url_libs_imagina; ?>js/jquery.js"></script>
            <script src="<?php echo $url_libs_imagina; ?>assets/notifications/notify.min.js"></script>
            <script src="<?php echo $url_libs_imagina; ?>assets/notifications/notify-metro.js"></script>
            <script src="<?php echo $url_libs_imagina; ?>assets/notifications/notifications.js"></script>
            <script type="text/javascript">
                $.Notification.autoHideNotify("error", 'top right', "Validación", "No tiene permisos para acceder al sistema");
                setTimeout(function () {
                    window.location.replace("<?php echo Configuraciones::url_base(); ?>../netafimlogin/menu.php");
                }, 1500)
            </script>
            <?php
        }
        ?>
        <li id="home" class="has-submenu">
            <a href="../netafimlogin/menu.php">
                <i class="ion-home"></i>
                <span class="nav-label">Menú principal</span>
            </a>
        </li>
        
        <?php
        foreach ($menuP as $opcionP) {
            $id_li_padre = "mp" . $opcionP['id'];
        ?>
        <li id="<?php echo $id_li_padre; ?>" class="has-submenu">
            <a href="<?php echo $opcionP['url']; ?>">
                <i class="<?php echo $opcionP['icono']; ?>"></i>
                <span class="nav-label"><?php echo $opcionP['descripcion']; ?></span>
            </a>
            <?php
            if($opcionP['ind_padre']){
                $menuH = UsuarioNegocio::create()->listarMenuHijo($_SESSION['sstPerfilId'], $opcionP['id']);
            ?>
            <ul class="list-unstyled">
                <?php
                foreach ($menuH as $opcionH) {
                    $id_li_hijo = "m" . $opcionH['id'];
                    ?>
                    <li id="<?php echo $id_li_hijo; ?>">
                        <a onclick='cargarContenido(<?php echo $opcionH['id']; ?>, "<?php echo $opcionH['url']; ?>");'>
                            <?php echo $opcionH['descripcion']; ?>
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <?php
            }
        }
        ?>
        </li>
    </ul>
</nav>