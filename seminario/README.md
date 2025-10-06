# 🏍️ Sistema de Gestión de Motos

Sistema web en CodeIgniter 4 para gestión de usuarios y catálogo de motos.

## 🚀 Instalación (3 pasos)

### 1️⃣ **Configurar XAMPP**
- Abrir XAMPP Control Panel
- Iniciar **Apache** y **MySQL**

### 2️⃣ **Configurar URLs**
**Archivo:** `C:\xampp\apache\conf\extra\httpd-vhosts.conf`
```apache
<VirtualHost *:80>
	DocumentRoot "C:/xampp/htdocs/seminario/public"
	ServerName seminario.test
	<Directory "C:/xampp/htdocs/seminario/public">
		AllowOverride All
		Require all granted
	</Directory>
</VirtualHost>
```

**Archivo:** `C:\Windows\System32\drivers\etc\hosts`
```
127.0.0.1	   seminario.test
```

### 3️⃣ **Configurar Base de Datos**
```bash
# Crear base de datos
php spark db:create miapp

# Ejecutar migraciones
php spark migrate

# Insertar usuarios de prueba
php spark db:seed SUsuarios
```

## 🎯 Acceder al Sistema

- **URL:** `http://seminario.test`
- **Admin:** `Leo` / `Leo25*`
- **Usuario:** `Nai` / `Nai25*`

## 📋 Funcionalidades

- ✅ Login/Logout
- ✅ Ver catálogo de motos
- ✅ Gestionar perfil y avatar
- ✅ Gestionar usuarios (solo admin)

## 🛠️ Comandos Útiles

```bash
# Migraciones
php spark migrate

# Seeds
php spark db:seed SUsuarios

# Servidor desarrollo
php spark serve
```

## 🐛 Problemas Comunes

**Error "seminario.test not found"**
- Verificar configuración de virtual host
- Reiniciar Apache

**Error "Table doesn't exist"**
```bash
php spark migrate
```

---

**¡Listo para usar!** 🚀