<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\PostRector\Rector\ClassRenamingPostRector;
use Rector\PostRector\Rector\NameImportingPostRector;
use Rector\Privatization\Rector\Class_\ChangeLocalPropertyToVariableRector;
use Rector\Privatization\Rector\ClassMethod\ChangeGlobalVariablesToPropertiesRector;
use Rector\Privatization\Rector\MethodCall\PrivatizeLocalGetterToPropertyRector;
use Rector\Set\ValueObject\SetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    // get parameters
    $parameters = $containerConfigurator->parameters();
    $services = $containerConfigurator->services();

    // Define what rule sets will be applied
    $containerConfigurator->import(SetList::DEAD_CODE);
    $containerConfigurator->import(SetList::EARLY_RETURN);
    $containerConfigurator->import(SetList::ORDER);
    $containerConfigurator->import(SetList::CODE_QUALITY);
    $containerConfigurator->import(SetList::CODING_STYLE);
    $containerConfigurator->import(SetList::TYPE_DECLARATION);
    $containerConfigurator->import(SetList::PHP_71);
    $containerConfigurator->import(SetList::PHP_72);
    $containerConfigurator->import(SetList::PHP_74);

    // PostRector
    $services->set(ClassRenamingPostRector::class);
    $services->set(NameImportingPostRector::class);

    // Privatization
    $services->set(ChangeGlobalVariablesToPropertiesRector::class);
    $services->set(ChangeLocalPropertyToVariableRector::class);
    $services->set(PrivatizeLocalGetterToPropertyRector::class);

    $parameters->set(Option::PHPSTAN_FOR_RECTOR_PATH, getcwd() . '/phpstan.neon');
};
