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


⚙️ Script de arranque automático (iniciar_servidor.bat)

Para facilitar el proceso de inicio del proyecto sin tener que abrir manualmente XAMPP y Laravel, puedes crear un script .bat que automatiza todo el proceso.
Este script inicia Apache, MySQL y Laravel en segundo plano, y luego abre el navegador con la aplicación lista para usarse.

📄 Crear el archivo

Abre Bloc de notas.

Copia el siguiente contenido:

@echo off
title Iniciando servidor local - Cuadre de Caja
color 0A

echo ==============================================
echo   🚀 Iniciando entorno de Cuadre de Caja...
echo ==============================================
echo.

:: Ir a la carpeta principal de XAMPP
cd /d "C:\xampp"

echo [1/4] Iniciando Apache...
start /B "" "C:\xampp\apache\bin\httpd.exe"

echo [2/4] Iniciando MySQL...
start /B "" "C:\xampp\mysql\bin\mysqld.exe"

:: Esperar unos segundos para que se levanten los servicios
timeout /t 5 /nobreak >nul

echo [3/4] Iniciando servidor Laravel...
cd /d "C:\xampp\htdocs\cuadre-caja"
start /B php artisan serve --host=0.0.0.0 --port=8000 > laravel.log 2>&1

:: Esperar un poco para que el servidor de Laravel inicie
timeout /t 3 /nobreak >nul

echo [4/4] Abriendo navegador...
start http://127.0.0.1:8000

echo.
echo ✅ Todo listo. Servidor ejecutándose en segundo plano.
echo Puedes cerrar esta ventana sin detener el servidor.
echo (Para detenerlo, cierra Apache, MySQL o usa CTRL+C en Laravel)
echo.

pause >nul
exit



Guárdalo con el nombre:

iniciar_servidor.bat


Colócalo en el escritorio o dentro de la carpeta del proyecto.

🚀 Uso

Haz doble clic sobre el archivo iniciar_servidor.bat.

Espera unos segundos mientras se inician Apache, MySQL y Laravel.

El navegador se abrirá automáticamente en la dirección:

http://127.0.0.1:8000

El proyecto quedará corriendo en segundo plano.

🧠 Notas

Si deseas acceder desde otro dispositivo en la misma red, cambia la línea:
start http://127.0.0.1:8000
por: 
start http://<TU_IP_LOCAL>:8000

El log del servidor Laravel se guardará en laravel.log dentro del proyecto.

Si usas Node o necesitas ejecutar npm run dev, puedes añadirlo al script justo antes de abrir el navegador:

start /B npm run dev





🛑 Script de apagado automático (detener_servidor.bat)

Este script permite detener fácilmente todos los servicios que fueron iniciados por el script anterior, incluyendo Apache, MySQL y Laravel.
Evita tener que abrir manualmente el panel de control de XAMPP o cerrar procesos desde el administrador de tareas.

📄 Crear el archivo

Abre Bloc de notas.

Copia el siguiente contenido:

@echo off
title Detener servidor local - Cuadre de Caja
color 0C

echo ==============================================
echo   🛑 Deteniendo entorno de Cuadre de Caja...
echo ==============================================
echo.

:: Detener Apache
echo [1/3] Cerrando Apache...
taskkill /F /IM httpd.exe >nul 2>&1

:: Detener MySQL
echo [2/3] Cerrando MySQL...
taskkill /F /IM mysqld.exe >nul 2>&1

:: Detener servidor Laravel
echo [3/3] Cerrando servidor Laravel...
taskkill /F /IM php.exe >nul 2>&1

echo.
echo ✅ Todos los servicios han sido detenidos correctamente.
echo ==============================================
echo.

pause >nul
exit

Guárdalo como:
detener_servidor.bat

Colócalo junto al archivo iniciar_servidor.bat.

🚀 Uso

Haz doble clic sobre detener_servidor.bat.

Todos los servicios de Apache, MySQL y Laravel se cerrarán automáticamente.

Si deseas comprobar que se detuvieron correctamente, puedes abrir el Panel de Control de XAMPP o el Administrador de tareas (Ctrl + Shift + Esc).

🧠 Notas

Este script detiene todos los procesos httpd.exe, mysqld.exe y php.exe, por lo que no debe usarse si tienes otros proyectos Laravel o servidores corriendo simultáneamente.

Si quieres hacerlo más seguro, puedes modificar las líneas para detener solo el servidor Laravel en el puerto 8000:

for /f "tokens=5" %%a in ('netstat -ano ^| find ":8000"') do taskkill /PID %%a /F

Recomendado: ejecutar ambos scripts (iniciar_servidor.bat y detener_servidor.bat) como Administrador para evitar bloqueos por permisos.




🔁 Script de reinicio automático (reiniciar_servidor.bat)

Este script detiene y vuelve a iniciar Apache, MySQL y Laravel automáticamente, asegurando que el sistema se recupere sin intervención manual.
Es ideal para mantener el proyecto activo en entornos compartidos o cuando el servidor se reinicia inesperadamente.

📄 Crear el archivo

Abre Bloc de notas.

Copia el siguiente contenido:

@echo off
title Reiniciar servidor local - Cuadre de Caja
color 0B

echo ==============================================
echo   🔁 Reiniciando entorno de Cuadre de Caja...
echo ==============================================
echo.

:: Detener procesos anteriores
echo [1/4] Cerrando procesos previos...
taskkill /F /IM httpd.exe >nul 2>&1
taskkill /F /IM mysqld.exe >nul 2>&1
taskkill /F /IM php.exe >nul 2>&1

timeout /t 3 /nobreak >nul

