<?php

namespace App\Models\Extend;

interface ModelInterface
{

    public function toArray();

    public function fill(array $attributes);

    public function save(array $options = []);

    public function delete();
}
