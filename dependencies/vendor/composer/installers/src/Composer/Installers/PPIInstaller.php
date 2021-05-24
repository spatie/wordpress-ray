<?php

namespace Spatie\WordPressRay\Composer\Installers;

class PPIInstaller extends BaseInstaller
{
    protected $locations = array('module' => 'modules/{$name}/');
}
