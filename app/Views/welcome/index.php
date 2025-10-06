<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
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
        <!-- Sidebar de usuario -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <img src="<?= base_url('images/user/' . $usuario['avatar']) ?>" 
                         class="rounded-circle mb-3" width="100" height="100" 
                         alt="Avatar">
                    <h5><?= $usuario['nombres'] ?> <?= $usuario['apellidos'] ?></h5>
                    <span class="badge bg-<?= $usuario['nivelacceso'] == 'ADMIN' ? 'success' : 'info' ?>">
                        <?= $usuario['nivelacceso'] ?>
                    </span>
                    
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="fas fa-user me-1"></i>
                            <?= $usuario['nomusuario'] ?>
                        </small>
                    </div>

                    <!-- Botón para crear nuevo usuario -->
                    <div class="mt-3">
                        <a href="<?= base_url('/usuario/crear') ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-user-plus me-1"></i>Crear Usuario
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-motorcycle me-2"></i>Catálogo de Motos
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($motos as $moto): ?>
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <div class="bg-light rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" 
                                         style="width: 80px; height: 80px;">
                                        <i class="fas fa-motorcycle fa-2x text-secondary"></i>
                                    </div>
                                    <h6 class="card-title"><?= $moto['marca'] ?></h6>
                                    <p class="card-text small">
                                        <strong>Modelo:</strong> <?= $moto['modelo'] ?><br>
                                        <strong>Cilindrada:</strong> <?= $moto['cilindrada'] ?><br>
                                        <strong>Precio:</strong> <?= $moto['precio'] ?>
                                    </p>
                                    <p class="card-text small text-muted">
                                        <?= $moto['descripcion'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection() ?>
