<?php

namespace Spatie\WordPressRay\Composer\Installers;

class CiviCrmInstaller extends BaseInstaller
{
    protected $locations = array('ext' => 'ext/{$name}/');
}
