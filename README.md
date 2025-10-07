# 📦 Instalación de *Cuadre de Caja con DB* en un servidor local

Este proyecto permite registrar, consultar y generar reportes de cuadre de caja diario.
A continuación se detalla el proceso para instalarlo y ejecutarlo en un equipo que actúe como servidor dentro de una red local.

---

## ⚙️ Requisitos previos

Asegúrate de tener instalados los siguientes componentes en el servidor:

* [XAMPP](https://www.apachefriends.org/es/index.html) (Apache y MySQL activos)
* [Composer](https://getcomposer.org/)
* [Node.js](https://nodejs.org/)
* [Git](https://git-scm.com/)

---

## 🚀 Instalación del proyecto

1. **Clonar el repositorio**

   ```bash
   git clone https://github.com/tu_usuario/cuadre_caja_con_db.git
   cd cuadre_caja_con_db
   ```

2. **Instalar dependencias de PHP con Composer**

   ```bash
   composer install
   ```

3. **Instalar dependencias de JavaScript con npm**

   ```bash
   npm install
   ```

4. **Crear el archivo de entorno**

   Copia el archivo `.env.example` y renómbralo a `.env`:

   ```bash
   cp .env.example .env
   ```

5. **Generar la clave de la aplicación**

   ```bash
   php artisan key:generate
   ```

6. **Configurar la base de datos**

   * Abre el archivo `.env` y ajusta las variables de conexión a tu base de datos:

     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=cuadre_caja
     DB_USERNAME=root
     DB_PASSWORD=
     ```
   * Luego ejecuta las migraciones:

     ```bash
     php artisan migrate
     ```

---

## ▶️ Ejecución del proyecto

1. **Iniciar el servidor local de Laravel**

   ```bash
   php artisan serve --host=0.0.0.0 --port=8000
   ```

2. **Acceder desde otros equipos de la red**

   * Obtén la IP local del servidor:

     ```bash
     ipconfig  # en Windows
     ifconfig  # en Linux o macOS
     ```
   * Luego accede desde cualquier navegador en la red:

     ```
     http://<IP_DEL_SERVIDOR>:8000
     ```

---

## 🧹 Notas adicionales

* El archivo `.gitignore` incluye `*.sqlite*` para evitar subir bases de datos locales.
* Si realizas cambios en los estilos o scripts, puedes recompilar con:

  ```bash
  npm run dev
  ```
* Para modo producción:

  ```bash
  npm run build
  ```

---

## ✨ Autor

**Brayan Acosta**
*Tecnólogo en Electrónica Industrial y estudiante de Tecnología en Sistemas de Información*
