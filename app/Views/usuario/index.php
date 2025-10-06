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
                    <li><a class="dropdown-item" href="<?= base_url('/welcome') ?>">
                        <i class="fas fa-home me-2"></i>Inicio
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
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-users me-2"></i>Gestión de Usuarios
                    </h4>
                    <a href="<?= base_url('/usuario/crear') ?>" class="btn btn-primary">
                        <i class="fas fa-user-plus me-2"></i>Crear Nuevo Usuario
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Avatar</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Usuario</th>
                                    <th>Nivel</th>
                                    <th>Fecha Creación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usuarios as $user): ?>
                                <tr>
                                    <td><?= $user['id'] ?></td>
                                    <td>
                                        <img src="<?= base_url('images/user/' . $user['avatar']) ?>" 
                                             class="rounded-circle" width="40" height="40" 
                                             alt="Avatar">
                                    </td>
                                    <td><?= $user['nombres'] ?></td>
                                    <td><?= $user['apellidos'] ?></td>
                                    <td><?= $user['nomusuario'] ?></td>
                                    <td>
                                        <span class="badge bg-<?= $user['nivelacceso'] == 'ADMIN' ? 'success' : 'info' ?>">
                                            <?= $user['nivelacceso'] ?>
                                        </span>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($user['create_at'])) ?></td>
                                    <td>
                                        <a href="<?= base_url('/usuario/editar/' . $user['id']) ?>" 
                                           class="btn btn-sm btn-warning me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= base_url('/usuario/eliminar/' . $user['id']) ?>" 
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
