<?php
namespace App\Lib;
use Pusher\Pusher;

class PusherFactory
{
    public static function make()
    {
        return new Pusher(
            "3c2eb066d5763d84c773", // public key
            "883882abc5606c600edf", // Secret
            "1233061", // App_id
            array(
                'cluster' => "ap1", // Cluster
                'encrypted' => true,
            )
        );
    }
}

?>