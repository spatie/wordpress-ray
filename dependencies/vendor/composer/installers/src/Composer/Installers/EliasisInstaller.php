<?php

namespace Spatie\WordPressRay\Composer\Installers;

class EliasisInstaller extends BaseInstaller
{
    protected $locations = array('component' => 'components/{$name}/', 'module' => 'modules/{$name}/', 'plugin' => 'plugins/{$name}/', 'template' => 'templates/{$name}/');
}
