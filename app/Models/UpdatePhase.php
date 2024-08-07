<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UpdatePhase extends Model
{
    use HasFactory,Notifiable;
    protected $fillable = ['last_date','time','next_date','station_id'];
    protected $appends = ['percentage'];

    public function station(){
        return $this->belongsTo(DessertStation::class);
    }
    public function getPercentageAttribute(){
        // Calculate the difference in seconds between last_date and today's date
        $differenceInSeconds = Carbon::now()->diffInHours($this->attributes['last_date'], false);
        // Calculate the total difference between last_date and next_date
        $totalDifferenceInSeconds = Carbon::make($this->attributes['last_date'])->diffInHours(Carbon::make($this->attributes['next_date']), false);
        // Calculate the percentage
        $per = ((intval(round(abs($differenceInSeconds))) / abs($totalDifferenceInSeconds)) * 100);
        return round($per , 2);

    }
}
