<?php

use Phalcon\Mvc\Model;

class DailyRewards extends Model
{
    public $id;
    public $reward_name;
    public $reward_code;
    public $reward_limit;
    public $date_expired;
}