:: Iniciar Apache y MySQL
echo [2/4] Iniciando Apache y MySQL...
cd /d "C:\xampp"
start /B "" "C:\xampp\apache\bin\httpd.exe"
start /B "" "C:\xampp\mysql\bin\mysqld.exe"

timeout /t 5 /nobreak >nul

:: Iniciar Laravel
echo [3/4] Iniciando servidor Laravel...
cd /d "C:\xampp\htdocs\cuadre-caja"
start /B php artisan serve --host=0.0.0.0 --port=8000 > laravel.log 2>&1

timeout /t 3 /nobreak >nul

:: Abrir navegador
echo [4/4] Abriendo navegador web...
start http://127.0.0.1:8000

echo.
echo ✅ Servidor reiniciado correctamente.
echo ==============================================
echo.

pause >nul
exit

Guárdalo como:

reiniciar_servidor.bat

Colócalo en la misma carpeta que los otros dos scripts (iniciar_servidor.bat y detener_servidor.bat).


🚀 Uso

Haz doble clic sobre reiniciar_servidor.bat.

Detendrá los procesos activos y volverá a levantar el entorno completo de forma limpia.

El navegador abrirá automáticamente la aplicación en http://127.0.0.1:8000.

⚙️ Ejecución automática al iniciar Windows (opcional)

Si deseas que el servidor se levante automáticamente cada vez que se encienda el equipo:

Presiona Win + R y escribe:

shell:startup

Se abrirá la carpeta de Inicio automático de Windows.

Crea un acceso directo al archivo reiniciar_servidor.bat dentro de esa carpeta.

Listo —cada vez que el usuario encienda el PC, el sistema iniciará Apache, MySQL y Laravel automáticamente en segundo plano.

🧠 Consejos

Si el usuario cierra accidentalmente el navegador, la aplicación seguirá activa. Solo debe volver a abrir http://127.0.0.1:8000.

Si el PC se apaga, el script se ejecutará nuevamente al encender (si seguiste el paso de “Inicio automático”).

Puedes combinar este script con detener_servidor.bat si en algún momento deseas hacer mantenimiento o reinicios manuales.



⚙️también una versión silenciosa del script (sin pausas ni mensajes, ideal para ejecutar en segundo plano al iniciar Windows) 

#### 🧠 Propósito

Este script automatiza el arranque y monitoreo del entorno local de desarrollo/producción en Windows. Garantiza que Apache, MySQL y Laravel estén activos, incluso si alguien cierra el servidor accidentalmente.

#### ⚙️ Ubicación

Guarda el archivo en:
`C:\xampp\htdocs\cuadre-caja\auto_start_server.bat`

#### 🚀 Ejecución

1. Haz doble clic sobre el archivo `auto_start_server.bat`.
2. El script:

   * Inicia Apache y MySQL si no están activos.
   * Inicia el servidor Laravel en el puerto 8000 si no está corriendo.
   * Abre el navegador en `http://127.0.0.1:8000` la primera vez.
   * Supervisa los servicios cada 30 segundos, reiniciando los que se caigan.

#### 🔁 Ejecución Automática al Iniciar Windows

Para que el sistema se reinicie automáticamente tras un reinicio o cierre:

1. Presiona `Win + R` → escribe `shell:startup` → Enter.
2. Copia un acceso directo del archivo `auto_start_server.bat` dentro de esa carpeta.
3. Cada vez que se encienda el PC, el script se ejecutará automáticamente.

#### 📄 Notas

* Si deseas ver los registros de Laravel, revisa el archivo `laravel.log`.
* Puedes modificar el puerto cambiando `--port=8000` en el script.
* Si mueves el proyecto, ajusta la ruta `C:\xampp\htdocs\cuadre-caja`.


🧩 Script: auto_start_server.bat

@echo off
title Servidor Cuadre de Caja - AutoInicio
cd /d "C:\xampp"

:loop
cls
echo ===========================================
echo   Iniciando Servicios del Sistema CuadreCaja
echo ===========================================

:: Verificar e iniciar Apache
tasklist /FI "IMAGENAME eq httpd.exe" | find /I "httpd.exe" >nul
if errorlevel 1 (
    echo Iniciando Apache...
    start /B apache\bin\httpd.exe
) else (
    echo Apache ya está ejecutándose.
)

:: Verificar e iniciar MySQL
tasklist /FI "IMAGENAME eq mysqld.exe" | find /I "mysqld.exe" >nul
if errorlevel 1 (
    echo Iniciando MySQL...
    start /B mysql\bin\mysqld.exe
) else (
    echo MySQL ya está ejecutándose.
)

timeout /t 5 /nobreak >nul

:: Iniciar Laravel si no está activo
echo Verificando servidor Laravel...
netstat -ano | find "8000" | find "LISTENING" >nul
if errorlevel 1 (
    echo Iniciando servidor Laravel...
    cd /d "C:\xampp\htdocs\cuadre-caja"
    start /B php artisan serve --host=0.0.0.0 --port=8000 > laravel.log 2>&1
) else (
    echo Servidor Laravel ya está activo.
)

timeout /t 3 /nobreak >nul

:: Abrir navegador solo la primera vez
if not exist "opened.flag" (
    echo Abriendo navegador...
    start http://127.0.0.1:8000
    echo 1 > opened.flag
)

echo Servicios ejecutándose correctamente.
echo Supervisando procesos...
timeout /t 30 /nobreak >nul
goto loop





## ✨ Autor

**Brayan Acosta**
*Tecnólogo en Electrónica Industrial y estudiante de Tecnología en Sistemas de Información*
