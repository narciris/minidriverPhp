# minidriverPhp

# 🗂️ MiniDrive – Sistema de Gestión de Archivos PHP MVC

## 🎯 Objetivo

En esta rama de desarrollará la configuracion del entorno de desarrollo con docker

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

### Creacion de imagen de docker

El Dockerfile es un archivo de texto que contiene una serie de instrucciones 
para construir una imagen de Docker.
Aquí tienes un ejemplo de un Dockerfile para una aplicación PHP con Apache:

### creacion archivo docker compose.yml

Docker Compose es una herramienta 
que permite definir y ejecutar aplicaciones Docker de múltiples contenedores

Projecto By Narciris Mena M , Estudiante Ing Sistemas - Desarrolladora Web

### Despliegue de la Aplicación PHP

Para desplegar la aplicación, simplemente ejecuta el siguiente comando 
en el directorio donde se encuentran tus archivos Dockerfile y docker-compose.yml:

``` docker-compose up -d ```
Este comando descargará las imágenes necesarias, construirá la imagen personalizada 
de PHP y Apache, y lanzará los contenedores definidos en docker-compose.yml.

### Verificación y Pruebas
Una vez que los contenedores estén en funcionamiento, abre tu navegador
web y navega a http://localhost. 
Deberías ver la página de inicio de tu aplicación PHP.

### Tecnologías implementadas
Docker: Dos contenedores principales:
PHP 8.2 con Apache
MySQL 8 (configurable para PostgreSQL)