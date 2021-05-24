<?php

declare (strict_types=1);
namespace Spatie\WordPressRay;

use Spatie\WordPressRay\Rector\Core\Configuration\Option;
use Spatie\WordPressRay\Rector\Php74\Rector\Property\TypedPropertyRector;
use Spatie\WordPressRay\Rector\Set\ValueObject\SetList;
use Spatie\WordPressRay\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (ContainerConfigurator $containerConfigurator) : void {
    // get parameters
    $parameters = $containerConfigurator->parameters();
    // Define what rule sets will be applied
    $parameters->set(Option::SETS, ['/../../../../config/set/downgrade-php73.php']);
    // get services (needed for register a single rule)
    // $services = $containerConfigurator->services();
    // register a single rule
    // $services->set(TypedPropertyRector::class);
};
