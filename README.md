# Registro de Cambios - Rama de Desarrollo

**Fecha:** 2025-05-15

## Descripción General

En esta rama se realizaron las siguientes configuraciones y funcionalidades como parte del desarrollo de la aplicación:

---

## 🔧 Configuración de la conexión a la base de datos

- Se estableció la conexión entre el backend en PHP y una base de datos MySQL que corre dentro de un contenedor Docker.
- Se utilizó un archivo `.env` para almacenar las variables sensibles como el `DB_HOST`, `DB_PORT`, `DB_USER`, `DB_PASSWORD` y `DB_NAME`.
- Se implementó la clase `Connexion.php` para gestionar esta conexión de manera segura y reutilizable.

### Archivos modificados / creados:
- `index.php` (para cargar las variables del entorno)
- `src/core/Connexion.php`
- `.env`
- `.env.example`

---

## 🧾 Funcionalidad: Registro de usuario

- Se creó un flujo completo para registrar un nuevo usuario utilizando datos provenientes de un formulario.
- Se validaron los datos mediante un DTO (`RegisterRequestDto.php`).
- Se implementó la lógica de almacenamiento en la base de datos a través del modelo `User.php`.
- Se estructuró el servicio `AuthService.php` para centralizar la lógica de autenticación y registro.
- El controlador `AuthController.php` maneja la petición y delega al servicio correspondiente.

### Archivos creados / modificados:
- `src/app/controllers/AuthController.php`
- `src/services/AuthService.php`
- `src/models/User.php`
- `src/dtos/RegisterRequestDto.php`
- `src/views/auth/login.php`

---

## 🛠️ Notas adicionales

- Se utilizó PHP dotenv para proteger la configuración sensible y cargar automáticamente las variables de entorno desde el archivo `.env`.
- Se actualizó `.gitignore` para asegurarse de que archivos sensibles como `.env` no sean rastreados por Git.
- Se corrigió un error en la carga del archivo `.env` causado por el orden incorrecto en `index.php`.

---

## ✅ Resultado esperado

Al finalizar estos cambios, la aplicación puede conectarse correctamente a la base de datos alojada en un contenedor Docker y permite registrar usuarios desde el frontend o una herramienta de pruebas como Postman.
