<?php

require '../vendor/autoload.php';
use Zend\Db\Adapter\Driver\Pdo\Connection;
use Zend\Db\Adapter\Driver\Pdo\Pdo;
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;
use Zend\Feed\PubSubHubbub\Model\Subscription;
use Zend\Feed\PubSubHubbub\Subscriber;

$dbh          = new \PDO('sqlite:jma-subscriber.sqlite3');
$connection   = new Connection($dbh);
$driver       = new Pdo($connection);
$adapter      = new Adapter($driver);
$tableGateway = new TableGateway('subscription', $adapter);
$storage      = new Subscription($tableGateway);

$subscriber = new Subscriber();
$subscriber->setStorage($storage);
$subscriber->addHubUrl('http://alert-hub.appspot.com/subscribe');
$subscriber->setTopicUrl('http://xml.kishou.go.jp/feed/extra.xml');
$subscriber->setcallbackUrl('http://push.ping12ms.com');
$subscriber->subscribeAll();
