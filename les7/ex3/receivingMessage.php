<?php
require_once('vendor/autoload.php');

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exception\AMQPProtocolChannelException;
use PhpAmqpLib\Message\AMQPMessage;

try {
    $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');

    $channel = $connection->channel();
    $channel->queue_declare('Payment', false, true, false, false);

    $callback = function ($msg) {
        echo ' [x] Received ', $msg->body, "\n";
        echo " [x] Done\n";
    };
    
    $channel->basic_qos(null, 1, null);
    $channel->basic_consume('Payment', '', false, false, false, false, $callback);
    
    $channel->close();
    $connection->close();
} catch (AMQPProtocolChannelException $e){
    echo $e->getMessage();
}
catch (AMQPException $e){
    echo $e->getMessage();
}