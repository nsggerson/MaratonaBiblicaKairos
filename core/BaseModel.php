<?php

namespace Core;

use PDO;

abstract class BaseModel
{
    private $pdo;
    protected $table;
    protected $setListOfTables;
    protected $ORDERBY;
    protected $update;



    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /* Selecionar tudo da tabela da model
        #   Controller Setor func internar
        #   Controller Forms func Index
        */
    public function All($param = null)
    {
        if ($param != null) {
            $query = "SELECT $param FROM {$this->table}";
        } else {
            $query = "SELECT * FROM {$this->table}";
        }
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }

    public function find($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        return $result;
    }

    public function findParam(array $param)
    {

        $query = "SELECT * FROM {$this->table} WHERE {$param[0]}  = '{$param[1]}'";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }

    public function proceduremodel($sql)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }

    /* Pegando ultimos valores adicionado pelos usuários
        #  Controller  Setor funct store 
        */

    /* Gravar valor no vanco 
        #   Controller Setor func store
        #   Controller Paciente func store
        */
    public function createNameTable(array $data, $table)
    {
        $data = $this->prepareDataInsert($data);
        $query = "INSERT INTO {$table} ({$data[0]}) VALUES ({$data[1]})";
        $stmt = $this->pdo->prepare($query);
        for ($i = 0; $i < count($data[2]); $i++) {
            $stmt->bindValue("{$data[2][$i]}", $data[3][$i]);
        }
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }

    public function create(array $data)
    {
        $data = $this->prepareDataInsert($data);
        $query = "INSERT INTO {$this->table} ({$data[0]}) VALUES ({$data[1]})";
        $stmt = $this->pdo->prepare($query);
        for ($i = 0; $i < count($data[2]); $i++) {
            $stmt->bindValue("{$data[2][$i]}", $data[3][$i]);
        }
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }
    public function createWithNameTable(array $data, $table)
    {
        $data = $this->prepareDataInsert($data);
        $query = "INSERT INTO {$table} ({$data[0]}) VALUES ({$data[1]})";
        $stmt = $this->pdo->prepare($query);
        for ($i = 0; $i < count($data[2]); $i++) {
            $stmt->bindValue("{$data[2][$i]}", $data[3][$i]);
        }
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }

    public function createByDefiningTableName(array $data, $table)
    {
        $data = $this->prepareDataInsert($data);

        $query = "INSERT INTO {$table} ({$data[0]}) VALUES ({$data[1]})";
        $stmt = $this->pdo->prepare($query);
        for ($i = 0; $i < count($data[2]); $i++) {
            $stmt->bindValue("{$data[2][$i]}", $data[3][$i]);
        }
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }

    private function prepareDataInsert(array $data)
    {
        $strKeys = "";
        $strBinds = "";
        $binds = [];
        $values = [];

        foreach ($data as $key => $value) {
            $strKeys = "{$strKeys},{$key}";
            $strBinds = "{$strBinds},:{$key}";
            $binds[] = ":{$key}";
            $values[] = $value;
        }
        $strKeys = substr($strKeys, 1);
        $strBinds = substr($strBinds, 1);

        return [$strKeys, $strBinds, $binds, $values];
    }

    public function updateParam(array $data,array $param)
    {
        /**
         * param 0= nome da coluna
         * param 1= valor da coluna
         * param 2= nome da tabela
         */
        $data = $this->prepareDataUpdate($data);
        $query = "UPDATE {$param[2]} SET {$data[0]}  WHERE $param[0]=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $param[1]);
        for ($i = 0; $i < count($data[1]); $i++) {
            $stmt->bindValue("{$data[1][$i]}", $data[2][$i]);
        }
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }


    public function update(array $data, $id)
    {
        $data = $this->prepareDataUpdate($data);
        $query = "UPDATE {$this->table} SET {$data[0]}  WHERE id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        for ($i = 0; $i < count($data[1]); $i++) {
            $stmt->bindValue("{$data[1][$i]}", $data[2][$i]);
        }
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }

    private function prepareDataUpdate(array $data)
    {
        $strKeysBinds = "";
        $binds = [];
        $values = [];

        foreach ($data as $key => $value) {
            $strKeysBinds = "{$strKeysBinds},{$key}=:{$key}";
            $binds[] = ":{$key}";
            $values[] = $value;
        }
        $strKeysBinds = substr($strKeysBinds, 1);

        return [$strKeysBinds, $binds, $values];
    }

    public function delete($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }

    public function deleteOfNameTable($table, $id)
    {
        $query = "DELETE FROM {$table} WHERE id=:id";

        $stmt = $this->pdo->prepare($query);

        $stmt->bindValue(":id", $id);
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }
}
