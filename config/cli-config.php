<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 26/01/18
 * Time: 14:33
 */

require __DIR__ . '/../vendor/autoload.php';

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Sistema\Container\Bootstrapper;
use Sistema\Container\Container;

$em = Bootstrapper::bootstrap()->get(EntityManager::class);

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));

$app = new \Symfony\Component\Console\Application('Doctrine Command Line Interface',\Doctrine\ORM\Version::VERSION);

$app->setCatchExceptions(true);
$app->setHelperSet($helperSet);

$app->add(new \Helpers\Console\DoctrineCommand\DoctrineCommand());
///Resgister All Doctrine Commands
ConsoleRunner::addCommands($app);
$output = new Symfony\Component\Console\Output\ConsoleOutput();
return $app->run();