<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class RedeemForm extends Form
{
    public function initialize()
    {
        $userid = new Text("userid");
        $userid->setLabel("User ID/Phone Number");
        $userid->setFilters(
            [
                'striptags',
                'string',
            ]
        );
        $userid->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'User ID/Phone Number is required',
                    ]
                ),
            ]
        );

        $this->add($userid);

        $reward_code = new Text("reward_code");
        $reward_code->setLabel("Reward Code");
        $reward_code->setFilters(
            [
                'striptags',
                'string',
            ]
        );
        $reward_code->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'Reward Code is required',
                    ]
                ),
            ]
        );

        $this->add($reward_code);

        
    }
}
