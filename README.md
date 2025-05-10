# minidriverPhp

# 🗂️ MiniDrive – Sistema de Gestión de Archivos PHP MVC

## 🎯 Objetivo

Desarrollar una aplicación web en PHP puro que funcione como una versión básica de Google Drive. El sistema debe permitir a los usuarios autenticados subir, gestionar y visualizar archivos dentro de carpetas. Además, se debe permitir elegir entre almacenamiento local o en la nube (Amazon S3) al momento de subir los archivos.

---

## 📚 Requerimientos funcionales

1. **Autenticación de usuarios**
   - Registro y login.
   - Cada usuario debe tener una preferencia de almacenamiento: `local` o `s3`.
   - Auth Google

2. **Gestión de archivos**
   - Subir archivos (PDF, Excel, imágenes, ZIP, etc.).
   - Listar archivos con filtros por tipo o fecha.
   - Descargar archivos.
   - Eliminar archivos.
   - Visualizar archivos por carpetas.

3. **Gestión de carpetas**
   - Crear, renombrar y eliminar carpetas.
   - Navegación jerárquica (subcarpetas).

4. **Historial de acciones**
   - Registrar acciones como subida, descarga y eliminación por parte de los usuarios.

5. **Opción de almacenamiento**
   - Al subir un archivo, el usuario elige entre:
     - **Local** (almacenado en el servidor).
     - **AWS S3** (almacenado en la nube).

---

## ⚙️ Requerimientos técnicos

- Lenguaje: **PHP puro**
- Arquitectura: **MVC + POO**
- Acceso a base de datos con **PDO**
- Base de datos: **MySQL** o **PostgreSQL**
- Contenerización con **Docker**:
  - Contenedor para PHP + Apache
  - Contenedor para la base de datos
  - Volumen para persistencia de archivos locales
- Uso de **volúmenes Docker** para archivos y datos persistentes.
- Manejo de dependencias con **Composer**.
- Integración con **AWS SDK para PHP** para subir archivos a Amazon S3.

---



## 📤 Restricciones

- Solo usuarios autenticados pueden gestionar archivos y carpetas.
- Validar tipo y tamaño de archivo antes de subir.
- Permitir cambiar preferencia de almacenamiento desde la configuración del usuario.
- Mostrar al usuario en qué almacenamiento se encuentra cada archivo.

---

## 🧪 Extras opcionales

- Vista previa de imágenes o PDFs.
- Búsqueda y paginación de archivos.
- Exportar historial a CSV.
- Notificaciones simples (ej. subida exitosa).
- Barra de progreso al subir archivos.

---

Projecto By Narciris Mena M , Estudiante Ing Sistemas - Desarrolladora Web