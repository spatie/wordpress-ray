<?php

namespace Spatie\WordPressRay\Composer\Installers;

class SMFInstaller extends BaseInstaller
{
    protected $locations = array('module' => 'Sources/{$name}/', 'theme' => 'Themes/{$name}/');
}
