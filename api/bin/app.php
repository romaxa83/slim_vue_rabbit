#!/usr/bin/env php
<?php

declare(strict_types=1);

use Doctrine\DBAL\Migrations\Tools\Console\Helper\ConfigurationHelper;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Console\Application;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

if (file_exists('.env')) {
    (new Dotenv())->load('.env');
}

/**
 * @var \Psr\Container\ContainerInterface $container
 */

$container = require 'config/container.php';

$cli = new Application('Application console');

$entityManager = $container->get(EntityManagerInterface::class);
$connection = $entityManager->getConnection();

$configuration = new Doctrine\DBAL\Migrations\Configuration\Configuration($connection);
//папка в которую сохраняються миграции
$configuration->setMigrationsDirectory('src/Data/Migration');
//namespace для миграции
$configuration->setMigrationsNamespace('Api\Data\Migration');

$cli->getHelperSet()->set(new EntityManagerHelper($entityManager), 'em');
$cli->getHelperSet()->set(new ConfigurationHelper($connection, $configuration), 'configuration');

//добавляем доктриновские консольный команды
Doctrine\ORM\Tools\Console\ConsoleRunner::addCommands($cli);
Doctrine\DBAL\Migrations\Tools\Console\ConsoleRunner::addCommands($cli);

$commands = $container->get('config')['console']['commands'];
foreach ($commands as $command) {
	$cli->add($container->get($command));
}

$cli->run();