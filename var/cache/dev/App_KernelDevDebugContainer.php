<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerAp8yS5u\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerAp8yS5u/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerAp8yS5u.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerAp8yS5u\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerAp8yS5u\App_KernelDevDebugContainer([
    'container.build_hash' => 'Ap8yS5u',
    'container.build_id' => '537bebbd',
    'container.build_time' => 1710281786,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerAp8yS5u');
