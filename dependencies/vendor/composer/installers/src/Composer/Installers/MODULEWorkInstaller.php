<?php

namespace Spatie\WordPressRay\Composer\Installers;

class MODULEWorkInstaller extends BaseInstaller
{
    protected $locations = array('module' => 'modules/{$name}/');
}
