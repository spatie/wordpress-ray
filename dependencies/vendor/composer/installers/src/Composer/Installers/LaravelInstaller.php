<?php

namespace Spatie\WordPressRay\Composer\Installers;

class LaravelInstaller extends BaseInstaller
{
    protected $locations = array('library' => 'libraries/{$name}/');
}
