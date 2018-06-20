<?php

namespace app\common\validate;

use think\Validate;

class Order extends Validate
{
    protected $rule = [
        'trip_time' => 'isTrip',
    ];
    protected $message = [
        'trip_time.isTrip' => '入园时间请至少提前一天！',
    ];

    public function isTrip($value)
    {
        if (date('Y-m-d') >= $value) {
            //if (time() > strtotime(date('Y-m-d') . '8:30:01')) return false;
        }
        //if (strtotime($value) < strtotime(date('Y-m-d')) + 3600*24) return false;
        return true;
    }

}