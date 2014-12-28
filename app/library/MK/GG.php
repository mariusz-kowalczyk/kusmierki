<?php

namespace MK;

class GG {
    
    private $GGAPI;
    
    public function __construct() {
        $client_id = \Config::get('app.gg.client_id');
        $client_secret = \Config::get('app.gg.client_secret');
        $user_id = '51615248';
        $M = new \GG\MessageBuilder();
        $M->addText('Zapraszam na http://boty.gg.pl/');
        $M->setRecipients(array(51615248)); // lista odbiorców
        $P = new \GG\PushConnection(13801899, 'm.kowalczyk44446@gmail.com', 'NWN1YBn4Bqr9wmGL'); // autoryzacja
        $s = $P->push($M); // wysłanie wiadomości do odbiorców
        var_dump($s);
        
        echo '<br/>***********<br/>';
        
        try{
            $gg = new \GGAPI('31329a781d3711bb5073c44e7f5ed792', '19f62e9512575c8071ab6adf6640e15c');

            // przykładowe zainicjowanie sesji PHP (aplikacja może nadpisać
            // poniższą metodę własną logiką sesji!)
            $gg->initSession();

            // pobranie informacji o użytkowniku
            //$profile = $gg->getProfile();
            //var_dump($profile);
            
            $notify = $gg->sendNotification(
                    'Wstawaj, już 9:00',
                    '/index.php?user_id='.$user_id.'&from=nofity',
                    true,
                    time() + 3600
            );

        }catch(GGAPIException $e){
            die($e);
        }
    }
    
    public static function test() {
        $gg = new GG();
    }
}

