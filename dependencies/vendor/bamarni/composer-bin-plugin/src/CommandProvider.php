<?php

namespace Spatie\WordPressRay\Bamarni\Composer\Bin;

use Spatie\WordPressRay\Composer\Plugin\Capability\CommandProvider as CommandProviderCapability;
class CommandProvider implements CommandProviderCapability
{
    /**
     * {@inheritDoc}
     */
    public function getCommands()
    {
        return [new BinCommand()];
    }
}
