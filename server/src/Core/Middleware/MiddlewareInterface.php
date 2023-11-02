<?php

namespace Framework\Core\Middleware;

use Framework\Core\Http\Request;

interface MiddlewareInterface
{
    public function handle(Request $request, callable $next);
}