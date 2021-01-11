<?php

use Spatie\WordPressRay\Illuminate\Contracts\Container\BindingResolutionException;
use Spatie\WordPressRay\Spatie\LaravelRay\Ray as LaravelRay;
use Spatie\WordPressRay\Spatie\Ray\Ray;
use Spatie\WordPressRay\Spatie\Ray\Settings\SettingsFactory;

if (! function_exists('ray')) {
    /**
     * @param mixed ...$args
     *
     * @return \Spatie\Ray\Ray|LaravelRay
     */
    function ray(...$args)
    {
        if (class_exists(LaravelRay::class)) {
            try {
                return app(LaravelRay::class)->send(...$args);
            } catch (BindingResolutionException $exception) {
                // this  exception can occur when requiring spatie/ray in an Orchestra powered
                // testsuite without spatie/laravel-ray's service provider being registered
                // in `getPackageProviders` of the base test suite
            }
        }

        $settings = SettingsFactory::createFromConfigFile();

        return (new Ray($settings))->send(...$args);
    }
}

if (! function_exists('rd')) {
    function rd(...$args)
    {
        ray(...$args)->die();
    }
}
