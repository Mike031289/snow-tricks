<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container7Ab7TVR\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container7Ab7TVR/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container7Ab7TVR.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container7Ab7TVR\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \Container7Ab7TVR\App_KernelDevDebugContainer([
    'container.build_hash' => '7Ab7TVR',
    'container.build_id' => '9e385783',
    'container.build_time' => 1710951844,
], __DIR__.\DIRECTORY_SEPARATOR.'Container7Ab7TVR');
