<?php

use Phalcon\Mvc\Controller;

class IndexController extends ControllerBase
{

    public function indexAction()
    {   
        // Render Redeem Form via /forms/RedeemForm.php
        $this->view->form = new RedeemForm;
    }

    public function redeemAction()
    {
         if ($this->request->isPost() != true) {
            return $this->dispatcher->forward(
                [
                    "controller" => "index",
                    "action"     => "index",
                ]
            );
        }

        $data = $this->request->getPost();

        $form = new RedeemForm;

        if (!$form->isValid($data)) { // Validate the Redeem Form
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "index",
                    "action"     => "index",
                ]
            );
        }

        $userid = $this->request->getPost('userid');
        $reward_code = $this->request->getPost('reward_code');

        // Check the user availability
        $user = Users::findFirst(
            [
                "phone_number = :phone:",
                "bind" => [
                    'phone' => $userid
                ]
            ]
        );

        if(!$user){
            $this->flash->error("User ID/Phone Number is not registered.");

            return $this->dispatcher->forward(
                [
                    "controller" => "index",
                    "action"     => "index",
                ]
            );
        }

        // Check the reward availability
        $reward = DailyRewards::findFirst(
            [
                "reward_code = :reward_code: AND date_expired >= '".date('Y-m-d H:i:s')."'",
                "bind" => [
                    'reward_code' => $reward_code
                ]
            ]
        );


        if(!$reward){
            $this->flash->error("Reward is not registered, or has been expired.");

            return $this->dispatcher->forward(
                [
                    "controller" => "index",
                    "action"     => "index",
                ]
            );
        }

        
        // Check the user min and max reward
        $user_reward = UserRewards::findFirst(
            [
                "id_user = :id_user: AND id_reward = :id_reward:",
                "bind" => [
                    'id_user' => $user->id,
                    'id_reward' => $reward->id,
                    
                ]
            ]
        );  

        if(!$user_reward){
            $this->flash->error("You cannot use the reward.");

            return $this->dispatcher->forward(
                [
                    "controller" => "index",
                    "action"     => "index",
                ]
            );
        }

        // Check reward history
        $reward_history = DailyRewardHistory::findFirst(
            [
                "id_user = :id_user: AND id_reward = :id_reward:",
                "bind" => [
                    'id_reward' => $reward->id,
                    'id_user' => $user->id,
                ]
            ]
        );

        // IF no reward history we save to reward history
        if(!$reward_history){

            // GET reward total from reward history
            $reward_total = DailyRewardHistory::sum(
                [
                    'column' => 'amount',
                    'group' => 'id_reward',
                    'conditions' => "id_reward = {$reward->id}",
                ]
            );
            
            $reward_total =  (count($reward_total) > 0) ? $reward_total[0]->sumatory : 0;
               
           
            // CHECK IF daily reward is limit or no 
            if($reward_total >= $reward->reward_limit)
            {
                 $this->flash->error("Oh no, We're sorry, the reward code has been fully use.");

                return $this->dispatcher->forward(
                    [
                        "controller" => "index",
                        "action"     => "index",
                    ]
                );
            } 

            $residual = $reward->reward_limit - $reward_total;

            $rand = rand($user_reward->reward_amount_min, $user_reward->reward_amount_max);
            $round = (strlen($rand)-1)*-1;
            $reward_amount_get = round($rand, $round);

            $amount = ($reward_amount_get <= $residual) ? $reward_amount_get : $residual;

            $reward_history = new DailyRewardHistory();
            $reward_history->id_user = $user->id;
            $reward_history->id_reward = $reward->id;
            $reward_history->amount = $amount;
               
            if ($reward_history->create() === false) {
                $messages = $reward_history->getMessages();
                print_r($messages);
                exit;
            } 
                
            //UPDATE user reward amount
            $user_reward->reward_amount_get = $amount;
            $user_reward->save();    

            $this->flash->success("Yeaa!!. you get ".$amount.". Please redeem and enjoy your reward.");

            return $this->dispatcher->forward(
                [
                    "controller" => "index",
                    "action"     => "index",
                ]
            );

        }
        else{ // IF user have used the reward
            $this->flash->error("Sorry. You have used the reward.");

            return $this->dispatcher->forward(
                [
                    "controller" => "index",
                    "action"     => "index",
                ]
            );
        }

    }
}
