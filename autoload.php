<?php

use PatroNet\Core\Autoload\Registrator;
use PatroNet\Core\Autoload\PathAutoloader;

Registrator::register(new PathAutoloader('PatroNet\\OaiPmhServer', __DIR__ . '/PatroNet/OaiPmhServer'));

