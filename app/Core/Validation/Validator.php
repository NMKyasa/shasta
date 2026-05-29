<?php

namespace App\Core\Validation;

/**
 * Validation Service
 *
 * Provides reusable validation rules
 * across the entire framework.
 */
class Validator
{
    /**
     * Validation errors
     */
    protected array $errors = [];

    /**
     * Create validator instance
     */
    public static function make(
        array $data,
        array $rules
    ): self
    {
        $instance = new self();

        $instance->validate(
            $data,
            $rules
        );

        return $instance;
    }

    /**
     * Run validation
     */
    protected function validate(
        array $data,
        array $rules
    ): void
    {
        /**
         * Loop through fields
         */
        foreach (
            $rules
            as
            $field => $ruleString
        ) {

            /**
             * Rule list
             */
            $rulesArray =
                explode(
                    '|',
                    $ruleString
                );

            /**
             * Field value
             */
            $value =
                $data[$field]
                ??
                null;

            /**
             * Normalize strings
             */
            if (
                is_string($value)
            ) {

                $value =
                    trim($value);
            }

            /**
             * Nullable rule
             *
             * If nullable is present
             * and value is empty,
             * skip remaining rules.
             */
            if (

                in_array(
                    'nullable',
                    $rulesArray
                )

                &&

                (
                    $value === null
                    ||
                    $value === ''
                )

            ) {

                continue;
            }

            /**
             * Process rules
             */
            foreach (
                $rulesArray
                as
                $rule
            ) {

                /**
                 * Split rule parameter
                 *
                 * Example:
                 * max:255
                 */
                $parts =
                    explode(
                        ':',
                        $rule
                    );

                $ruleName =
                    $parts[0];

                $parameter =
                    $parts[1]
                    ??
                    null;

                /**
                 * REQUIRED
                 */
                if (
                    $ruleName === 'required'
                ) {

                    if (

                        $value === null
                        ||
                        $value === ''

                    ) {

                        $this->errors[$field][] =
                            "{$field} is required";

                        /**
                         * Stop processing
                         * remaining rules
                         * for this field
                         */
                        break;
                    }
                }

                /**
                 * EMAIL
                 */
                if (

                    $ruleName === 'email'

                    &&

                    $value !== null

                    &&

                    !filter_var(
                        $value,
                        FILTER_VALIDATE_EMAIL
                    )

                ) {

                    $this->errors[$field][] =
                        "{$field} must be a valid email address";
                }

                /**
                 * NUMERIC
                 */
                if (

                    $ruleName === 'numeric'

                    &&

                    $value !== null

                    &&

                    !is_numeric($value)

                ) {

                    $this->errors[$field][] =
                        "{$field} must be numeric";
                }

                /**
                 * INTEGER
                 */
                if (

                    $ruleName === 'integer'

                    &&

                    $value !== null

                    &&

                    filter_var(
                        $value,
                        FILTER_VALIDATE_INT
                    ) === false

                ) {

                    $this->errors[$field][] =
                        "{$field} must be an integer";
                }

                /**
                 * URL
                 */
                if (

                    $ruleName === 'url'

                    &&

                    $value !== null

                    &&

                    !filter_var(
                        $value,
                        FILTER_VALIDATE_URL
                    )

                ) {

                    $this->errors[$field][] =
                        "{$field} must be a valid URL";
                }

                /**
                 * BOOLEAN
                 */
                if (

                    $ruleName === 'boolean'

                    &&

                    !in_array(

                        $value,

                        [
                            0,
                            1,
                            '0',
                            '1',
                            true,
                            false
                        ],

                        true
                    )

                ) {

                    $this->errors[$field][] =
                        "{$field} must be boolean";
                }

                /**
                 * MIN LENGTH
                 */
                if (

                    $ruleName === 'min'

                    &&

                    $value !== null

                    &&

                    strlen((string) $value)
                    <
                    (int) $parameter

                ) {

                    $this->errors[$field][] =
                        "{$field} minimum length is {$parameter}";
                }

                /**
                 * MAX LENGTH
                 */
                if (

                    $ruleName === 'max'

                    &&

                    $value !== null

                    &&

                    strlen((string) $value)
                    >
                    (int) $parameter

                ) {

                    $this->errors[$field][] =
                        "{$field} maximum length is {$parameter}";
                }

                /**
                 * IN ARRAY
                 *
                 * Example:
                 * in:active,inactive
                 */
                if (
                    $ruleName === 'in'
                ) {

                    $allowed =
                        explode(
                            ',',
                            $parameter
                        );

                    if (

                        !in_array(
                            $value,
                            $allowed
                        )

                    ) {

                        $this->errors[$field][] =
                            "{$field} contains an invalid value";
                    }
                }

                /**
                 * CONFIRMED
                 *
                 * Example:
                 * password
                 * password_confirmation
                 */
                if (
                    $ruleName === 'confirmed'
                ) {

                    $confirmationField =
                        $field
                        .
                        '_confirmation';

                    if (

                        ($data[$confirmationField] ?? null)

                        !==

                        $value

                    ) {

                        $this->errors[$field][] =
                            "{$field} confirmation does not match";
                    }
                }
            }
        }
    }

    /**
     * Check if validation failed
     */
    public function fails(): bool
    {
        return !empty(
            $this->errors
        );
    }

    /**
     * Get validation errors
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * Get flattened errors
     *
     * Useful for flash messages.
     */
    public function all(): array
    {
        $errors = [];

        foreach (
            $this->errors
            as
            $fieldErrors
        ) {

            foreach (
                $fieldErrors
                as
                $error
            ) {

                $errors[] =
                    $error;
            }
        }

        return $errors;
    }
}