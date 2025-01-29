<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\ServerGroups;

use TeamSpeak\WebQuery\Enums\GroupNameMode;
use TeamSpeak\WebQuery\Enums\PermissionGroupDatabaseTypes;

final readonly class ListResponseGroup
{
    private function __construct(
        public int $iconId,
        public int $neededMemberAddPower,
        public int $neededMemberRemovePower,
        public int $neededModifyPower,
        public string $name,
        public GroupNameMode $nameMode,
        public bool $permanent,
        public int $id,
        public ?int $sortId,
        public PermissionGroupDatabaseTypes $type,
    ) {}

    /**
     * @param  array{iconid: string, n_member_addp: string, n_member_removep: string, n_modifyp: string, name: string, namemode: string, savedb: string, sgid: string, sortid: string, type: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes['iconid'],
            (int) $attributes['n_member_addp'],
            (int) $attributes['n_member_removep'],
            (int) $attributes['n_modifyp'],
            $attributes['name'],
            GroupNameMode::from((int) $attributes['namemode']),
            (bool) $attributes['savedb'],
            (int) $attributes['sgid'],
            $attributes['sortid'] !== '0' ? (int) $attributes['sortid'] : null,
            PermissionGroupDatabaseTypes::from((int) $attributes['type']),
        );
    }
}
