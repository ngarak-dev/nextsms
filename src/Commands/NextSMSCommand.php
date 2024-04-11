<?php

namespace NgarakDev\NextSMS\Commands;

use Illuminate\Console\Command;

class NextSMSCommand extends Command
{
    public $signature = 'nextsms';

    public $description = 'NextSMS Command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
