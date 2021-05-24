<?php

namespace Spatie\WordPressRay\Composer\Installers;

class FuelphpInstaller extends BaseInstaller
{
    protected $locations = array('component' => 'components/{$name}/');
}
