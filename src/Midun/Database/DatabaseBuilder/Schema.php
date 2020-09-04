<?php

namespace Midun\Database\DatabaseBuilder;

use Midun\Supports\Traits\MigrateBuilder;

class Schema
{
    use MigrateBuilder;

    /**
     * Handle call static
     * @param string $method
     * @param array $arguments
     * 
     * @return void
     */
    public static function __callStatic($method, $arguments)
    {
        switch ($method) {
            case 'create':
                list($table, $columns) = $arguments;
                return (new self)->createMigrate($table, $columns);
            case 'createIfNotExists':
                list($table, $columns) = $arguments;
                return (new self)->createIfNotExistsMigrate($table, $columns);
            case 'drop':
                list($table) = $arguments;
                return (new self)->dropMigrate($table);
            case 'dropIfExists':
                list($table) = $arguments;
                return (new self)->dropIfExistsMigrate($table);
            case 'truncate':
                list($table) = $arguments;
                return (new self)->truncateMigrate($table);
            default:
                throw new DatabaseBuilderException("Method '$method' is not supported.");
        }
    }
}
