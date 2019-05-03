<?php


namespace Juanparati\Copyscape\Services\Extensions;


use Juanparati\Copyscape\Exceptions\AuthException;
use Juanparati\Copyscape\Exceptions\CreditsExceptions;
use Juanparati\Copyscape\Exceptions\IndexException;


/**
 * Trait GenericThrowable
 *
 * Throw exceptions according to generic API errors.
 *
 * @package Juanparati\Copyscape\Services\Extensions
 */
trait GenericThrowable
{

    /**
     * Raise response errors.
     *
     * @param string $error
     * @throws AuthException
     * @throws CreditsExceptions
     * @throws IndexException
     */
    protected function raiseResponseExceptions(string $error) : void
    {
        switch ($error)
        {
            case 'No credits remaining':
                throw new CreditsExceptions('Copyscape: Insufficient credits');
            case 'Username or API key not correct':
                throw new AuthException('Copyscape: Wrong API credentials');
        }
    }
}
