<div class="content">
    <div class="container-fluid">
        <?php
            if (isset($_SESSION['danger']))
            {
                echo throwInfo('danger', $_SESSION['danger'], true);
                unset($_SESSION['danger']);
            }
            if (isset($_SESSION['success']))
            {
                echo throwInfo('success', $_SESSION['success'], true);
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['info']))
            {
                echo throwInfo('info', $_SESSION['info'], true);
                unset($_SESSION['info']);
            }
            if (isset($_SESSION['warning']))
            {
                echo throwInfo('warning', $_SESSION['warning'], true);
                unset($_SESSION['warning']);
            }
            //hasPermissionTo('security', $user_role, 'access_grafik');
        ?>
    </div>
</div>
