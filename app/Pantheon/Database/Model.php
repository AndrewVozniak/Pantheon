<?php

namespace App\Pantheon\Database;

/**
 * Base Model Class for ORM
 */
class Model extends ModelHandlers
{
    protected string $table;
    protected string $primaryKey = 'id';
    protected array $attributes = [];
    protected mixed $db;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $db_type = env('DB_TYPE');
        $host = env('DB_HOST');
        $port = env('DB_PORT');
        $name = env('DB_NAME');
        $user = env('DB_USER');
        $pass = env('DB_PASS');

        $this->db = DB::connect($db_type, $host, $port, $name, $user, $pass);
    }

    /** Find record
     * @param $id
     * @return static
     */
    public static function find($id): static
    {
        $model = new static();
        $sql = "SELECT * FROM {$model->table} WHERE {$model->primaryKey} = :id";
        $stmt = $model->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $result = $stmt->fetch();

        if ($result) {
            $model->attributes = $result;
        }

        return $model;
    }

    /**
     * @return void
     */
    public function save(): void
    {
        if ($this->isNewRecord()) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    /**
     * @return void
     */
    public function delete(): void
    {
        $sql = "DELETE FROM $this->table WHERE $this->primaryKey=?";
        $stmt = self::prepareAndBind($sql, [$this->attributes[$this->primaryKey]]);
        $stmt->execute();
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function __get($key)
    {
        return $this->attributes[$key] ?? null;
    }

    /**
     * @param $key
     * @param $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

}
