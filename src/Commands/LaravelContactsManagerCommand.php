<?php

namespace Sellinnate\LaravelContactsManager\Commands;

use Illuminate\Console\Command;

class LaravelContactsManagerCommand extends Command
{
    public $signature = 'laravel-contacts-manager';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
