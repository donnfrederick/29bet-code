<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsType extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'event_type';

    public function getEventType(){
        return $this->select('event_type')->where('enable_status','=','Yes')->get();
    }
}
