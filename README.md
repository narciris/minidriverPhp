# minidriverPhp

# 🗂️ MiniDrive – Sistema de Gestión de Archivos PHP MVC


# MiniDrive API – Proyecto en PHP Puro

Este proyecto es una **API básica en PHP puro** que simula el funcionamiento de un mini sistema de almacenamiento tipo "drive", como Google Drive o Dropbox, pero de manera sencilla y controlada.

Está diseñado para aprender y demostrar cómo construir una API RESTful sin el uso de frameworks como Laravel o Symfony, apoyándose únicamente en las funcionalidades nativas de PHP y herramientas estándar como Composer.

---

## 🧱 Estructura del Proyecto

La estructura base del proyecto está organizada para mantener el código limpio y modular:

```
minidrive-php/
├── public/             # Punto de entrada para las peticiones HTTP (index.php)
├── src/                # Código fuente de la aplicación (controladores, servicios, etc.)
├── routes/             # Definición de rutas de la API
├── vendor/             # Librerías instaladas con Composer
├── composer.json       # Archivo de configuración de Composer
└── README.md           # Este documento
```

---

## 🚦 Enrutador Personalizado

Se implementó un **sistema de enrutamiento manual en PHP puro**, sin utilizar frameworks externos. Este enrutador intercepta todas las peticiones entrantes y las redirige a las rutas correspondientes de la API, haciendo uso de los parámetros de la URL.

El archivo `index.php`  sirve como punto de entrada para todas las peticiones, y el sistema de rutas es capaz de procesar cualquier URL que coincida con las definiciones, facilitando la expansión de nuevas funcionalidades sin perder la simplicidad del código.

---

## ⚙️ Autoloading con Composer

Para mejorar la gestión de dependencias y la carga automática de clases, se utilizó **Composer con su función de autoload**. Esto permitió organizar el código de manera más eficiente, de forma que cada clase se cargue automáticamente sin necesidad de incluir manualmente los archivos con `require`.

El autoloading es configurado en el archivo `composer.json` con el siguiente bloque:

```json
"autoload": {
    "psr-4": {
        "App\": "src/"
    }
}
```

Esto permite una estructura de clases y nombres de espacios que hace que el código sea más limpio y escalable.

---

## 📝 Rutas Definidas

En la rama de este proyecto se configuraron y definieron las siguientes rutas para simular el funcionamiento básico de un servicio de almacenamiento:


---

## 📦 Dependencias

Este proyecto depende de las siguientes librerías que fueron instaladas mediante Composer:

- **aws/aws-sdk-php**: Para la interacción con el servicio de almacenamiento S3 de AWS, en caso de necesitar manejar archivos de manera persistente en la nube.

Puedes instalar las dependencias ejecutando el siguiente comando:

```
composer install
```

Esto levantará el servidor en `http://localhost:8000`, donde podrás probar las rutas de la API.

---

## 📄 Conclusión

Este proyecto busca demostrar cómo construir una API RESTful simple en PHP puro, utilizando Composer para la gestión de dependencias y el autoloading de clases. Con esta base, se puede expandir el proyecto para manejar más funcionalidades o incluso integrar almacenamiento en la nube como AWS S3 para la gestión de archivos reales.
