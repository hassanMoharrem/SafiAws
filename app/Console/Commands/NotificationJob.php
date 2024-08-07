<?php

namespace App\Console\Commands;

use App\Models\DessertStation;
use App\Models\UpdatePhase;
use App\Models\User;
use App\Notifications\NewStation;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class NotificationJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notification-job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = UpdatePhase::query()
            ->whereDate('last_date','<', Carbon::now()->addDay()->toDateString())
            ->get();
        foreach ($data as $row){
            $station = DessertStation::query()->where('id',$row->station_id)->first();
            $phase = UpdatePhase::query()->where('station_id',$row->station_id)->first();
            $user = User::query()->find($station->user_id);
            if ($user){
                $user->notify(new NewStation($station,$phase));
            }

        }

    }
}
