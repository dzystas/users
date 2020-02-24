<?php

namespace App\Repositories;

use App\Http\Requests\UserRequest;
use App\Models\Department;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

final class DepartmentRepositories
{

    public function getTableData(Request $request)
    {
        $sortFieldNumber = $request->order[0]['column'];
        $sortField = $request->columns[$sortFieldNumber]['data'];
        $dirField = $request->order[0]['dir'];

        $query = Department::orderBy($sortField, $dirField);
        $recordsFiltered = $query->get()->count();

        if (!empty($request['search']['value']))
        {
            $someText = '%'.$request['search']['value'].'%';
            $query->orWhere('id','like' ,$someText)
                ->orWhere('name', 'like' ,$someText);
        }
        $recordsTotal =  $query->get()->count();
        $data['data'] = $query->skip($request->start ?? 0)
            ->limit($request->length ?? 10)
            ->get();
        $data['recordsFiltered'] = $recordsFiltered;
        $data['recordsTotal'] = $recordsTotal;

        return $data;
    }

    public function save(Request $request){
        if($request->id){
           $department =  Department::find($request->id);
        }else{
            $department =  new Department();
        }
        $department->name = $request->name;
        $department->save();
    }

}
