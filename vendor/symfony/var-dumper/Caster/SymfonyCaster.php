<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Spatie\WordPressRay\Symfony\Component\VarDumper\Caster;

use Spatie\WordPressRay\Symfony\Component\HttpFoundation\Request;
use Spatie\WordPressRay\Symfony\Component\VarDumper\Cloner\Stub;
/**
 * @final since Symfony 4.4
 */
class SymfonyCaster
{
    private static $requestGetters = ['pathInfo' => 'getPathInfo', 'requestUri' => 'getRequestUri', 'baseUrl' => 'getBaseUrl', 'basePath' => 'getBasePath', 'method' => 'getMethod', 'format' => 'getRequestFormat'];
    public static function castRequest(Request $request, array $a, Stub $stub, $isNested)
    {
        $clone = null;
        foreach (self::$requestGetters as $prop => $getter) {
            $key = Caster::PREFIX_PROTECTED . $prop;
            if (\array_key_exists($key, $a) && null === $a[$key]) {
                if (null === $clone) {
                    $clone = clone $request;
                }
                $a[Caster::PREFIX_VIRTUAL . $prop] = $clone->{$getter}();
            }
        }
        return $a;
    }
    public static function castHttpClient($client, array $a, Stub $stub, $isNested)
    {
        $multiKey = \sprintf("\x00%s\x00multi", \get_class($client));
        if (isset($a[$multiKey])) {
            $a[$multiKey] = new CutStub($a[$multiKey]);
        }
        return $a;
    }
    public static function castHttpClientResponse($response, array $a, Stub $stub, $isNested)
    {
        $stub->cut += \count($a);
        $a = [];
        foreach ($response->getInfo() as $k => $v) {
            $a[Caster::PREFIX_VIRTUAL . $k] = $v;
        }
        return $a;
    }
}
