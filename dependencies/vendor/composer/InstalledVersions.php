<?php

namespace Spatie\WordPressRay\Composer;

use Spatie\WordPressRay\Composer\Semver\VersionParser;
class InstalledVersions
{
    private static $installed = array('root' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(), 'reference' => '5b99ef8285ffa799a5737f9a7001933339849717', 'name' => 'spatie/wordpress-ray'), 'versions' => array('bamarni/composer-bin-plugin' => array('pretty_version' => '1.4.1', 'version' => '1.4.1.0', 'aliases' => array(), 'reference' => '9329fb0fbe29e0e1b2db8f4639a193e4f5406225'), 'brick/math' => array('pretty_version' => '0.9.2', 'version' => '0.9.2.0', 'aliases' => array(), 'reference' => 'dff976c2f3487d42c1db75a3b180e2b9f0e72ce0'), 'composer/installers' => array('pretty_version' => 'v1.11.0', 'version' => '1.11.0.0', 'aliases' => array(), 'reference' => 'ae03311f45dfe194412081526be2e003960df74b'), 'doctrine/instantiator' => array('pretty_version' => '1.4.0', 'version' => '1.4.0.0', 'aliases' => array(), 'reference' => 'd56bf6102915de5702778fe20f2de3b2fe570b5b'), 'myclabs/deep-copy' => array('pretty_version' => '1.10.2', 'version' => '1.10.2.0', 'aliases' => array(), 'reference' => '776f831124e9c62e1a2c601ecc52e776d8bb7220', 'replaced' => array(0 => '1.10.2')), 'nikic/php-parser' => array('pretty_version' => 'v4.10.5', 'version' => '4.10.5.0', 'aliases' => array(), 'reference' => '4432ba399e47c66624bc73c8c0f811e5c109576f'), 'phar-io/manifest' => array('pretty_version' => '2.0.1', 'version' => '2.0.1.0', 'aliases' => array(), 'reference' => '85265efd3af7ba3ca4b2a2c34dbfc5788dd29133'), 'phar-io/version' => array('pretty_version' => '3.1.0', 'version' => '3.1.0.0', 'aliases' => array(), 'reference' => 'bae7c545bef187884426f042434e561ab1ddb182'), 'phpdocumentor/reflection-common' => array('pretty_version' => '2.2.0', 'version' => '2.2.0.0', 'aliases' => array(), 'reference' => '1d01c49d4ed62f25aa84a747ad35d5a16924662b'), 'phpdocumentor/reflection-docblock' => array('pretty_version' => '5.2.2', 'version' => '5.2.2.0', 'aliases' => array(), 'reference' => '069a785b2141f5bcf49f3e353548dc1cce6df556'), 'phpdocumentor/type-resolver' => array('pretty_version' => '1.4.0', 'version' => '1.4.0.0', 'aliases' => array(), 'reference' => '6a467b8989322d92aa1c8bf2bebcc6e5c2ba55c0'), 'phpspec/prophecy' => array('pretty_version' => '1.13.0', 'version' => '1.13.0.0', 'aliases' => array(), 'reference' => 'be1996ed8adc35c3fd795488a653f4b518be70ea'), 'phpunit/php-code-coverage' => array('pretty_version' => '9.2.6', 'version' => '9.2.6.0', 'aliases' => array(), 'reference' => 'f6293e1b30a2354e8428e004689671b83871edde'), 'phpunit/php-file-iterator' => array('pretty_version' => '3.0.5', 'version' => '3.0.5.0', 'aliases' => array(), 'reference' => 'aa4be8575f26070b100fccb67faabb28f21f66f8'), 'phpunit/php-invoker' => array('pretty_version' => '3.1.1', 'version' => '3.1.1.0', 'aliases' => array(), 'reference' => '5a10147d0aaf65b58940a0b72f71c9ac0423cc67'), 'phpunit/php-text-template' => array('pretty_version' => '2.0.4', 'version' => '2.0.4.0', 'aliases' => array(), 'reference' => '5da5f67fc95621df9ff4c4e5a84d6a8a2acf7c28'), 'phpunit/php-timer' => array('pretty_version' => '5.0.3', 'version' => '5.0.3.0', 'aliases' => array(), 'reference' => '5a63ce20ed1b5bf577850e2c4e87f4aa902afbd2'), 'phpunit/phpunit' => array('pretty_version' => '9.5.4', 'version' => '9.5.4.0', 'aliases' => array(), 'reference' => 'c73c6737305e779771147af66c96ca6a7ed8a741'), 'psr/container' => array('pretty_version' => '1.1.1', 'version' => '1.1.1.0', 'aliases' => array(), 'reference' => '8622567409010282b7aeebe4bb841fe98b58dcaf'), 'ramsey/collection' => array('pretty_version' => '1.1.3', 'version' => '1.1.3.0', 'aliases' => array(), 'reference' => '28a5c4ab2f5111db6a60b2b4ec84057e0f43b9c1'), 'ramsey/uuid' => array('pretty_version' => '4.1.1', 'version' => '4.1.1.0', 'aliases' => array(), 'reference' => 'cd4032040a750077205918c86049aa0f43d22947'), 'rhumsaa/uuid' => array('replaced' => array(0 => '4.1.1')), 'roundcube/plugin-installer' => array('replaced' => array(0 => '*')), 'sebastian/cli-parser' => array('pretty_version' => '1.0.1', 'version' => '1.0.1.0', 'aliases' => array(), 'reference' => '442e7c7e687e42adc03470c7b668bc4b2402c0b2'), 'sebastian/code-unit' => array('pretty_version' => '1.0.8', 'version' => '1.0.8.0', 'aliases' => array(), 'reference' => '1fc9f64c0927627ef78ba436c9b17d967e68e120'), 'sebastian/code-unit-reverse-lookup' => array('pretty_version' => '2.0.3', 'version' => '2.0.3.0', 'aliases' => array(), 'reference' => 'ac91f01ccec49fb77bdc6fd1e548bc70f7faa3e5'), 'sebastian/comparator' => array('pretty_version' => '4.0.6', 'version' => '4.0.6.0', 'aliases' => array(), 'reference' => '55f4261989e546dc112258c7a75935a81a7ce382'), 'sebastian/complexity' => array('pretty_version' => '2.0.2', 'version' => '2.0.2.0', 'aliases' => array(), 'reference' => '739b35e53379900cc9ac327b2147867b8b6efd88'), 'sebastian/diff' => array('pretty_version' => '4.0.4', 'version' => '4.0.4.0', 'aliases' => array(), 'reference' => '3461e3fccc7cfdfc2720be910d3bd73c69be590d'), 'sebastian/environment' => array('pretty_version' => '5.1.3', 'version' => '5.1.3.0', 'aliases' => array(), 'reference' => '388b6ced16caa751030f6a69e588299fa09200ac'), 'sebastian/exporter' => array('pretty_version' => '4.0.3', 'version' => '4.0.3.0', 'aliases' => array(), 'reference' => 'd89cc98761b8cb5a1a235a6b703ae50d34080e65'), 'sebastian/global-state' => array('pretty_version' => '5.0.2', 'version' => '5.0.2.0', 'aliases' => array(), 'reference' => 'a90ccbddffa067b51f574dea6eb25d5680839455'), 'sebastian/lines-of-code' => array('pretty_version' => '1.0.3', 'version' => '1.0.3.0', 'aliases' => array(), 'reference' => 'c1c2e997aa3146983ed888ad08b15470a2e22ecc'), 'sebastian/object-enumerator' => array('pretty_version' => '4.0.4', 'version' => '4.0.4.0', 'aliases' => array(), 'reference' => '5c9eeac41b290a3712d88851518825ad78f45c71'), 'sebastian/object-reflector' => array('pretty_version' => '2.0.4', 'version' => '2.0.4.0', 'aliases' => array(), 'reference' => 'b4f479ebdbf63ac605d183ece17d8d7fe49c15c7'), 'sebastian/recursion-context' => array('pretty_version' => '4.0.4', 'version' => '4.0.4.0', 'aliases' => array(), 'reference' => 'cd9d8cf3c5804de4341c283ed787f099f5506172'), 'sebastian/resource-operations' => array('pretty_version' => '3.0.3', 'version' => '3.0.3.0', 'aliases' => array(), 'reference' => '0f4443cb3a1d92ce809899753bc0d5d5a8dd19a8'), 'sebastian/type' => array('pretty_version' => '2.3.1', 'version' => '2.3.1.0', 'aliases' => array(), 'reference' => '81cd61ab7bbf2de744aba0ea61fae32f721df3d2'), 'sebastian/version' => array('pretty_version' => '3.0.2', 'version' => '3.0.2.0', 'aliases' => array(), 'reference' => 'c6c1022351a901512170118436c764e473f6de8c'), 'shama/baton' => array('replaced' => array(0 => '*')), 'spatie/backtrace' => array('pretty_version' => '1.2.0', 'version' => '1.2.0.0', 'aliases' => array(), 'reference' => '9b4df807fb65aaa8006dcd7a7ccdef8fb4bb002e'), 'spatie/macroable' => array('pretty_version' => '1.0.1', 'version' => '1.0.1.0', 'aliases' => array(), 'reference' => '7a99549fc001c925714b329220dea680c04bfa48'), 'spatie/ray' => array('pretty_version' => '1.22.1', 'version' => '1.22.1.0', 'aliases' => array(), 'reference' => 'e82408b78b1391eaee6c962b13c37e80080dc15a'), 'spatie/wordpress-ray' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(), 'reference' => '5b99ef8285ffa799a5737f9a7001933339849717'), 'symfony/polyfill-ctype' => array('pretty_version' => 'v1.22.1', 'version' => '1.22.1.0', 'aliases' => array(), 'reference' => 'c6c942b1ac76c82448322025e084cadc56048b4e'), 'symfony/polyfill-mbstring' => array('pretty_version' => 'v1.22.1', 'version' => '1.22.1.0', 'aliases' => array(), 'reference' => '5232de97ee3b75b0360528dae24e73db49566ab1'), 'symfony/polyfill-php80' => array('pretty_version' => 'v1.22.1', 'version' => '1.22.1.0', 'aliases' => array(), 'reference' => 'dc3063ba22c2a1fd2f45ed856374d79114998f91'), 'symfony/service-contracts' => array('pretty_version' => 'v2.4.0', 'version' => '2.4.0.0', 'aliases' => array(), 'reference' => 'f040a30e04b57fbcc9c6cbcf4dbaa96bd318b9bb'), 'symfony/stopwatch' => array('pretty_version' => 'v5.2.7', 'version' => '5.2.7.0', 'aliases' => array(), 'reference' => 'd99310c33e833def36419c284f60e8027d359678'), 'symfony/var-dumper' => array('pretty_version' => 'v5.2.8', 'version' => '5.2.8.0', 'aliases' => array(), 'reference' => 'd693200a73fae179d27f8f1b16b4faf3e8569eba'), 'theseer/tokenizer' => array('pretty_version' => '1.2.0', 'version' => '1.2.0.0', 'aliases' => array(), 'reference' => '75a63c33a8577608444246075ea0af0d052e452a'), 'webmozart/assert' => array('pretty_version' => '1.10.0', 'version' => '1.10.0.0', 'aliases' => array(), 'reference' => '6964c76c7804814a842473e0c8fd15bab0f18e25')));
    public static function getInstalledPackages()
    {
        return \array_keys(self::$installed['versions']);
    }
    public static function isInstalled($packageName)
    {
        return isset(self::$installed['versions'][$packageName]);
    }
    public static function satisfies(VersionParser $parser, $packageName, $constraint)
    {
        $constraint = $parser->parseConstraints($constraint);
        $provided = $parser->parseConstraints(self::getVersionRanges($packageName));
        return $provided->matches($constraint);
    }
    public static function getVersionRanges($packageName)
    {
        if (!isset(self::$installed['versions'][$packageName])) {
            throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
        }
        $ranges = array();
        if (isset(self::$installed['versions'][$packageName]['pretty_version'])) {
            $ranges[] = self::$installed['versions'][$packageName]['pretty_version'];
        }
        if (\array_key_exists('aliases', self::$installed['versions'][$packageName])) {
            $ranges = \array_merge($ranges, self::$installed['versions'][$packageName]['aliases']);
        }
        if (\array_key_exists('replaced', self::$installed['versions'][$packageName])) {
            $ranges = \array_merge($ranges, self::$installed['versions'][$packageName]['replaced']);
        }
        if (\array_key_exists('provided', self::$installed['versions'][$packageName])) {
            $ranges = \array_merge($ranges, self::$installed['versions'][$packageName]['provided']);
        }
        return \implode(' || ', $ranges);
    }
    public static function getVersion($packageName)
    {
        if (!isset(self::$installed['versions'][$packageName])) {
            throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
        }
        if (!isset(self::$installed['versions'][$packageName]['version'])) {
            return null;
        }
        return self::$installed['versions'][$packageName]['version'];
    }
    public static function getPrettyVersion($packageName)
    {
        if (!isset(self::$installed['versions'][$packageName])) {
            throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
        }
        if (!isset(self::$installed['versions'][$packageName]['pretty_version'])) {
            return null;
        }
        return self::$installed['versions'][$packageName]['pretty_version'];
    }
    public static function getReference($packageName)
    {
        if (!isset(self::$installed['versions'][$packageName])) {
            throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
        }
        if (!isset(self::$installed['versions'][$packageName]['reference'])) {
            return null;
        }
        return self::$installed['versions'][$packageName]['reference'];
    }
    public static function getRootPackage()
    {
        return self::$installed['root'];
    }
    public static function getRawData()
    {
        return self::$installed;
    }
    public static function reload($data)
    {
        self::$installed = $data;
    }
}
