<?php

namespace App\Pantheon\Database;

/**
 * Model Handlers
 * @property mixed $attributes
 */
class ModelHandlers
{
    /** Insert data
     * @return void
     */
    protected function insert(): void
    {
        $columns = implode(',', array_keys($this->attributes));
        $values = implode(',', array_fill(0, count($this->attributes), '?'));

        $sql = "INSERT INTO $this->table($columns) VALUES ($values)";
        $stmt = $this->prepareAndBind($sql, array_values($this->attributes));
        $stmt->execute();

        $this->attributes[$this->primaryKey] = $this->getLastInsertId();
    }

    /** Update data
     * @return void
     */
    protected function update(): void
    {
        $columns = implode('=?,', array_keys($this->attributes)) . '=?';
        $values = array_values($this->attributes);
        $values[] = $this->attributes[$this->primaryKey];

        $sql = "UPDATE $this->table SET $columns WHERE $this->primaryKey=?";
        $stmt = $this->prepareAndBind($sql, $values);
        $stmt->execute();
    }

    /** Check is a new record
     * @return bool
     */
    protected function isNewRecord(): bool
    {
        return empty($this->attributes[$this->primaryKey]);
    }

    /** Prepare and bind a SQL statement
     * @param $sql
     * @param $params
     * @return mixed
     */
    protected function prepareAndBind($sql, $params): mixed
    {
        $stmt = $this->db->prepare($sql);

        if ($stmt) {
            foreach ($params as $key => $value) {
                $stmt->bindValue($key + 1, $value);
            }
        }

        return $stmt;
    }

    /** Get Last Insert ID
     * @return mixed
     */
    protected function getLastInsertId(): mixed
    {
        return $this->db->lastInsertId();
    }
}