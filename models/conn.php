<?php

class Connection {
    const DBACTION_INSERT = "INSERT INTO";
    const DBACTION_UPDATE = "UPDATE";
    const DBACTION_DELETE = "DELETE";
    const DBACTION_SELECT = "SELECT";

    const DBMODIFIER_IN = "IN";

    const DBSEARCH_START = "start";
    const DBSEARCH_END = "end";
    const DBSEARCH_BOTH = "both";

    const DBORDER_ASC = "ASC";
    const DBORDER_DESC = "DESC";

    /**
     * Trata de conectarse a la base de datos $dbname con las credenciales $user como usuario y $password como contraseña
     * @param string $dbname
     * @param string $user
     * @param string $password
     * @return PDO|bool
     */
    public static function connectToDB($host, $dbname, $user, $password) : PDO|bool {
        try {
            $dsn = "mysql:host=".$host.";dbname=".$dbname;
            $dbConn = new PDO($dsn, $user, $password);
            return $dbConn;
        } catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public static function doInsert($dbConn, $table, $data)
    {
        return self::executeSql($dbConn, self::DBACTION_INSERT, $table, $data);
    }

    public static function doUpdate($dbConn, $table, $data, $conditions = [])
    {
        return self::executeSql($dbConn, self::DBACTION_UPDATE, $table, $data, $conditions);
    }

    public static function doDelete($dbConn, $table, $conditions = [])
    {
        return self::executeSql($dbConn, self::DBACTION_DELETE, $table, [], $conditions);
    }

    public static function doSelect($dbConn, $table, $conditions = []) : array
    {
        return self::executeSql($dbConn, self::DBACTION_SELECT, $table, [], $conditions)->fetchAll(PDO::FETCH_ASSOC);
    }

    private static function executeSql($dbConn, $action, $table, $data, $conditions = []) : PDOStatement
    {
        try {
            $sql = self::generateSql($action, $table, $data, $conditions);
            $stmt = $dbConn->prepare($sql);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            foreach ($conditions as $key => $value) {
                if(is_array($value)){
                    $stmt->bindValue(":".$value['param'], $value['value']);
                }else{
                    $stmt->bindValue(":$key", $value);
                }
                
            }

            if ($stmt->execute()) {
                return ($action === self::DBACTION_SELECT) ? $stmt : $stmt->rowCount();
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    private static function generateSql($action, $table, $data, $conditions)
    {
        switch ($action) {
            case self::DBACTION_INSERT:
                $columns = implode(", ", array_keys($data));
                $values = ":" . implode(", :", array_keys($data));
                return self::DBACTION_INSERT . " `$table` ($columns) VALUES ($values)";
            case self::DBACTION_UPDATE:
                $setClause = self::generateSetClause($data);
                $conditionClause = self::generateConditionClause($conditions);
                return self::DBACTION_UPDATE . " `$table` SET $setClause $conditionClause";
            case self::DBACTION_DELETE:
                $conditionClause = self::generateConditionClause($conditions);
                return self::DBACTION_DELETE . " FROM `$table` $conditionClause";
            case self::DBACTION_SELECT:
                $conditionClause = self::generateConditionClause($conditions);
                return self::DBACTION_SELECT . " * FROM `$table` $conditionClause";
            default:
                throw new Exception("Acción no válida");
        }
    }

    private static function generateSetClause($data)
    {
        $setClauses = [];
        foreach ($data as $column => $value) {
            $setClauses[] = "$column = :$column";
        }

        return implode(", ", $setClauses);
    }

    private static function generateConditionClause($conditions)
    {
        if (empty($conditions)) {
            return "";
        }

        $conditionClauses = [];
        foreach ($conditions as $column => $value) {
            if (is_array($value) && isset($value['modifier']) && $value['modifier'] === self::DBMODIFIER_IN) {
                $inValues = implode(',', array_fill(0, count($value['value']), '?'));
                $conditionClauses[] = "$column IN ($inValues)";
            } else {
                $conditionClauses[] = "$column = :$column";
            }
        }

        return "WHERE " . implode(" AND ", $conditionClauses);
    }

    /**
     * Realizar una búsqueda en una tabla mediante SQL con soporte de paginación y ordenación.
     * @param PDO $dbConn Conexión PDO a la base de datos.
     * @param string $table Tabla en la que hacer la búsqueda
     * @param string $query Patrón de búsqueda
     * @param string $searchColumn Columna en la que buscar
     * @param string $option Opciones: DBSEARCH_START, DBSEARCH_END, DBSEARCH_BOTH, de forma predeterminada es DBSEARCH_END. (Opcional)
     * @param array $conditions Array asociativo de condiciones. (Opcional)
     * @param int $perPage Número de resultados por página. (Opcional)
     * @param int $page Número de página a recuperar. (Opcional)
     * @param array $orderBy Array de ordenación. Cada elemento debe tener "column" y "method" (DBORDER_ASC o DBORDER_DESC). (Opcional)
     * @return PDOStatement Resultado de la búsqueda
     * 
     * Ejemplo:
     * $query = 'john';
     * $orderBy = [
     *     ["column" => "nombre_columna", "method" => DBORDER_ASC]
     * ];
     * $resultados = searchInTable($dbConn, 'usuarios', $query, 'usuario', DBSEARCH_END, [], 10, 1, $orderBy);
     */
    public static function searchInTable($dbConn, $table, $query, $searchColumn, $option = self::DBSEARCH_END, $conditions = [], $perPage = null, $page = null, $orderBy = [])
    {
        $sql = "SELECT * FROM $table";

        if (!empty($query)) {
            $sql .= " WHERE ";

            if (count($conditions) > 0) {
                $conditionsSql = [];
                foreach ($conditions as $field => $value) {
                    $conditionsSql[] = "$field = :$field";
                }
                $sql .= implode(' AND ', $conditionsSql);
                $sql .= ' AND ';
            }

            $sql .= "$searchColumn LIKE :query";
        }

        // Agregar soporte para ordenar
        if (!empty($orderBy)) {
            $orderBySql = [];
            foreach ($orderBy as $order) {
                $column = $order['column'];
                $method = $order['method'];
                $orderBySql[] = "$column $method";
            }
            $sql .= " ORDER BY " . implode(', ', $orderBySql);
        }

        // Agregar soporte para paginación
        if ($perPage !== null && $page !== null) {
            $offset = ($page - 1) * $perPage;
            $sql .= " LIMIT :per_page OFFSET :offset";
        }

        $stmt = $dbConn->prepare($sql);

        foreach ($conditions as $field => $value) {
            $stmt->bindParam(":$field", $value);
        }

        if (!empty($query)) {
            switch ($option) {
                case DBSEARCH_START:
                    $query = "%$query";
                    break;
                case DBSEARCH_END:
                    $query = "$query%";
                    break;
                case DBSEARCH_BOTH:
                    $query = "%$query%";
                    break;
                default:
                    throw new InvalidArgumentException('Opción de búsqueda no válida');
            }

            $stmt->bindParam(':query', $query);
        }

        // Enlazar parámetros de ordenación
        foreach ($orderBy as $order) {
            $column = $order['column'];
            $stmt->bindParam(":$column", $column);
        }

        // Enlazar parámetros de paginación
        if ($perPage !== null && $page !== null) {
            $stmt->bindParam(':per_page', $perPage, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        }

        $stmt->execute();

        return $stmt;
    }
}

?>