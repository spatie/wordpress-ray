<?php

namespace Spatie\WordPressRay\Composer\Installers;

class BonefishInstaller extends BaseInstaller
{
    protected $locations = array('package' => 'Packages/{$vendor}/{$name}/');
}
