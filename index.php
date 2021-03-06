#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/vendor/autoload.php';

use app\commands\RecursiveCommand;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new RecursiveCommand());

$application->run();