<?php

use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder)
{
    $containerBuilder->addDefinitions([
        'templates_path' => __DIR__ . '/../Templates',
    ]);
};