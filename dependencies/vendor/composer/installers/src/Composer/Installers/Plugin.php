<?php

namespace Spatie\WordPressRay\Composer\Installers;

use Spatie\WordPressRay\Composer\Composer;
use Spatie\WordPressRay\Composer\IO\IOInterface;
use Spatie\WordPressRay\Composer\Plugin\PluginInterface;
class Plugin implements PluginInterface
{
    private $installer;
    public function activate(Composer $composer, IOInterface $io)
    {
        $this->installer = new Installer($io, $composer);
        $composer->getInstallationManager()->addInstaller($this->installer);
    }
    public function deactivate(Composer $composer, IOInterface $io)
    {
        $composer->getInstallationManager()->removeInstaller($this->installer);
    }
    public function uninstall(Composer $composer, IOInterface $io)
    {
    }
}
