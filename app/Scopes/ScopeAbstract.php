<?php

namespace App\Scopes;

abstract class ScopeAbstract
{
    abstract public function scope($builder, $value);
}
