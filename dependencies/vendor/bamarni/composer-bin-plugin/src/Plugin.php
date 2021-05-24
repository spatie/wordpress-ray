<?php

namespace Spatie\WordPressRay\Bamarni\Composer\Bin;

use Spatie\WordPressRay\Composer\Composer;
use Spatie\WordPressRay\Composer\IO\IOInterface;
use Spatie\WordPressRay\Composer\Plugin\PluginInterface;
use Spatie\WordPressRay\Composer\Plugin\Capable;
class Plugin implements PluginInterface, Capable
{
    /**
     * {@inheritDoc}
     */
    public function activate(Composer $composer, IOInterface $io)
    {
    }
    /**
     * {@inheritDoc}
     */
    public function getCapabilities()
    {
        return ['Spatie\\WordPressRay\\Composer\\Plugin\\Capability\\CommandProvider' => 'Spatie\\WordPressRay\\Bamarni\\Composer\\Bin\\CommandProvider'];
    }
    /**
     * {@inheritDoc}
     */
    public function deactivate(Composer $composer, IOInterface $io)
    {
    }
    /**
     * {@inheritDoc}
     */
    public function uninstall(Composer $composer, IOInterface $io)
    {
    }
}
