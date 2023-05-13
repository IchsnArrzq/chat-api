<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    private int $limit = 10;
    private int $page = 10;

    public function __construct()
    {
        $this->middleware(function (Request $request, Closure $next) {
            if ($request->has('page')) {
                $this->setPage($request->get('page'));
            }
            if ($request->has('limit')) {
                $this->setLimit($request->get('limit'));
            }
            return $next($request);
        });
    }

    public function getPage(): int
    {
        return (int) $this->page;
    }
    public function setPage(int $page): self
    {
        $this->page = $page;
        return $this;
    }

    public function getLimit(): int
    {
        return (int) $this->limit;
    }
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }
}
