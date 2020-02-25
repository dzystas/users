<?php

namespace App\Repositories;

use App\Models\Department;
use App\User;
use Illuminate\Http\Request;

final class ShowRepositories
{
    public function getTableData(Request $request)
    {
        $sortFieldNumber = $request->order[0]['column'];
        $sortField = $request->columns[$sortFieldNumber]['data'];
        $dirField = $request->order[0]['dir'];

        $query = User::with('department')->orderBy($sortField, $dirField);
        $recordsTotal  = $query->get()->count();

        if (!empty($request['search']['value']))
        {
            $someText = '%'.$request['search']['value'].'%';
            $department_ids = Department::where('name','like',$someText)->pluck('id')->toArray();
            if($department_ids){
                $query->orWhereIn('department_id',$department_ids);
            }
            $query->orWhere('id','like' ,$someText)
                ->orWhere('full_name', 'like' ,$someText)
                ->orWhere('email', 'like' ,$someText)
                ->orWhere('salary', 'like' ,$someText)
                ->orWhere('hiring_time', 'like' ,$someText);
        }
        $recordsFiltered =  $query->get()->count();
        $data['data'] = $query->skip($request->start ?? 0)
            ->limit($request->length ?? 10)
            ->get();
        $data['recordsFiltered'] = $recordsFiltered;
        $data['recordsTotal'] = $recordsTotal;

        return $data;
    }
}
