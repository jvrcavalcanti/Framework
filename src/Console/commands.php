<?php

define('BASE_COMMANDS', [
    Pendragon\Framework\Console\Clear\ImagesCommand::class,
    Pendragon\Framework\Console\Config\KeyCommand::class,
    Pendragon\Framework\Console\Interactive::class,
    Pendragon\Framework\Console\Migrate\UpCommand::class,
    Pendragon\Framework\Console\Migrate\RollBackCommand::class,
    Pendragon\Framework\Console\Migrate\RefreshCommand::class,
    Pendragon\Framework\Console\Make\ComponentCommand::class,
    Pendragon\Framework\Console\Make\ModelCommand::class,
    Pendragon\Framework\Console\Make\MigrationCommand::class,
    Pendragon\Framework\Console\Make\ControllerCommand::class,
    Pendragon\Framework\Console\Make\ViewCommand::class,
    Pendragon\Framework\Console\Make\RepositoryCommand::class,
    Pendragon\Framework\Console\Make\ProviderCommand::class,
]);
