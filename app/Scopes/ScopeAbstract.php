<?php

namespace App\Scopes;

abstract class ScopeAbstract
{
    abstract public function scope($repository, $value);
}
