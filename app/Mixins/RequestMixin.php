<?php

namespace App\Mixins;

use Closure;

/**
 * Mixin methods for \Illuminate\Http\Request class.
 *
 * @mixin \Illuminate\Http\Request
 */
class RequestMixin
{
    /**
     * Determine if the request wants extended information.
     *
     * @return \Closure
     */
    public function wantsExtendedInformation(): Closure
    {
        return function () {
            return $this->filled('extended') && $this->boolean('extended');
        };
    }
}
