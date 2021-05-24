<?php

namespace Spatie\WordPressRay\Composer\Installers;

class ElggInstaller extends BaseInstaller
{
    protected $locations = array('plugin' => 'mod/{$name}/');
}
