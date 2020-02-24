<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

use App\Repositories\ShowRepositories;
use App\User;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    private $repository;

    function __construct(ShowRepositories $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view('users.show_all');
    }

    public function getTableData(Request $request)
    {
        return $this->repository->getTableData($request);
    }

}
