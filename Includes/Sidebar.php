<?php
session_start();

$cargo = isset($_SESSION['cargo']) ? $_SESSION['cargo'] : null;
?>

<div class="sidebar sidebar-style-2">           
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="../assets/img/mujer.png" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            <?php echo ucfirst($_SESSION['nombre']); ?>
                            <span class="user-level">
                                <?php
                                // Mostrar el cargo en texto
                                switch ($cargo) {
                                    case 1: echo "Administrador"; break;
                                    case 3: echo "Secretaria"; break;
                                    case 4: echo "Médico"; break;
                                    default: echo "Invitado"; break;
                                }
                                ?>
                            </span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <?php
                if ($cargo == 1) {
                    ?>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#base">
                            <i class="fas fa-layer-group"></i>
                            <p>Citas</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="base">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../folder/appointment.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#sidebarLayouts">
                            <i class="fas fa-male"></i>
                            <p>Pacientes</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="sidebarLayouts">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../folder/customers.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#forms">
                            <i class="fas fa-user-md"></i>
                            <p>Médicos</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="forms">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../folder/doctor.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#tables">
                            <i class="fas fa-table"></i>
                            <p>Áreas médicas</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="tables">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="specialty.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#user">
                            <i class="fas fa-user"></i>
                            <p>Usuarios</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="user">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="usuarios.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#pagos">
                            <i class="fas fa-money-bill-wave"></i>
                            <p>Pagos</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="pagos">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../view/pagos/mostrar.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#auditoria">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Auditoría</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="auditoria">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../view/audit/mostrar.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#backup">
                            <i class="fas fa-download"></i>
                            <p>Respaldo</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="backup">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../view/backup/mostrar.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <?php
                } elseif ($cargo == 3) {
                    ?>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#base">
                            <i class="fas fa-layer-group"></i>
                            <p>Citas</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="base">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../folder/appointment.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#pagos">
                            <i class="fas fa-money-bill-wave"></i>
                            <p>Pagos</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="pagos">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../view/pagos/mostrar.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <?php
                } elseif ($cargo == 4) {
                    ?>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#base">
                            <i class="fas fa-layer-group"></i>
                            <p>Citas</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="base">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../folder/appointment.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#sidebarLayouts">
                            <i class="fas fa-male"></i>
                            <p>Pacientes</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="sidebarLayouts">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../folder/customers.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="nav-item">
                        <p>No tienes permisos para ver el contenido.</p>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>

    </div>
</div>
