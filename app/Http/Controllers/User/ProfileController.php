<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Base\BaseController;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends BaseController
{
    public function show()
    {
        $lang = request()->header('Accept-Language') ?? 'en';
        $station = User::query()->where('id',auth()->id())->first();
        if (!$station) {
            return response()->json([
                'status' => 403,
                'message' => $lang == 'ar' ? 'يرجى تسجيل الدخول' : 'You are not authorized',
                'success' => false
            ], 403);
        }
        $model = User::class;
        return parent::showBase(auth()->id(),$model); // Pass the $id & $model  variable to the parent method

    }
    public function update(){
        $lang = request()->header('Accept-Language') ?? 'en';
        $model = User::class;
        $id = auth()->id();
        $user = User::query()->where('id',auth()->id())->first();
        $params = \request()->all();
        $params['num_system'] = $user->num_system;
        $rules = [
            'name' => 'required|string|min:3|max:50' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:1',
            'phone' => 'nullable|numeric|unique:users,phone,'. $id,
            'image' => 'nullable|image',
            'lang' => 'nullable|in:en,ar',
        ];

        return parent::updateBase($id,$model,$params,$rules,$lang); // Pass the $id , $model , $params & $rules  variable to the parent method

    }
}
