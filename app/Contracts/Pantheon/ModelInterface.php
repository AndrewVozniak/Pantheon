<?php

namespace App\Contracts\Pantheon;

interface ModelInterface
{
    public function all();

    public function find($id);

    public function create($data);

    public function update($id, $data);

    public function delete($id);
}