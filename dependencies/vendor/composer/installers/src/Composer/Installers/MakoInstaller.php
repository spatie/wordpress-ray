<?php

namespace Spatie\WordPressRay\Composer\Installers;

class MakoInstaller extends BaseInstaller
{
    protected $locations = array('package' => 'app/packages/{$name}/');
}
