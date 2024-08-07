<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Models\DessertStation;
use App\Models\UpdatePhase;
use App\Models\User;


class DashboardController extends BaseController
{
    public function index($view = "default", $parameters = [])
    {
        $view='admin.dashboard';
        $users = User::all();
        $count = User::query()->count();
        $totalSystems = $users->sum('num_system');
        $station = DessertStation::query()->count();
        $phase = UpdatePhase::query()->count();
        $update_phase = UpdatePhase::all();
        $total_phase_percentage = $update_phase->sum('percentage');
        $parameters['count'] = $count;
        $parameters['totalSystems'] = $totalSystems;
        $parameters['station'] = $station;
        $parameters['phase'] = $phase;
        $parameters['total_phase_percentage'] = $total_phase_percentage / $phase;
        return parent::indexBase($view , $parameters); // Pass the $view variable to the parent method

    }

//    public function configurations_index()
//    {
//        $superAdminId = auth('super-admin')->check() ? auth('super-admin')->id() : 0;
//        $adminId = auth('admin')->check() ? auth('admin')->id() : 0;
//        $userId = auth('web')->check() ? auth('web')->id() : 0;
//        return view('admin.configurations.configurations', compact('superAdminId', 'adminId', 'userId'));
//    }
}
