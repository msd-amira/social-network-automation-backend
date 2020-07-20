<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\Role;

final class RoleItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface, SerializerAwareDataProviderInterface
{
    use SerializerAwareDataProviderTrait;
    
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Role::class === $resourceClass;
    }

    public function getItem(string $resourceClass, $label, string $operationName = null, array $context = []): ?Role
    {
        return new Role($label);
    }
}