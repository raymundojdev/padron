<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <?php
                $role = $_SESSION['perfil']; // Assuming the user role is stored in the session
                ?>

                <?php if ($role == 'Administrador'): ?>
                    <li>
                        <a href="usuarios" class="waves-effect">
                            <i class="ri-user-line"></i>
                            <span>Usuarios</span>
                        </a>
                    </li>
                    <li>
                        <a href="padron" class="waves-effect">
                            <i class="ri-user-line"></i>
                            <span>Padron</span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ($role == 'Capturista'): ?>
                    <li>

                        <a href="padron" class="waves-effect">
                            <i class="ri-profile-line"></i>
                            <span>Padron</span>
                        </a>
                    </li>
                <?php endif; ?>




            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>