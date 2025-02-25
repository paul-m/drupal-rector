<?php

declare(strict_types=1);

use DrupalRector\Rector\Deprecation\MethodToMethodWithCheckRector;
use DrupalRector\Rector\Deprecation\FileDefaultSchemeRector;
use DrupalRector\Rector\Deprecation\DrupalServiceRenameRector;
use DrupalRector\Rector\Deprecation\FunctionToServiceRector;
use DrupalRector\Rector\ValueObject\DrupalServiceRenameConfiguration;
use DrupalRector\Rector\ValueObject\FunctionToServiceConfiguration;
use DrupalRector\Rector\ValueObject\MethodToMethodWithCheckConfiguration;
use DrupalRector\Services\AddCommentService;
use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->singleton(AddCommentService::class, function() {
        return new AddCommentService();
    });
    $rectorConfig->ruleWithConfiguration(DrupalServiceRenameRector::class, [
        new DrupalServiceRenameConfiguration('path.alias_repository', 'path_alias.repository'),
        new DrupalServiceRenameConfiguration('path.alias_whitelist', 'path_alias.whitelist'),
        new DrupalServiceRenameConfiguration('path_processor_alias', 'path_alias.path_processor'),
        new DrupalServiceRenameConfiguration('path_subscriber', 'path_alias.subscriber'),
        new DrupalServiceRenameConfiguration('path.alias_manager', 'path_alias.manager'),
    ]);

    $rectorConfig->rule(FileDefaultSchemeRector::class);

    $rectorConfig->ruleWithConfiguration(FunctionToServiceRector::class,
    [
        // https://www.drupal.org/node/2835616
        new FunctionToServiceConfiguration('entity_get_display', 'entity_display.repository', 'getViewDisplay'),
        // https://www.drupal.org/node/2835616
        new FunctionToServiceConfiguration('entity_get_form_display', 'entity_display.repository', 'getFormDisplay'),
        // https://www.drupal.org/node/3039255
        new FunctionToServiceConfiguration('file_directory_temp', 'file_system', 'getTempDirectory'),
        // https://www.drupal.org/node/3038437
        new FunctionToServiceConfiguration('file_scan_directory', 'file_system', 'scanDirectory'),
        // https://www.drupal.org/node/3035273
        new FunctionToServiceConfiguration('file_uri_target', 'stream_wrapper_manager', 'getTarget'),
    ]);

    $rectorConfig->ruleWithConfiguration(MethodToMethodWithCheckRector::class, [
        // https://www.drupal.org/node/3075567
        new MethodToMethodWithCheckConfiguration('Drupal\Core\Entity\EntityTypeInterface', 'getLowercaseLabel', 'getSingularLabel'),
    ]);
};
