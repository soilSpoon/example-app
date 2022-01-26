<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPromotedPropertyRector;
use Rector\Set\ValueObject\SetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    // get parameters
    $parameters = $containerConfigurator->parameters();

    // Define what rule sets will be applied
    // $containerConfigurator->import(SetList::DEAD_CODE);
    // $containerConfigurator->import(SetList::EARLY_RETURN);
    // $containerConfigurator->import(SetList::ORDER);
    // $containerConfigurator->import(SetList::CODE_QUALITY);
    // $containerConfigurator->import(SetList::CODING_STYLE);
    // $containerConfigurator->import(SetList::TYPE_DECLARATION);

    $parameters->set(Option::SKIP, [RemoveUnusedPromotedPropertyRector::class]);

    $parameters->set(Option::PATHS, [__DIR__ . '/app']);

    $parameters->set(Option::PHPSTAN_FOR_RECTOR_PATH, getcwd() . '/phpstan.neon');
};
