<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso al Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card login-card">
                    <div class="card-body p-5">
                        <!-- Logo/Header -->
                        <div class="text-center mb-4">
                            <i class="fas fa-motorcycle fa-3x text-primary mb-3"></i>
                            <h3 class="card-title">Acceso al Sistema</h3>
                            <p class="text-muted">Sistema de gestión de motos</p>
                        </div>

                        <!-- Mensajes de error -->
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <?= session()->getFlashdata('error') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <!-- Formulario de login -->
                        <form action="<?= base_url('/login') ?>" method="post" autocomplete="off">
                            <!-- Campo Usuario -->
                            <div class="mb-3">
                                <label for="nomusuario" class="form-label">
                                    <i class="fas fa-user me-2"></i>Usuario
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg" 
                                       id="nomusuario" 
                                       name="nomusuario" 
                                       value="<?= old('nomusuario') ?>" 
                                       placeholder="Ingresa tu usuario"
                                       required 
                                       autofocus>
                            </div>
                            
                            <!-- Campo Contraseña -->
                            <div class="mb-4">
                                <label for="claveacceso" class="form-label">
                                    <i class="fas fa-lock me-2"></i>Contraseña
                                </label>
                                <input type="password" 
                                       class="form-control form-control-lg" 
                                       id="claveacceso" 
                                       name="claveacceso" 
                                       placeholder="Ingresa tu contraseña"
                                       required>
                            </div>

                            <!-- Botón de envío -->
                            <button type="submit" class="btn btn-primary btn-lg w-100 py-2">
                                <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                            </button>
                        </form>

                        <!-- Credenciales demo -->
                        <div class="text-center mt-4">
                            <div class="card bg-light">
                                <div class="card-body py-2">
                                    <small class="text-muted">
                                        <strong>Usuario:</strong> Leo / <strong>Contraseña:</strong> Leo25*<br>
                                        <strong>Usuario:</strong> Nai / <strong>Contraseña:</strong> Nai25*
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script para mostrar errores en consola -->
    <script>
        console.log('Página de login cargada correctamente');
        
        // Verificar que el formulario existe
        const form = document.querySelector('form');
        if (form) {
            console.log('Formulario encontrado, acción:', form.action);
            
            form.addEventListener('submit', function() {
                console.log('Formulario enviado');
            });
        }
    </script>
</body>
</html>