<?php

namespace App\Http\Controllers\Departments;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Repositories\DepartmentRepositories;
use App\Repositories\ShowRepositories;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class DepartmentController extends Controller
{
    private $repository;

    function __construct(DepartmentRepositories $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view('departments.index');
    }

    public function getTableData(Request $request)
    {
        return $this->repository->getTableData($request);
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(DepartmentRequest $request)
    {
        $this->repository->save($request);
        return redirect(route('departments.index'));

    }

    public function edit($id)
    {
        $department = Department::find($id);
        return view('departments.edit',compact('department'));
    }

    public function update(Request $request)
    {
        $this->repository->save($request);
        return redirect(route('departments.index'));
    }

    public function destroy($id)
    {
        Department::destroy($id);
        return redirect()->back();
    }


}
