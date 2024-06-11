<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BenefitsSubType;
use App\Models\TypeOfBenefits;
use Illuminate\Support\Facades\DB;

class ActionType extends Model
{
    
    use HasFactory;
    protected $table = 'action_types';
    public $timestamps = false;

    public function getActionDescription($action_id){

        $query = $this->where('action_id', $action_id)
        ->first();

        return $query['action_description'];
    }
}