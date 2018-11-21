<?php

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Sistema\ClassFinder\ClassFinder;

$namespace = "\\Helpers\\Console\\";
$src = __DIR__ . '/../Helpers/Console/';

$container = \Sistema\Container\Bootstrapper::bootstrap();
$output    = new Symfony\Component\Console\Output\ConsoleOutput();
$app       = new Application('RTD Console', '1.0');

(new ClassFinder( '\\Helpers\\Console\\', __DIR__ . '/../Helpers/Console'))
    ->find()
    ->filter(function (\ReflectionClass $class) {
        return $class->isSubclassOf(\Symfony\Component\Console\Command\Command::class) && !$class->isAbstract();
    })
    ->each(function (\ReflectionClass $class) use ($app, $container) {
        $command = $container->get($class->getName());
        $app->add($command);
    })
;

try {
    $app->run();
} catch (Exception $e) {
    $output->writeln("<error>{$e->getMessage()}</error>");
}
