<?php

namespace App\Services\App;

use App\Models\User;

class Cart
{
    protected $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
