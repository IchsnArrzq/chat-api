<?php

namespace App\Contracts;

interface ServiceContract
{
    public function rules(): array;
    public function execute(array $data);
}
