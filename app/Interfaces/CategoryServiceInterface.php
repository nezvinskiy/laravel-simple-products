<?php

namespace App\Interfaces;

use App\DataTransferObject\CategoryDTO;

interface CategoryServiceInterface
{
    /**
     * @return array|CategoryDTO[]
     */
    public function list(): array;
}
