<?php

namespace App\Models\Admin;

use App\Http\Controllers\Wallet\WalletController;
use App\Models\GameHistory;
use App\Models\MemberLevel;
use App\Models\PromotionDiscount;
use Illuminate\Database\Eloquent\Model;

class PromoRuleConfig extends Model
{
    protected $primaryKey = 'promotion_id';

    protected $keyType = 'string';

    public $timestamps = false;

    /**
     * The database connection
     *
     * @var string
     */
    protected $connection = 'db29betadmin';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'promo_rule_config';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['promo_rule_id', 'promotion_id', 'condition_field_id', 'calculation_way_id', 'promo_code_id', 'member_level_id', 'calculation_result', 'calculation_result_timeinterval', 'discount_amount_value', 'date_created', 'range_from', 'range_to', 'no_of_days'];

    public function settings() {
        return PromoSettings::find($this->promotion_id);
    }

    public function validate($amount, $uid) {
        if ($this->condition_field_id == 1) return $this->checkMemberLevel($uid);
        elseif ($this->condition_field_id == 21) return $this->getCalculation($this->validateBets($uid));
        elseif ($this->condition_field_id == 22) return $this->getCalculation($amount);
        elseif ($this->condition_field_id == 23) return false;
        elseif ($this->condition_field_id == 24) return $this->getCalculation($this->validateWinsBets($uid));
        elseif ($this->condition_field_id == 25) return false;
        else return false;
    }

    private function getCalculation($amount) {
        if ($this->calculation_way_id == 1) return $amount == $this->calculation_result;
        elseif ($this->calculation_way_id == 2) return $amount > $this->calculation_result;
        elseif ($this->calculation_way_id == 3) return $amount >= $this->calculation_result;
        elseif ($this->calculation_way_id == 4) return $amount < $this->calculation_result;
        elseif ($this->calculation_way_id == 5) return $amount <= $this->calculation_result;
        else return $this->range_from >= $amount && $amount <= $this->range_to;
    }

    private function validateBets($uid) {
        $game_id = $this->settings()->game;
        $bet_count = GameHistory::where('uid', $uid)
            ->where('game_id', $game_id)
            ->where('date_transacted', '>=', $this->settings()->event_start_time)
            ->where('date_transacted', '<=', $this->settings()->event_end_time)
            ->sum('bet');

        $discount_obtained = PromotionDiscount::where('uid', $uid)
            ->where('promo_code_id', $this->promotion_id)
            ->count();

        return $bet_count - ($discount_obtained * $this->calculation_result);
    }

    private function validateWinsBets($uid) {
        $game_id = $this->settings()->game;

        $win_count = GameHistory::where('uid', $uid)
            ->where('game_id', $game_id)
            ->where('date_transacted', '>=', $this->settings()->event_start_time)
            ->where('date_transacted', '<=', $this->settings()->event_end_time)
            ->sum('amount');

        $bet_count = GameHistory::where('uid', $uid)
            ->where('game_id', $game_id)
            ->where('date_transacted', '>=', $this->settings()->event_start_time)
            ->where('date_transacted', '<=', $this->settings()->event_end_time)
            ->sum('bet');

        $discount_obtained = PromotionDiscount::where('uid', $uid)
            ->where('promo_code_id', $this->promotion_id)
            ->count();

        return ($bet_count + $win_count) - ($discount_obtained * $this->calculation_result);
    }

    private function checkMemberLevel($uid) {
        return MemberLevel::find(WalletController::UserLevel($uid)['level'])->id == $this->member_level_id;
    }
}
