# 🏍️ Sistema de Gestión de Motos - CodeIgniter 4

Sistema web desarrollado en **CodeIgniter 4** para la gestión de usuarios y catálogo de motos deportivas. Incluye autenticación, gestión de perfiles con avatares, y administración de usuarios con diferentes niveles de acceso.

## 📋 Tabla de Contenidos

- [Características Principales](#-características-principales)
- [Tecnologías Utilizadas](#-tecnologías-utilizadas)
- [Requisitos del Sistema](#-requisitos-del-sistema)
- [Instalación Paso a Paso](#-instalación-paso-a-paso)
- [Configuración del Entorno](#-configuración-del-entorno)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [Funcionalidades del Sistema](#-funcionalidades-del-sistema)
- [Usuarios de Prueba](#-usuarios-de-prueba)
- [Comandos Útiles](#-comandos-útiles)
- [Solución de Problemas](#-solución-de-problemas)
- [Desarrollo y Contribución](#-desarrollo-y-contribución)

## 🚀 Características Principales

- ✅ **Sistema de Autenticación** completo con login/logout
- ✅ **Gestión de Usuarios** con roles (ADMIN/USER)
- ✅ **Perfiles de Usuario** con edición de datos personales
- ✅ **Sistema de Avatares** con subida de imágenes
- ✅ **Catálogo de Motos** deportivas con información detallada
- ✅ **Interfaz Responsiva** con Bootstrap 5
- ✅ **Validación de Datos** en formularios
- ✅ **Mensajes Flash** para retroalimentación
- ✅ **Sesiones Seguras** con protección de rutas

## 🛠️ Tecnologías Utilizadas

- **Backend:** PHP 8.1+ con CodeIgniter 4
- **Frontend:** HTML5, CSS3, JavaScript, Bootstrap 5
- **Base de Datos:** MySQL 5.7+
- **Servidor Web:** Apache 2.4+ (XAMPP)
- **Iconos:** Font Awesome 6
- **Gestión de Dependencias:** Composer

## 📋 Requisitos del Sistema

### Requisitos Mínimos
- **PHP:** 8.1 o superior
- **MySQL:** 5.7 o superior
- **Apache:** 2.4 o superior
- **Composer:** 2.0 o superior
- **Sistema Operativo:** Windows 10/11, macOS, Linux

### Recomendado
- **XAMPP:** 8.2+ (para desarrollo local)
- **RAM:** 4GB mínimo, 8GB recomendado
- **Espacio en Disco:** 500MB libres

## 🔧 Instalación Paso a Paso

### 1️⃣ **Preparar el Entorno de Desarrollo**

#### Opción A: XAMPP (Recomendado para Windows)
1. Descargar e instalar [XAMPP](https://www.apachefriends.org/download.html)
2. Iniciar XAMPP Control Panel
3. Activar **Apache** y **MySQL**

#### Opción B: Instalación Manual
```bash
# Ubuntu/Debian
sudo apt update
sudo apt install apache2 mysql-server php8.1 php8.1-mysql php8.1-curl php8.1-json php8.1-mbstring php8.1-xml php8.1-zip

# CentOS/RHEL
sudo yum install httpd mysql-server php81 php81-mysql php81-curl php81-json php81-mbstring php81-xml php81-zip
```

### 2️⃣ **Clonar/Descargar el Proyecto**

```bash
# Si tienes Git instalado
git clone [URL_DEL_REPOSITORIO] Tarea07-SeminarioIII

# O descargar y extraer el ZIP en C:\xampp\htdocs\
```

### 3️⃣ **Instalar Dependencias con Composer**

```bash
# Navegar al directorio del proyecto
cd C:\xampp\htdocs\Tarea07-SeminarioIII

# Instalar dependencias
composer install
```

### 4️⃣ **Configurar la Base de Datos**

#### Crear Base de Datos
```bash
# Opción 1: Usando CodeIgniter CLI
php spark db:create miapp

# Opción 2: Usando phpMyAdmin
# 1. Abrir http://localhost/phpmyadmin
# 2. Crear nueva base de datos llamada "miapp"
# 3. Configurar charset: utf8mb4_unicode_ci
```

#### Ejecutar Migraciones
```bash
# Crear tablas de la base de datos
php spark migrate
```

#### Insertar Datos de Prueba
```bash
# Cargar usuarios de prueba
php spark db:seed SUsuarios
```

## ⚙️ Configuración del Entorno

### 1️⃣ **Configurar Virtual Host (XAMPP)**

#### Editar `C:\xampp\apache\conf\extra\httpd-vhosts.conf`
```apache
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/Tarea07-SeminarioIII/public"
    ServerName seminario.test
    <Directory "C:/xampp/htdocs/Tarea07-SeminarioIII/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

#### Editar `C:\Windows\System32\drivers\etc\hosts`
```
127.0.0.1    seminario.test
```

#### Reiniciar Apache
```bash
# En XAMPP Control Panel, detener y volver a iniciar Apache
```

### 2️⃣ **Configurar Base de Datos**

#### Editar `app/Config/Database.php`
```php
public array $default = [
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',  // Dejar vacío para XAMPP por defecto
    'database' => 'miapp',
    'DBDriver' => 'MySQLi',
    'DBPrefix' => '',
    'pConnect' => false,
    'DBDebug'  => true,
    'charset'  => 'utf8',
    'DBCollat' => 'utf8_general_ci',
    'swapPre'  => '',
    'encrypt'  => false,
    'compress' => false,
    'strictOn' => false,
    'failover' => [],
    'port'     => 3306,
];
```

### 3️⃣ **Configurar Permisos de Archivos**

```bash
# Crear directorios necesarios
mkdir -p writable/cache
mkdir -p writable/logs
mkdir -p writable/session
mkdir -p writable/uploads
mkdir -p public/images/user

# Configurar permisos (Linux/macOS)
chmod -R 755 writable/
chmod -R 755 public/images/
```

## 📁 Estructura del Proyecto

```
Tarea07-SeminarioIII/
├── app/                          # Código fuente de la aplicación
│   ├── Config/                   # Archivos de configuración
│   │   ├── App.php              # Configuración principal
│   │   ├── Database.php         # Configuración de BD
│   │   └── Routes.php           # Definición de rutas
│   ├── Controllers/             # Controladores MVC
│   │   ├── Auth.php            # Autenticación (login/logout)
│   │   ├── UsuarioController.php # Gestión de usuarios
│   │   ├── Dashboard.php       # Panel de control
│   │   └── WelcomeController.php # Página principal
│   ├── Models/                  # Modelos de datos
│   │   └── Usuario.php         # Modelo de usuario
│   ├── Views/                   # Vistas (templates)
│   │   ├── home/               # Vistas de login
│   │   ├── usuario/            # Vistas de gestión usuarios
│   │   ├── dashboard/          # Vistas del panel
│   │   └── template.php        # Template principal
│   └── Database/               # Base de datos
│       ├── Migrations/         # Migraciones
│       └── Seeds/             # Datos de prueba
├── public/                     # Archivos públicos
│   ├── index.php              # Punto de entrada
│   └── images/               # Imágenes y avatares
├── writable/                  # Archivos de escritura
│   ├── cache/                # Cache de la aplicación
│   ├── logs/                 # Logs del sistema
│   └── session/              # Archivos de sesión
├── vendor/                   # Dependencias de Composer
├── composer.json            # Configuración de Composer
└── spark                    # CLI de CodeIgniter
```

## 🎯 Funcionalidades del Sistema

### 🔐 **Sistema de Autenticación**
- **Login:** Validación de credenciales con hash seguro
- **Logout:** Destrucción segura de sesiones
- **Protección de Rutas:** Verificación de autenticación
- **Mensajes Flash:** Retroalimentación de errores/éxito

### 👤 **Gestión de Usuarios**
- **Listar Usuarios:** Vista completa con información
- **Crear Usuario:** Formulario con validaciones
- **Editar Usuario:** Modificación de datos existentes
- **Eliminar Usuario:** Borrado seguro de registros
- **Roles de Usuario:** ADMIN y USER con permisos diferenciados

### 🖼️ **Sistema de Perfiles**
- **Ver Perfil:** Información personal del usuario
- **Editar Perfil:** Modificación de datos personales
- **Subir Avatar:** Imágenes con validación de tipo y tamaño
- **Validaciones:** Campos obligatorios y formatos correctos

### 🏍️ **Catálogo de Motos**
- **Vista de Catálogo:** Grid responsivo con motos deportivas
- **Información Detallada:** Marca, modelo, cilindrada, precio
- **Diseño Atractivo:** Cards con iconos y descripciones
- **Datos Estáticos:** Información predefinida de motos

### 🎨 **Interfaz de Usuario**
- **Bootstrap 5:** Diseño responsivo y moderno
- **Font Awesome:** Iconografía consistente
- **Navbar Dinámico:** Menú con avatar y opciones
- **Mensajes Flash:** Alertas de éxito y error
- **Sidebar de Usuario:** Información y acciones rápidas

## 👥 Usuarios de Prueba

El sistema incluye dos usuarios predefinidos para testing:

### 🔑 **Administrador**
- **Usuario:** `Leo`
- **Contraseña:** `Leo25*`
- **Nivel:** ADMIN
- **Permisos:** Acceso completo a todas las funcionalidades

### 🔑 **Usuario Regular**
- **Usuario:** `Nai`
- **Contraseña:** `Nai25*`
- **Nivel:** USER
- **Permisos:** Acceso limitado a perfil y catálogo

## 🛠️ Comandos Útiles

### **Comandos de Base de Datos**
```bash
# Crear base de datos
php spark db:create miapp

# Ejecutar migraciones
php spark migrate

# Revertir última migración
php spark migrate:rollback

# Cargar datos de prueba
php spark db:seed SUsuarios

# Ver estado de migraciones
php spark migrate:status
```

### **Comandos de Desarrollo**
```bash
# Iniciar servidor de desarrollo
php spark serve

# Limpiar cache
php spark cache:clear

# Ver rutas disponibles
php spark routes

# Generar nueva migración
php spark make:migration NombreMigracion

# Generar nuevo controlador
php spark make:controller NombreController
```

### **Comandos de Testing**
```bash
# Ejecutar tests
php spark test

# Ejecutar tests específicos
php spark test --filter NombreTest
```

## 🐛 Solución de Problemas

### **Error: "seminario.test not found"**
```bash
# Verificar configuración de virtual host
# 1. Revisar C:\xampp\apache\conf\extra\httpd-vhosts.conf
# 2. Verificar C:\Windows\System32\drivers\etc\hosts
# 3. Reiniciar Apache en XAMPP
# 4. Limpiar cache del navegador
```

### **Error: "Table doesn't exist"**
```bash
# Ejecutar migraciones
php spark migrate

# Verificar conexión a base de datos
php spark db:show
```

### **Error: "Permission denied"**
```bash
# Configurar permisos de escritura (Linux/macOS)
chmod -R 755 writable/
chmod -R 755 public/images/

# Verificar propietario de archivos
sudo chown -R www-data:www-data writable/
```

### **Error: "Class not found"**
```bash
# Reinstalar dependencias
composer install --no-dev

# Limpiar cache de autoloader
composer dump-autoload
```

### **Error: "Session not working"**
```bash
# Verificar permisos de directorio de sesiones
chmod 755 writable/session/

# Verificar configuración de sesión en app/Config/App.php
```

## 🔧 Desarrollo y Contribución

### **Estructura de Desarrollo**
1. **Controladores:** Lógica de negocio y manejo de requests
2. **Modelos:** Interacción con base de datos
3. **Vistas:** Templates HTML con PHP embebido
4. **Rutas:** Definición de URLs y métodos HTTP

### **Convenciones de Código**
- **PSR-4:** Autoloading de clases
- **CamelCase:** Para métodos y propiedades
- **snake_case:** Para nombres de base de datos
- **Comentarios:** Documentación en inglés

### **Flujo de Desarrollo**
1. Crear migración para cambios de BD
2. Actualizar modelo si es necesario
3. Modificar controlador para nueva funcionalidad
4. Crear/actualizar vista correspondiente
5. Probar funcionalidad completa

### **Testing**
```bash
# Ejecutar suite completa de tests
php spark test

# Tests específicos por archivo
php spark test tests/unit/HealthTest.php
```

## 📞 Soporte y Contacto

Para soporte técnico o consultas sobre el proyecto:

- **Documentación CodeIgniter 4:** [https://codeigniter4.github.io/userguide/](https://codeigniter4.github.io/userguide/)
- **Foro Oficial:** [https://forum.codeigniter.com/](https://forum.codeigniter.com/)
- **GitHub Issues:** [Crear un issue en el repositorio]

---

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

---

**¡Sistema listo para usar!** 🚀

*Desarrollado con ❤️ usando CodeIgniter 4*