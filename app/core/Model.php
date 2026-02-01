<?php

// Main model class

class Model
{
    use Database;
    protected $table = 'booking';
    protected $limit = 10;
    protected $offset = 0;

    public function where($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where";
        foreach ($keys as $key) {
            $query .= $key . " =:" . $key . " && ";
        }
        foreach ($keys_not as $key) {
            $query .= $key . " !=:" . $key . " && ";
        }

        $query = trim($query, " && ");
        $query .= "limit $this->limit offset $this->offset";
        echo $query;
        // $this->query($query, ['id' => 2]);
    }

    public function first($data, $data_not = []) {}

    public function insert($data) {}

    public function update($id, $data, $id_column = 'id')
    {
        $keys = array_keys($data);
        $query = "update $this->table set ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . ", ";
        }

        $query = trim($query, ", ");
        $query .= " where $id_column = :$id_column ";

        $data[$id_column] = $id;
        $this->query($query, $data);
        return false;
    }

    public function delete($id, $id_column = 'id')
    {
        $data[$id_column] = $id;
        $query = "delete from $this->table where $id_column = :$id_column";
        $this->query($query, $data);
        return false;
    }
}
