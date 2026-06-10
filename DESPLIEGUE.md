# 🚀 Guía de despliegue — Render + Supabase

Esta guía explica, paso a paso, cómo poner en producción el **Sistema de
Gestión de Matrícula**:

- **Base de datos** → [Supabase](https://supabase.com) (PostgreSQL gratuito).
- **Aplicación PHP** → [Render](https://render.com) (Web Service).

```
┌──────────────┐        ┌──────────────────┐        ┌────────────────────┐
│  Navegador   │ ─────▶ │  Render (PHP app) │ ─────▶ │ Supabase (Postgres)│
└──────────────┘        └──────────────────┘        └────────────────────┘
```

---

## Parte 1 — Base de datos en Supabase

### 1.1 Crear el proyecto
1. Entra a <https://supabase.com> e inicia sesión.
2. **New project** → ponle nombre (p. ej. `instituto-idiomas`), elige una
   **contraseña de base de datos** (guárdala) y una **región** cercana.
3. Espera 1–2 minutos a que se aprovisione.

### 1.2 Crear las tablas y los datos
1. En el menú lateral abre **SQL Editor** → **New query**.
2. Copia y pega **todo** el contenido de
   [`database/supabase_schema.sql`](database/supabase_schema.sql) y pulsa **Run**.
3. Nueva query: copia y pega
   [`database/supabase_data.sql`](database/supabase_data.sql) y pulsa **Run**.
4. Verifica en **Table Editor** que existen las tablas (`usuario`, `curso`, …)
   con datos.

### 1.3 Obtener los datos de conexión
1. Ve a **Project Settings** (⚙️) → **Database**.
2. En **Connection string** / **Connection pooling** copia los datos del
   **Pooler** (recomendado para apps web). Necesitas:

   | Dato        | Dónde está en Supabase                         |
   |-------------|------------------------------------------------|
   | **Host**    | `...pooler.supabase.com`                        |
   | **Port**    | `6543` (Transaction pooler) o `5432` (Session)  |
   | **Database**| normalmente `postgres`                          |
   | **User**    | `postgres.xxxxxxxx` (incluye el ref del proyecto)|
   | **Password**| la contraseña que definiste en 1.1              |

> 💡 La app usa **prepares emulados**, así que el **Transaction pooler
> (6543)** funciona sin problemas. Si prefieres, usa el **Session pooler
> (5432)**.

---

## Parte 2 — Aplicación en Render

Render no tiene un runtime nativo de PHP, así que la forma estándar y
reproducible es desplegar con **Docker**. Solo necesitas añadir un
`Dockerfile` en la raíz del repositorio.

### 2.1 Añadir el Dockerfile

Crea un archivo `Dockerfile` en la raíz del proyecto con este contenido:

```dockerfile
FROM php:8.2-apache

# Extensión PDO para PostgreSQL (Supabase)
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

# Copiar la aplicación al document root de Apache
COPY . /var/www/html/

# Render expone el puerto vía $PORT; Apache escucha en él
ENV PORT=10000
RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf
EXPOSE 10000
```

> Si también quieres soportar MySQL en el mismo contenedor, añade
> `pdo_mysql` a la línea de `docker-php-ext-install`.

Haz commit y push de este archivo al repositorio.

### 2.2 Crear el Web Service
1. Entra a <https://dashboard.render.com> → **New** → **Web Service**.
2. Conecta tu repositorio de GitHub/GitLab y selecciónalo.
3. Configuración:
   - **Runtime:** `Docker` (Render detectará el `Dockerfile`).
   - **Branch:** `master` (o la que uses).
   - **Instance Type:** `Free` es suficiente para pruebas.

### 2.3 Configurar variables de entorno
En la sección **Environment** del servicio, añade:

| Key             | Value (ejemplo)                                  |
|-----------------|--------------------------------------------------|
| `DB_CONNECTION` | `pgsql`                                          |
| `DB_HOST`       | `aws-0-us-east-1.pooler.supabase.com`            |
| `DB_PORT`       | `6543`                                           |
| `DB_NAME`       | `postgres`                                        |
| `DB_USER`       | `postgres.xxxxxxxxxxxxxxxx`                       |
| `DB_PASSWORD`   | *(tu contraseña de Supabase)*                    |
| `DB_SSLMODE`    | `require`                                         |

### 2.4 Desplegar
1. Pulsa **Create Web Service**. Render construirá la imagen y la desplegará.
2. Cuando el estado sea **Live**, abre la URL pública
   (`https://tu-app.onrender.com`).
3. Deberías ver el **login**. Entra con un usuario de prueba:
   - `carlos.admin@idiomas.com` / `123456`

---

## Parte 3 — Verificación

- [ ] La página de login carga correctamente.
- [ ] Puedes iniciar sesión con los usuarios de prueba.
- [ ] El listado de cursos muestra datos y horarios.
- [ ] La búsqueda funciona (insensible a mayúsculas).
- [ ] Un estudiante puede matricularse en un curso.

---

## 🧰 Solución de problemas

| Síntoma | Causa probable | Solución |
|---------|----------------|----------|
| `could not find driver` | Falta `pdo_pgsql` | Verifica la línea `docker-php-ext-install pdo pdo_pgsql` en el Dockerfile. |
| `SSL connection required` | Falta SSL | Asegúra `DB_SSLMODE=require`. |
| `password authentication failed` | Credenciales | Revisa `DB_USER` (incluye `postgres.<ref>`) y `DB_PASSWORD`. |
| `prepared statement "..." already exists` | Pooler en modo transacción sin emulación | Ya se usa `ATTR_EMULATE_PREPARES`; si persiste, usa el **Session pooler (5432)**. |
| La app carga pero sin estilos | Rutas de assets | Bootstrap se carga vía CDN; verifica conexión a internet del navegador. |
| 502 / la app "duerme" | Free tier de Render se suspende por inactividad | Normal en el plan Free: el primer acceso tras inactividad tarda unos segundos. |

---

## 📌 Notas

- **No subas el archivo `.env`** al repositorio (ya está en `.gitignore`).
  Las credenciales de producción viven solo en el dashboard de Render.
- El plan **Free** de Render suspende el servicio tras inactividad; la
  primera petición posterior puede tardar ~30 s en responder.
- El plan **Free** de Supabase pausa proyectos sin actividad durante varios
  días; basta con reactivarlo desde el dashboard.
- Para desarrollo local, consulta el [README.md](README.md).
