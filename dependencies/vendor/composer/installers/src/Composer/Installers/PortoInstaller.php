<?php

namespace Spatie\WordPressRay\Composer\Installers;

class PortoInstaller extends BaseInstaller
{
    protected $locations = array('container' => 'app/Containers/{$name}/');
}
