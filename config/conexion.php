<?php

/**
 * Statement que devuelve las columnas con su nombre en camelCase.
 *
 * PostgreSQL pasa a minúsculas todos los identificadores sin comillas
 * (idUsuario -> idusuario), pero el resto del proyecto lee las columnas
 * en camelCase ($fila['idUsuario'], $obj->fechaInicio, ...). Esta clase
 * remapea las claves después de cada fetch para no tener que reescribir
 * todas las consultas ni las vistas. Es idempotente: sobre MySQL, donde
 * las columnas ya llegan en camelCase, no cambia nada.
 */
class CamelCaseStatement extends PDOStatement
{
    /** @var array<string,string> minúsculas => camelCase */
    public static $mapa = [];

    protected function __construct()
    {
        // El constructor de PDOStatement es protegido; PDO lo instancia.
    }

    private function remapear($valor)
    {
        if (is_array($valor)) {
            $salida = [];
            foreach ($valor as $clave => $v) {
                if (is_string($clave)) {
                    $clave = self::$mapa[strtolower($clave)] ?? $clave;
                }
                $salida[$clave] = $v;
            }
            return $salida;
        }

        if (is_object($valor)) {
            $salida = new stdClass();
            foreach ($valor as $clave => $v) {
                $clave = self::$mapa[strtolower($clave)] ?? $clave;
                $salida->$clave = $v;
            }
            return $salida;
        }

        return $valor; // escalares (FETCH_COLUMN, COUNT, ...)
    }

    #[\ReturnTypeWillChange]
    public function fetch(
        int $mode = PDO::FETCH_DEFAULT,
        int $cursorOrientation = PDO::FETCH_ORI_NEXT,
        int $cursorOffset = 0
    ) {
        return $this->remapear(parent::fetch($mode, $cursorOrientation, $cursorOffset));
    }

    #[\ReturnTypeWillChange]
    public function fetchAll(int $mode = PDO::FETCH_DEFAULT, ...$args): array
    {
        $filas = parent::fetchAll($mode, ...$args);
        if (is_array($filas)) {
            foreach ($filas as $i => $fila) {
                $filas[$i] = $this->remapear($fila);
            }
        }
        return $filas;
    }

    /**
     * Cuando una vista recorre el statement directamente
     * (foreach ($stmt as $fila)), PDO usa un iterador interno en C que NO
     * pasa por fetch(). Sobrescribimos getIterator() para que ese recorrido
     * también obtenga las claves remapeadas en camelCase.
     */
    public function getIterator(): Iterator
    {
        return new ArrayIterator($this->fetchAll());
    }
}

/**
 * Conexión PDO configurable por variables de entorno.
 *
 * Por defecto apunta a PostgreSQL (Supabase). Para desarrollo local con
 * MySQL basta con definir DB_CONNECTION=mysql en el entorno o en .env.
 *
 * Variables soportadas:
 *   DB_CONNECTION  pgsql | mysql        (def. pgsql)
 *   DB_HOST        host de la BD        (def. localhost)
 *   DB_PORT        puerto               (def. 5432 / 3306 según driver)
 *   DB_NAME        nombre de la BD      (def. postgres / InstitutoIdiomas)
 *   DB_USER        usuario              (def. postgres / root)
 *   DB_PASSWORD    contraseña           (def. "")
 *   DB_SSLMODE     sslmode de Postgres  (def. require) -> Supabase lo exige
 */
class Conexion
{
    private $dsn;
    private $username;
    private $password;
    private $options;
    private $driver;
    private static $instancia = null;

