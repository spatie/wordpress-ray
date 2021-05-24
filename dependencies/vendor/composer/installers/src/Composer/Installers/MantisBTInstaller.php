<?php

namespace Spatie\WordPressRay\Composer\Installers;

use Spatie\WordPressRay\Composer\DependencyResolver\Pool;
class MantisBTInstaller extends BaseInstaller
{
    protected $locations = array('plugin' => 'plugins/{$name}/');
    /**
     * Format package name to CamelCase
     */
    public function inflectPackageVars($vars)
    {
        $vars['name'] = \strtolower(\preg_replace('/(?<=\\w)([A-Z])/', 'Spatie\\WordPressRay\\_\\1', $vars['name']));
        $vars['name'] = \str_replace(array('-', '_'), ' ', $vars['name']);
        $vars['name'] = \str_replace(' ', '', \ucwords($vars['name']));
        return $vars;
    }
}
