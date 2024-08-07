<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class BaseController extends Controller
{
    public function indexBase($view , $parameters)
    {
        return view($view,compact('parameters'));
    }
    public function getAllData($model , array $relation ,string $direction, int $page)
    {
        $data = $model::query()->with($relation)->orderBy('id', $direction)->simplePaginate($page);
        $data_count = $model::query()->count();
        return response()->json([
            'data' => $data,
            'data_count' => $data_count
        ]);
    }
    public function storeBase($model , array $params, array $rules , $lang)
    {
        $validator = Validator::make($params, $rules);

        if ($validator->fails()) {
            $response = [
                'status' => 400,
                'success' => false,
                'message' => $validator->errors(),
            ];
            return response()->json($response, 400);
        }
        foreach ($params as $key => $param){
            if ($key == 'image'){
                // Handle image Create
                if (isset($params['image'])) {
                    $file = $params['image'];
                    $params['image'] = $file->store('images', 'public');
                }
            }elseif ($key == 'password'){
                $params['password'] = Hash::make($params['password']);
            }
        }
        $data = $model::create($params);
        if (isset($params['station_id'])){
            $data_count = $model::query()->where('station_id',$params['station_id'])->count();
        }
        elseif (isset($params['user_id'])){
            $data_count = $model::query()->where('user_id',$params['user_id'])->count();
        }else{
            $data_count = $model::query()->count();
        }
        return response()->json([
            'status' => 200,
            'message' => $lang == 'ar' ? 'تم إنشاء البيانات بنجاح' :'Data Created',
            'success' => true,
            'data' => $data,
            'data_count' => $data_count,
        ]);
    }
    public function showBase($id , $model)
    {
        $date = $model::find($id);
        return response()->json($date);
    }
    public function updateBase($id ,$model ,array $params, array $rules , $lang){
        $validator = Validator::make($params, $rules);

        if ($validator->fails()) {
            $response = [
                'status' => 400,
                'success' => false,
                'message' => $validator->errors(),
            ];
            return response()->json($response, 400);
        }
        $find = $model::find($id);
        if (array_key_exists('image', $params)){
            $old_image = false;
            // Handle image update
            if (isset($params['image'])) {
                $file = $params['image'];
                $params['image'] = $file->store('images', 'public');
                // Delete old image if exists
                $old_image = $find->image;
                if ($old_image) {
                    Storage::disk('public')->delete($old_image);
                }
            }else{
                $params['image'] = $find->image;
            }
        }
        if (array_key_exists('password', $params)){
            // Update the password only if provided
            if (isset($params['password'])) {
                $params['password'] = Hash::make($params['password']);
            }else {
                unset($params['password']);
            }
        }
        $find->update($params);
        return response()->json([
            'status' => 200,
            'message' => $lang == 'ar' ? 'تم تحديث بنجاح' : 'Data updated',
            'success' => true,
            'data' => $find,
        ]);

    }
    public function destroyBase($id , $model ,$lang)
    {

        try {
            $find = $model::find($id);
            $find->delete();
            return response()->json([
                'status' => 200,
                'message' => $lang == 'ar' ? 'تم الحذف بنجاح' : 'Data deleted',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $lang == 'ar' ? 'خطأ' : 'Error',
                'success' => false,
            ]);
        }
    }
}