    public function __construct(
        ?string $host = null,
        ?string $dbname = null,
        ?string $username = null,
        ?string $password = null
    ) {
        self::cargarDotEnv();
        $this->driver = self::env('DB_CONNECTION', 'pgsql');

        $defPort = $this->driver === 'mysql' ? '3306' : '5432';
        $defName = $this->driver === 'mysql' ? 'InstitutoIdiomas' : 'postgres';
        $defUser = $this->driver === 'mysql' ? 'root' : 'postgres';

        $host     = $host     ?? self::env('DB_HOST', 'localhost');
        $port     =             self::env('DB_PORT', $defPort);
        $dbname   = $dbname   ?? self::env('DB_NAME', $defName);
        $username = $username ?? self::env('DB_USER', $defUser);
        $password = $password ?? self::env('DB_PASSWORD', '');

        if ($this->driver === 'mysql') {
            $this->dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";
        } else {
            $sslmode = self::env('DB_SSLMODE', 'require');
            $this->dsn = "pgsql:host={$host};port={$port};dbname={$dbname};sslmode={$sslmode}";
        }

        $this->username = $username;
        $this->password = $password;
        $this->options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_STATEMENT_CLASS    => [CamelCaseStatement::class, []],
            // Emular prepares: hace seguro el pooler de transacciones de
            // Supabase (puerto 6543) y permite reutilizar un mismo
            // parámetro con nombre varias veces en una consulta.
            PDO::ATTR_EMULATE_PREPARES   => true,
        ];

        if (empty(CamelCaseStatement::$mapa)) {
            CamelCaseStatement::$mapa = self::construirMapa();
        }
    }

    public function iniciar(): ?PDO
    {
        try {
            if (self::$instancia === null) {
                self::$instancia = new PDO(
                    $this->dsn,
                    $this->username,
                    $this->password,
                    $this->options
                );
            }
            return self::$instancia;
        } catch (PDOException $e) {
            throw new Exception("Error en la conexión a la base de datos: " . $e->getMessage());
        }
    }

    /**
     * Carga un archivo .env de la raíz del proyecto (si existe) hacia el
     * entorno. Sin dependencias externas. En Render NO hace falta: las
     * variables se definen en el dashboard y ya están en getenv().
     */
    private static function cargarDotEnv(): void
    {
        static $cargado = false;
        if ($cargado) {
            return;
        }
        $cargado = true;

        $ruta = __DIR__ . '/../.env';
        if (!is_readable($ruta)) {
            return;
        }

        foreach (file($ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $linea) {
            $linea = trim($linea);
            if ($linea === '' || $linea[0] === '#' || strpos($linea, '=') === false) {
                continue;
            }
            [$clave, $valor] = explode('=', $linea, 2);
            $clave = trim($clave);
            $valor = trim($valor);
            // quita comillas envolventes opcionales
            if (strlen($valor) >= 2 && ($valor[0] === '"' || $valor[0] === "'")) {
                $valor = substr($valor, 1, -1);
            }
            if (getenv($clave) === false) {
                putenv("{$clave}={$valor}");
                $_ENV[$clave] = $valor;
            }
        }
    }

    /** Lee una variable de entorno (getenv o $_ENV/$_SERVER). */
    private static function env(string $clave, string $defecto): string
    {
        $valor = getenv($clave);
        if ($valor === false || $valor === '') {
            $valor = $_ENV[$clave] ?? $_SERVER[$clave] ?? $defecto;
        }
        return (string) $valor;
    }

    /** Mapa minúsculas => camelCase de columnas y alias del proyecto. */
    private static function construirMapa(): array
    {
        $camel = [
            'idUsuario', 'codigoDocente', 'codigoEstudiante',
            'idNivel', 'idIdioma', 'idAula', 'idCurso', 'cupoMaximo',
            'fechaInicio', 'fechaFin', 'idHorario', 'diaSemana',
            'horaInicio', 'horaFin', 'idCursoHorario', 'idMatricula',
            'fechaMatricula', 'idAsistencia',
            // alias usados en consultas
            'nombreDocente', 'apellidoDocente',
            'docenteNombres', 'docenteApellidos',
        ];
        $mapa = [];
        foreach ($camel as $c) {
            $mapa[strtolower($c)] = $c;
        }
        return $mapa;
    }
}
