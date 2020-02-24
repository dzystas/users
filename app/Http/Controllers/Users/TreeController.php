<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Department;
use App\Repositories\TreeRepositories;
use App\User;
use Illuminate\Http\Request;

class TreeController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('users.tree',compact('departments'));
    }

    public function getData()
    {
        return TreeRepositories::getData();
    }

    public function updatePosition(Request $request)
    {
        if (TreeRepositories::updatePosition($request))
        {
            $success = true;
            $message = 'data saved';
        }
        return response()->json(
            [
                'success' => $success ?? false,
                'message' => $message ?? 'very deep',
            ]
        );
    }

    public function createUpdate(UserRequest $request)
    {
        if (TreeRepositories::createUpdate($request))
        {
            $success = true;
            $message = 'data saved';
        }
        return response()->json([
            'success' => $success ?? false,
            'message' => $message ?? 'data NOT saved',
        ]);

    }

    public function getUser($id)
    {
        return response()->json([
            'user' => User::find($id)->toArray() ?? false
        ]);
    }

    public function destroy(Request $request)
    {
        $items = User::where('parent_id', $request->id)->first();
        if ($items)
        {
            return response()->json([
                'success' => false,
                'message' => 'Cannot be deleted! This employee has subordinates.',
            ]);
        }
        else
        {
            User::find($request->id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Employee fired',
            ]);
        }
    }

}
