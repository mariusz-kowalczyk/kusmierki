<?php

namespace MK;

class GG {
    
    private $GGAPI;
    
    public function __construct() {
        $client_id = \Config::get('app.gg.client_id');
        $client_secret = \Config::get('app.gg.client_secret');
        $user_id = '13801899';
        $M = new \GG\MessageBuilder();
        $M->addText('Zapraszam na http://boty.gg.pl/');
        $M->setRecipients(array(13801899)); // lista odbiorców
        $P = new \GG\PushConnection(13801899, 'm.kowalczyk44446@gmail.com', 'NWN1YBn4Bqr9wmGL'); // autoryzacja
        $s = $P->push($M); // wysłanie wiadomości do odbiorców
        var_dump($s);
    }
    
    public static function test() {
        $gg = new GG();
    }
}

