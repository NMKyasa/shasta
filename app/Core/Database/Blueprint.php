<?php

namespace App\Core\Database;

class Blueprint
{
    /**
     * Store all column definitions
     */
    protected array $columns = [];

    /**
     * Store all foreign key definitions
     */
    protected array $foreignKeys = [];

     /**
     * Store indexes
     */
    protected array $indexes = [];

        /**
     * Store ALTER TABLE queries
     */
    protected array $alterQueries = [];

    /**
     * Track current column index
     * for chaining methods like:
     *
     * ->nullable()
     * ->default()
     * ->unique()
     */
    protected int $currentColumnIndex;

    /**
     * Store temporary foreign key column
     */
    protected string $foreignColumn;

    /**
     * Store referenced column
     */
    protected string $referenceColumn;

        /**
     * Track latest foreign key index
     */
    protected int $currentForeignKeyIndex;

    /**
     * Add AUTO_INCREMENT BIGINT primary key
     */
    public function id()
    {
        $this->columns[] =
            "id BIGINT AUTO_INCREMENT PRIMARY KEY";

        return $this;
    }

    /**
     * Add VARCHAR column
     */
    public function string($name, $length = 255)
    {
        $this->columns[] =
            "{$name} VARCHAR({$length}) NOT NULL";

        $this->currentColumnIndex =
            array_key_last($this->columns);

        return $this;
    }

    /**
     * Add TEXT column
     */
    public function text($name)
    {
        $this->columns[] =
            "{$name} TEXT NOT NULL";

        $this->currentColumnIndex =
            array_key_last($this->columns);

        return $this;
    }

    /**
     * Add LONGTEXT column
     */
    public function longText($name)
    {
        $this->columns[] =
            "{$name} LONGTEXT NOT NULL";

        $this->currentColumnIndex =
            array_key_last($this->columns);

        return $this;
    }

        /**
     * Add DECIMAL column
     *
     * Example:
     * $table->decimal('price', 15, 2)
     */
    public function decimal(
        $column,
        $precision = 10,
        $scale = 2
    )
    {
        $this->columns[] =
            "{$column} DECIMAL({$precision}, {$scale})";

        /**
         * Track latest column
         */
        $this->lastColumn = count($this->columns) - 1;

        return $this;
    }

    /**
     * Add BIGINT column
     */
    public function bigInteger($name)
    {
        $this->columns[] =
            "{$name} BIGINT NOT NULL";

        $this->currentColumnIndex =
            array_key_last($this->columns);

        return $this;
    }

    /**
     * Add BOOLEAN column
     */
    public function boolean($name)
    {
        $this->columns[] =
            "{$name} TINYINT(1) NOT NULL";

        $this->currentColumnIndex =
            array_key_last($this->columns);

        return $this;
    }

    /**
     * Add ENUM column
     */
    public function enum($name, array $values)
    {
        // Convert array into SQL ENUM values
        $formatted =
            "'" . implode("','", $values) . "'";

        $this->columns[] =
            "{$name} ENUM({$formatted}) NOT NULL";

        $this->currentColumnIndex =
            array_key_last($this->columns);

        return $this;
    }

    /**
     * Make current column nullable
     */
    public function nullable()
    {
        $this->columns[$this->currentColumnIndex] =
            str_replace(
                'NOT NULL',
                'NULL',
                $this->columns[$this->currentColumnIndex]
            );

        return $this;
    }

    /**
     * Add UNIQUE constraint
     */
    public function unique()
    {
        $this->columns[$this->currentColumnIndex] .=
            " UNIQUE";

        return $this;
    }

    /**
     * Add DEFAULT value
     */
    public function default($value)
    {
        /**
         * Automatically wrap strings in quotes
         */
        if (is_string($value)) {

            $value = "'{$value}'";
        }

        $this->columns[$this->currentColumnIndex] .=
            " DEFAULT {$value}";

        return $this;
    }

    /**
     * Add created_at and updated_at columns
     */
    public function timestamps()
    {
        $this->columns[] =
            "created_at TIMESTAMP NULL";

        $this->columns[] =
            "updated_at TIMESTAMP NULL";

        return $this;
    }

    /**
     * Add deleted_at column
     */
    public function softDeletes()
    {
        $this->columns[] =
            "deleted_at TIMESTAMP NULL";

        return $this;
    }

    /**
     * Start foreign key definition
     *
     * Example:
     * ->foreign('role_id')
     */
    public function foreign($column)
    {
        $this->foreignColumn = $column;

        return $this;
    }

    /**
     * Define referenced column
     *
     * Example:
     * ->references('id')
     */
    public function references($column)
    {
        $this->referenceColumn = $column;

        return $this;
    }

    /**
     * Define referenced table
     */
    public function on($table)
    {
        $this->foreignKeys[] =
            "FOREIGN KEY ({$this->foreignColumn}) " .
            "REFERENCES {$table}({$this->referenceColumn})";

        /**
         * Track latest foreign key
         */
        $this->currentForeignKeyIndex =
            array_key_last($this->foreignKeys);

        return $this;
    }

        /**
     * Add ON DELETE action
     *
     * Examples:
     * ->onDelete('CASCADE')
     * ->onDelete('SET NULL')
     */
    public function onDelete($action)
    {
        $this->foreignKeys[$this->currentForeignKeyIndex] .=
            " ON DELETE {$action}";

        return $this;
    }


        /**
     * Add normal index
     *
     * Example:
     * ->index('role_id')
     */
    public function index($column)
    {
        $this->indexes[] =
            "INDEX ({$column})";

        return $this;
    }

    /**
     * Add UNIQUE index
     *
     * Example:
     * ->uniqueIndex('email')
     */
    public function uniqueIndex($column)
    {
        $this->indexes[] =
            "UNIQUE ({$column})";

        return $this;
    }

        /**
     * Drop column
     *
     * Example:
     * ->dropColumn('middle_name')
     */
    public function dropColumn($column)
    {
        $this->alterQueries[] =
            "DROP COLUMN {$column}";

        return $this;
    }

        /**
     * Drop foreign key
     *
     * Example:
     * ->dropForeign('role_id')
     */
    public function dropForeign($column)
    {
        /**
         * MySQL foreign key naming convention
         *
         * Example:
         * role_id_foreign
         */
        $constraint =
            "{$column}_foreign";

        $this->alterQueries[] =
            "DROP FOREIGN KEY {$constraint}";

        return $this;
    }

        /**
     * Return ALTER queries
     */
    public function getAlterQueries()
    {
        return $this->alterQueries;
    }

    /**
     * Return all generated SQL parts
     */
    public function getColumns()
    {
        return array_merge(
            $this->columns,
            $this->foreignKeys,
            $this->indexes
        );
    }
}