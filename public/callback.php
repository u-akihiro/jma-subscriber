<?php

require '../vendor/autoload.php'
use Zend\Db\Adapter\Driver\Pdo\Connection;
use Zend\Db\Adapter\Driver\Pdo\Pdo;
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;
use Zend\Feed\PubSubHubbub\Model\Subscription;
use Zend\Feed\PubSubHubbub\Subscriber\Callback;

$dbh          = new \PDO('sqlite:jma-subscriber.sqlite3');
$connection   = new Connection($dbh);
$driver       = new Pdo($connection);
$adapter      = new Adapter($driver);
$tableGateway = new TableGateway('subscription', $adapter);
$storage      = new Subscription($tableGateway);

$callback = new Callback();
$callback->setStorage($storage);
$callback->handle();
$callback->sentResponse();

if ($callback->hasFeedUpdate()) {
	$feed = $callback->getFeedUpdate();
}
