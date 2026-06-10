# 🎓 Sistema de Gestión de Matrícula — Instituto de Idiomas

Aplicación web para la administración académica de un instituto de idiomas:
gestión de usuarios, docentes, estudiantes, cursos, niveles, idiomas,
horarios, matrículas y control de asistencia.

Desarrollada en **PHP** con arquitectura **MVC** y acceso a datos mediante
**PDO**. Preparada para desplegarse con **Render** (aplicación) y
**Supabase / PostgreSQL** (base de datos).

---

## 📑 Tabla de contenidos

- [Características](#-características)
- [Arquitectura](#-arquitectura)
- [Tecnologías](#-tecnologías)
- [Estructura del proyecto](#-estructura-del-proyecto)
- [Requisitos](#-requisitos)
- [Instalación local](#-instalación-local)
- [Variables de entorno](#-variables-de-entorno)
- [Usuarios de prueba](#-usuarios-de-prueba)
- [Despliegue](#-despliegue)
- [Notas técnicas](#-notas-técnicas)

---

## ✨ Características

- **Autenticación** por email y contraseña con hash seguro (`password_hash` / `password_verify`).
- **Tres perfiles** con vistas y permisos diferenciados:
  - 👨‍💼 **Administrador** — gestiona docentes, estudiantes, cursos, niveles, idiomas y horarios.
  - 👩‍🏫 **Docente** — consulta sus cursos, horarios y registra la asistencia de sus estudiantes.
  - 🧑‍🎓 **Estudiante** — explora cursos, se matricula y revisa su asistencia.
- **Gestión académica completa (CRUD):** cursos, niveles, idiomas, aulas y horarios.
- **Matrícula** con validación de cupo máximo y de duplicados.
- **Control de asistencia** por curso y fecha.
- **Búsquedas** sobre cursos, docentes y estudiantes.

---

## 🏗 Arquitectura

Patrón **MVC** clásico en PHP:

```
Navegador ──▶ views/ (HTML + PHP)
                 │
                 ▼
           controllers/ (lógica de petición)
                 │
                 ▼
             models/ (consultas PDO)
                 │
                 ▼
        config/conexion.php (PDO: PostgreSQL/MySQL)
                 │
                 ▼
        Base de datos (Supabase / MySQL)
```

La conexión está **centralizada** en `config/conexion.php`, que se configura
por **variables de entorno** y soporta tanto **PostgreSQL** (producción /
Supabase) como **MySQL** (desarrollo local).

---

## 🛠 Tecnologías

| Capa            | Tecnología                          |
|-----------------|-------------------------------------|
| Lenguaje        | PHP 8.x                             |
| Acceso a datos  | PDO (`pdo_pgsql` / `pdo_mysql`)     |
| Base de datos   | PostgreSQL (Supabase) — MySQL local |
| Frontend        | HTML5, Bootstrap 5, Bootstrap Icons |
| Despliegue app  | Render                              |

---

## 📂 Estructura del proyecto

```
LPII/
├── index.php                 # Punto de entrada (redirige al login)
├── config/
│   └── conexion.php          # Conexión PDO configurable por entorno
├── controllers/              # Controladores por módulo
├── models/                   # Modelos / consultas a la BD
├── views/                    # Vistas por módulo (login, curso, matricula, ...)
├── css/
│   └── styles.css
├── database/
│   ├── BD.sql                # Esquema original (MySQL)
│   ├── DATA.sql              # Datos de prueba (MySQL)
│   ├── supabase_schema.sql   # Esquema para PostgreSQL / Supabase
│   └── supabase_data.sql     # Datos de prueba para PostgreSQL / Supabase
├── .env.example              # Plantilla de variables de entorno
├── README.md
└── DESPLIEGUE.md             # Guía paso a paso (Render + Supabase)
```

---

## ✅ Requisitos

- **PHP 8.0+** con las extensiones:
  - `pdo_pgsql` (PostgreSQL / Supabase) **y/o** `pdo_mysql` (MySQL local)
- Un servidor web (Apache, Nginx o el servidor embebido de PHP).
- Una base de datos PostgreSQL (Supabase) o MySQL.

---

## 💻 Instalación local

### Opción A — PostgreSQL (igual que producción, recomendado)

1. Clona el repositorio:
   ```bash
   git clone <URL-del-repo>
   cd LPII
   ```
2. Crea tu archivo de entorno:
   ```bash
   cp .env.example .env
   ```
   Edita `.env` con los datos de tu base PostgreSQL/Supabase.
3. Carga el esquema y los datos en tu base PostgreSQL:
   ```bash
   psql "$DATABASE_URL" -f database/supabase_schema.sql
   psql "$DATABASE_URL" -f database/supabase_data.sql
   ```
   (o pégalos en el **SQL Editor** de Supabase).
4. Levanta el servidor embebido de PHP desde la raíz del proyecto:
   ```bash
   php -S localhost:8000
   ```
5. Abre <http://localhost:8000>.

### Opción B — MySQL local (XAMPP / MAMP)

1. En tu `.env` usa el bloque de MySQL (ver `.env.example`):
   ```env
   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_NAME=InstitutoIdiomas
   DB_USER=root
   DB_PASSWORD=
   ```
2. Importa `database/BD.sql` y `database/DATA.sql` en phpMyAdmin / MySQL.
3. Sirve el proyecto desde la raíz (`php -S localhost:8000` o tu vhost).

---

## 🔐 Variables de entorno

| Variable         | Descripción                                  | Por defecto              |
|------------------|----------------------------------------------|--------------------------|
| `DB_CONNECTION`  | Driver: `pgsql` o `mysql`                     | `pgsql`                  |
| `DB_HOST`        | Host de la base de datos                      | `localhost`              |
| `DB_PORT`        | Puerto                                        | `5432` (pgsql) / `3306`  |
| `DB_NAME`        | Nombre de la base de datos                    | `postgres` / `InstitutoIdiomas` |
| `DB_USER`        | Usuario                                       | `postgres` / `root`      |
| `DB_PASSWORD`    | Contraseña                                    | *(vacío)*                |
| `DB_SSLMODE`     | Modo SSL de PostgreSQL                         | `require`                |

> En desarrollo local, las variables se leen de un archivo `.env` (cargado
> automáticamente por `config/conexion.php`). En Render se definen en el
> dashboard del servicio. **Nunca subas tu `.env` al repositorio.**

---

## 👥 Usuarios de prueba

Todos los usuarios de `supabase_data.sql` comparten la contraseña **`123456`**.

| Perfil        | Email                          | Contraseña |
|---------------|--------------------------------|------------|
| Administrador | `carlos.admin@idiomas.com`     | `123456`   |
| Docente       | `maria.docente@idiomas.com`    | `123456`   |
| Estudiante    | `ana.estudiante@idiomas.com`   | `123456`   |

---

## 🚀 Despliegue

La guía completa paso a paso (Supabase + Render) está en
**[DESPLIEGUE.md](DESPLIEGUE.md)**.

Resumen:

1. Crear el proyecto en **Supabase** y ejecutar `supabase_schema.sql` + `supabase_data.sql`.
2. Crear un **Web Service** en **Render** apuntando al repositorio.
3. Configurar las **variables de entorno** con los datos de Supabase.
4. Desplegar y abrir la URL pública.

---

## 📝 Notas técnicas

- **PostgreSQL vs MySQL:** la base se diseñó originalmente en MySQL. La
  capa de conexión (`config/conexion.php`) incluye una subclase de
  `PDOStatement` que devuelve las columnas en *camelCase*
  (`idUsuario`, `fechaInicio`, …), de modo que el código de modelos y vistas
  funciona igual sobre PostgreSQL, que normalmente las devolvería en
  minúsculas.
- Se usan **prepares emulados** (`PDO::ATTR_EMULATE_PREPARES`) para que el
  *connection pooler* de Supabase funcione sin problemas.
- Las consultas de búsqueda usan `ILIKE` (insensible a mayúsculas) en PostgreSQL.
