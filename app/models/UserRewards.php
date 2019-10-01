<?php

use Phalcon\Mvc\Model;

class UserRewards extends Model
{
    public $id;
    public $id_user;
    public $reward_amount_min;
    public $reward_amount_max;
    public $reward_amount_get;
}
