<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('/welcome') ?>">
            <i class="fas fa-motorcycle me-2"></i>Sistema Motos
        </a>
        
        <div class="navbar-nav ms-auto">
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                    <img src="<?= base_url('images/user/' . $usuario['avatar']) ?>" 
                         class="rounded-circle me-2" width="32" height="32" 
                         alt="Avatar">
                    <?= $usuario['nombres'] ?>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?= base_url('/perfil') ?>">
                        <i class="fas fa-id-card me-2"></i>Mi Perfil
                    </a></li>
                    <li><a class="dropdown-item" href="<?= base_url('/perfil/editar') ?>">
                        <i class="fas fa-edit me-2"></i>Editar Perfil
                    </a></li>
                    <li><a class="dropdown-item" href="<?= base_url('/usuario') ?>">
                        <i class="fas fa-users me-2"></i>Gestionar Usuarios
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="<?= base_url('/logout') ?>">
                        <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                    </a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <!-- Mensajes de éxito/error -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Mi Perfil</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="<?= base_url('images/user/' . $usuario['avatar']) ?>" 
                             class="rounded-circle" width="150" height="150" 
                             alt="Avatar">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nombres:</strong><br><?= $usuario['nombres'] ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Apellidos:</strong><br><?= $usuario['apellidos'] ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Usuario:</strong><br><?= $usuario['nomusuario'] ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Nivel de Acceso:</strong><br>
                                <span class="badge bg-<?= $usuario['nivelacceso'] == 'ADMIN' ? 'success' : 'info' ?>">
                                    <?= $usuario['nivelacceso'] ?>
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="<?= base_url('/perfil/editar') ?>" class="btn btn-warning me-2">
                            <i class="fas fa-edit me-2"></i>Editar Perfil
                        </a>
                        <a href="<?= base_url('/welcome') ?>" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i>Volver al Inicio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>