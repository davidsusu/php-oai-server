<?php

use PatroNet\Core\Autoload\Registrator;
use PatroNet\Core\Autoload\Psr0Autoloader;

Registrator::register(new Psr0Autoloader('PatroNet\\OaiPmhServer', __DIR__ . '/PatroNet/OaiPmhServer'));

