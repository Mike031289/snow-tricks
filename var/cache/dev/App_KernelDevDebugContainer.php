<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerOejYyAD\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerOejYyAD/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerOejYyAD.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerOejYyAD\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerOejYyAD\App_KernelDevDebugContainer([
    'container.build_hash' => 'OejYyAD',
    'container.build_id' => 'dca3c31c',
    'container.build_time' => 1712441688,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerOejYyAD');
