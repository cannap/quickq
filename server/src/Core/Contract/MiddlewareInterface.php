<?php

namespace Framework\Core\Contract;

use Framework\Core\Http\Request;

interface MiddlewareInterface
{
    public function handle(Request $request, callable $next);
}