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
                    <h4 class="mb-0">
                        <i class="fas fa-user-plus me-2"></i>Crear Nuevo Usuario
                    </h4>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('/usuario/guardar') ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nombres" class="form-label">
                                        <i class="fas fa-user me-2"></i>Nombres
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="nombres" 
                                           name="nombres" 
                                           value="<?= old('nombres') ?>" 
                                           placeholder="Ingresa los nombres"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="apellidos" class="form-label">
                                        <i class="fas fa-user me-2"></i>Apellidos
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="apellidos" 
                                           name="apellidos" 
                                           value="<?= old('apellidos') ?>" 
                                           placeholder="Ingresa los apellidos"
                                           required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nomusuario" class="form-label">
                                        <i class="fas fa-at me-2"></i>Nombre de Usuario
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="nomusuario" 
                                           name="nomusuario" 
                                           value="<?= old('nomusuario') ?>" 
                                           placeholder="Ingresa el nombre de usuario"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nivelacceso" class="form-label">
                                        <i class="fas fa-shield-alt me-2"></i>Nivel de Acceso
                                    </label>
                                    <select class="form-select" id="nivelacceso" name="nivelacceso">
                                        <option value="USER" <?= old('nivelacceso') == 'USER' ? 'selected' : '' ?>>Usuario</option>
                                        <option value="ADMIN" <?= old('nivelacceso') == 'ADMIN' ? 'selected' : '' ?>>Administrador</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="claveacceso" class="form-label">
                                <i class="fas fa-lock me-2"></i>Contraseña
                            </label>
                            <input type="password" 
                                   class="form-control" 
                                   id="claveacceso" 
                                   name="claveacceso" 
                                   placeholder="Ingresa la contraseña"
                                   required>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?= base_url('/usuario') ?>" class="btn btn-secondary me-md-2">
                                <i class="fas fa-arrow-left me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Crear Usuario
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
