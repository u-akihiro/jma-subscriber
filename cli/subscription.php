<?php

require '../vendor/autoload.php';
use Zend\Db\Adapter\Driver\Pdo\Connection;
use Zend\Db\Adapter\Driver\Pdo\Pdo;
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;
use Zend\Feed\PubSubHubbub\Model\Subscription;
use Zend\Feed\PubSubHubbub\Subscriber;

$dbh          = new \PDO('sqlite:../data/jma-subscriber.sqlite3');
$connection   = new Connection($dbh);
$driver       = new Pdo($connection);
$adapter      = new Adapter($driver);
$tableGateway = new TableGateway('subscription', $adapter);
$storage      = new Subscription($tableGateway);


echo 'ハブのURL'.PHP_EOL;
$hubUrl      = trim(fgets(STDIN));
echo '購読するフィードのURL'.PHP_EOL;
$topicUrl    = trim(fgets(STDIN));
echo 'PuSHを受けるURL'.PHP_EOL;
$callbackUrl = trim(fgets(STDIN));

$subscriber = new Subscriber();
$subscriber->setStorage($storage);
$subscriber->addHubUrl($hubUrl);
$subscriber->setTopicUrl($topicUrl);
$subscriber->setcallbackUrl($callbackUrl);
$subscriber->subscribeAll();
