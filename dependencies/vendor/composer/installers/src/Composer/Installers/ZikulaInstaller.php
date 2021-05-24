<?php

namespace Spatie\WordPressRay\Composer\Installers;

class ZikulaInstaller extends BaseInstaller
{
    protected $locations = array('module' => 'modules/{$vendor}-{$name}/', 'theme' => 'themes/{$vendor}-{$name}/');
}
