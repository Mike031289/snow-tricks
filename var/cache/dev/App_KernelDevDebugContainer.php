<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerGQvaays\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerGQvaays/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerGQvaays.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerGQvaays\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerGQvaays\App_KernelDevDebugContainer([
    'container.build_hash' => 'GQvaays',
    'container.build_id' => '5c13a594',
    'container.build_time' => 1713476902,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerGQvaays');
