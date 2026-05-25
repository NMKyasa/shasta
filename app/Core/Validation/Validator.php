<?php

namespace App\Core\Validation;

class Validator
{
    /**
     * Validation errors
     */
    protected array $errors = [];

    /**
     * Validate data
     */
    public static function make(
        array $data,
        array $rules
    )
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
    )
    {
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
             * Process rules
             */
            foreach ($rulesArray as $rule) {

                /**
                 * Rule with parameter
                 */
                $parts =
                    explode(':', $rule);

                $ruleName = $parts[0];

                $parameter =
                    $parts[1]
                    ??
                    null;

                /**
                 * Required
                 */
                if (
                    $ruleName === 'required'
                    &&
                    empty($value)
                ) {

                    $this->errors[$field][] =
                        "{$field} is required";
                }

                /**
                 * Email
                 */
                if (
                    $ruleName === 'email'
                    &&
                    !filter_var(
                        $value,
                        FILTER_VALIDATE_EMAIL
                    )
                ) {

                    $this->errors[$field][] =
                        "{$field} must be valid";
                }

                /**
                 * Minimum length
                 */
                if (
                    $ruleName === 'min'
                    &&
                    strlen($value)
                    <
                    $parameter
                ) {

                    $this->errors[$field][] =
                        "{$field} minimum length is {$parameter}";
                }

                /**
                 * Maximum length
                 */
                if (
                    $ruleName === 'max'
                    &&
                    strlen($value)
                    >
                    $parameter
                ) {

                    $this->errors[$field][] =
                        "{$field} maximum length is {$parameter}";
                }

                /**
                 * Numeric
                 */
                if (
                    $ruleName === 'numeric'
                    &&
                    !is_numeric($value)
                ) {

                    $this->errors[$field][] =
                        "{$field} must be numeric";
                }

                /**
                 * Confirmed field
                 */
                if (
                    $ruleName === 'confirmed'
                ) {

                    $confirmationField =
                        $field . '_confirmation';

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
     * Check validation failure
     */
    public function fails()
    {
        return !empty($this->errors);
    }

    /**
     * Get validation errors
     */
    public function errors()
    {
        return $this->errors;
    }
}