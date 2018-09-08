<?php

declare(strict_types=1);

namespace Peak\Validation\Rule;

use Peak\Validation\AbstractRule;

/**
 * Class IsNotEmpty
 * @package Peak\Validation\Rule
 */
class IsNotEmpty extends AbstractRule
{
    /**
     * Validate
     *
     * @param  mixed $value
     * @return bool
     */
    public function validate($value): bool
    {
        return !empty($value);
    }
}