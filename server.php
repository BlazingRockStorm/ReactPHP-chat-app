<?php

use React\Socket\ConnectionInterface;

require 'vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();

$server = new \React\Socket\Server('127.0.0.1:8000', $loop);
$server->on('connection', function (ConnectionInterface $connection) {
    echo $connection->getRemoteAddress() . PHP_EOL;
    $connection->on('data', function ($data) use ($connection) {
        $connection->write($data);
    });
});

$loop->run();
