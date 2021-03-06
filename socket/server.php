<?php

require  'vendor/autoload.php';
require 'ConnectionsPool.php';

use React\Socket\ConnectionInterface;

$loop = React\EventLoop\Factory::create();
$socket = new React\Socket\Server('127.0.0.1:8000', $loop);
$pool = new ConnectionsPool();
$socket->on('connection', function(ConnectionInterface $connection) use ($pool){
    $pool->add($connection);
});
echo "Listening on {$socket->getAddress()}\n";
$loop->run();
