<?php

namespace App\Repositories;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

final class TreeRepositories
{
    public static function getData()
    {
        $parents = User::with(['children.children.children.children','department'])->where('deep',0)
            ->orderBy('position')
            ->get()
            ->toArray();

        return static::addDeep($parents);
    }

    private static function addDeep($parents){

        $data = [];
        foreach ($parents as $key => $parent)
        {
            $data[$key] = [
                'id'    => $parent['id'],
                'text'  => is_array($parent['department']) ?$parent['full_name'] . ' - ' . $parent['department']['name'] : $parent['full_name'],
                'state' => [
                    'opened' => false
                ],
            ];
            if(!empty($parent['children'])){
                $data[$key]['children'] = static::addDeep($parent['children']);
            }
        }
        return $data;
    }

    public static function updatePosition(Request $request)
    {
        $parent = User::find($request->new_parent);
        if ($parent->deep < User::DEEP-1)
        {
            foreach ($request->new_positions as $key => $new_position)
            {
                User::where('id', $new_position)->update(['position' => $key, 'deep' => $parent->deep + 1]);
            }
            if ($request->old_parent != $request->new_parent)
            {
                User::where('id', $request->id)->update(['parent_id' => $request->new_parent]);
                foreach ($request->old_positions as $key => $old_position)
                {
                    User::where('id', $old_position)->update(['position' => $key]);
                }
            }
            return true;
        }
            return false;
    }

    public static function createUpdate(UserRequest $request)
    {
        if (!empty($request->id))
        {
            $user = User::find($request->id);
        }
        else
        {
            $user = new User();
        }
        if ($request->hasFile('image'))
        {
            $imgName = Storage::disk('public')->put('/users/avatar', $request->file('image'));
            $user->avatar = $imgName??null;
        }

        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->parent_id = $request->parent_Id ?? 0;
        $user->position = $user->deep = 0;
        $user->salary = $request->salary;
        $user->department_id = $request->department_id;
        $user->hiring_time = $request->hiring_time;
        $user->password = Hash::make($request->password);
        if ($user->save())
        {
            return true;
        }
        return false;

    }
}
