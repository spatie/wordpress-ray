<?php











namespace Composer;

use Composer\Semver\VersionParser;






class InstalledVersions
{
private static $installed = array (
  'root' => 
  array (
    'pretty_version' => 'dev-master',
    'version' => 'dev-master',
    'aliases' => 
    array (
    ),
    'reference' => 'b38e6efb0f0923f1904fb38ede5f69b2d8f16de2',
    'name' => 'spatie/wordpress-ray',
  ),
  'versions' => 
  array (
    'psr/container' => 
    array (
      'pretty_version' => '1.0.0',
      'version' => '1.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b7ce3b176482dbbc1245ebf52b181af44c2cf55f',
    ),
    'ramsey/uuid' => 
    array (
      'pretty_version' => '3.0.0',
      'version' => '3.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '0c0ac34e867219bb9936cc5b823f8a5af840d7eb',
    ),
    'rhumsaa/uuid' => 
    array (
      'replaced' => 
      array (
        0 => '3.0.0',
      ),
    ),
    'spatie/backtrace' => 
    array (
      'pretty_version' => '1.1.0',
      'version' => '1.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '3440fe023a7d5b4497090fb6b2dcdc747daf7873',
    ),
    'spatie/macroable' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '7a99549fc001c925714b329220dea680c04bfa48',
    ),
    'spatie/ray' => 
    array (
      'pretty_version' => '1.21.1',
      'version' => '1.21.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '9ed03dd8d7aa1fed5e947c6a5aa637a54a179009',
    ),
    'spatie/wordpress-ray' => 
    array (
      'pretty_version' => 'dev-master',
      'version' => 'dev-master',
      'aliases' => 
      array (
      ),
      'reference' => 'b38e6efb0f0923f1904fb38ede5f69b2d8f16de2',
    ),
    'symfony/polyfill-mbstring' => 
    array (
      'pretty_version' => 'v1.0.0',
      'version' => '1.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '0b6a8940385311a24e060ec1fe35680e17c74497',
    ),
    'symfony/polyfill-php72' => 
    array (
      'pretty_version' => 'v1.5.0',
      'version' => '1.5.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '8abc9097f5001d310f0edba727469c988acc6ea7',
    ),
    'symfony/polyfill-php80' => 
    array (
      'pretty_version' => 'v1.15.0',
      'version' => '1.15.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '8854dc880784d2ae32908b75824754339b5c0555',
    ),
    'symfony/service-contracts' => 
    array (
      'pretty_version' => 'v1.1.9',
      'version' => '1.1.9.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b776d18b303a39f56c63747bcb977ad4b27aca26',
    ),
    'symfony/stopwatch' => 
    array (
      'pretty_version' => 'v4.4.9',
      'version' => '4.4.9.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f51fb90df1154a7f75987198a9689e28f91e6a50',
    ),
    'symfony/var-dumper' => 
    array (
      'pretty_version' => 'v4.4.9',
      'version' => '4.4.9.0',
      'aliases' => 
      array (
      ),
      'reference' => '56b3aa5eab0ac6720dcd559fd1d590ce301594ac',
    ),
    'typisttech/imposter' => 
    array (
      'pretty_version' => '0.6.1',
      'version' => '0.6.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f52b1a2289d2ea9c660cf9595085d0b11469af83',
    ),
    'typisttech/imposter-plugin' => 
    array (
      'pretty_version' => '0.6.2',
      'version' => '0.6.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '15fa3c90aca3b79497f438b9e02a6176498de53c',
    ),
  ),
);







public static function getInstalledPackages()
{
return array_keys(self::$installed['versions']);
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
if (array_key_exists('aliases', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['aliases']);
}
if (array_key_exists('replaced', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['replaced']);
}
if (array_key_exists('provided', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['provided']);
}

return implode(' || ', $ranges);
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
