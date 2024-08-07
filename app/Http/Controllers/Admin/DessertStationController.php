<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\BaseController;
use App\Models\DessertStation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class DessertStationController extends BaseController
{
    public function index($user_id)
    {
        $lang = request()->header('Accept-Language') ?? 'en';
        $data = DessertStation::query()
            ->where('user_id', $user_id)
            ->get();
        $data_count = DessertStation::query()
            ->where('user_id', $user_id)
            ->count();

        return response()->json([
            'status' => 200,
            'message' => $lang == 'ar' ? 'تمت العملية بنجاح': 'Success',
            'success' => true,
            'data' => $data,
            'data_count' => $data_count,
        ]);
    }
    public function show($id)
    {
        $lang = request()->header('Accept-Language') ?? 'en';
        $station = DessertStation::query()->where('id',$id)->where('user_id', auth()->id())->first();
        if (!$station) {
            return response()->json([
                'status' => 403,
                'message' => $lang == 'ar' ? 'ليس لديك صلاحية لمشاهدت نظام التحلية' :'You are not authorized to view this update phase.',
                'success' => false
            ], 403);
        }
        $model = DessertStation::class;
        return parent::showBase($id, $model); // TODO: Change the autogenerated stub
    }

    public function store(Request $request)
    {
        $lang = $request->header('Accept-Language') ?? 'en';
        $dess = DessertStation::query()->where('user_id',$request->user_id)->count();
        $user = User::query()->where('id',$request->user_id)->first();
        if ($user->num_system > $dess){
            $model = DessertStation::class;
            $params = $request->all();
//            $params['user_id'] = $request->user_id;
            $rules = [
                'name'=>'required|string|min:3|max:100',
//                'name_ar'=>'required|string|min:3|max:100',
                'phase'=>'required|numeric|min:1',
            ];
            return parent::storeBase($model, $params, $rules, $lang); // TODO: Change the autogenerated stub
        }else{
            $errors = new MessageBag();
            $errors->add('Error', __('The data is wrong'));
            return response()->json([
                'status' => 403,
                'error' => $lang == 'ar' ? 'يجب السماح للمستخدم إنشاء نظام آخر' :'Must by user create another resolution model .',
                'success' => false
            ], 403);
        }
    }
    public function destroy($id)
    {
        $lang = request()->header('Accept-Language') ?? 'en';
        $station = DessertStation::query()->where('id',$id)->where('user_id', intval(request()->input('user_id')))->first();
        if (!$station) {
            return response()->json([
                'status' => 403,
                'message' => $lang == 'ar' ? 'ليس لديك صلاحية لحذف هذا النظام' :'You are not authorized to delete this update phase.',
                'success' => false
            ], 403);
        }
        $model = DessertStation::class;
        return parent::destroyBase($id, $model,$lang); // TODO: Change the autogenerated stub
    }
}
