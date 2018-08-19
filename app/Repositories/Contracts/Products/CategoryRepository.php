<?php

namespace App\Repositories\Contracts\Products;

interface CategoryRepository
{
    public function parents();
    public function ordered();
}