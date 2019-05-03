<?php
namespace Juanparati\Copyscape\Facades;

use Illuminate\Support\Facades\Facade;
use Juanparati\Copyscape\CopyscapeClient as MainCopyscapeClient;


/**
 * Class CopyscapeFacade.
 *
 * @package Juanparati\Copyscape
 */
class CopyscapeClient extends Facade
{
    protected static function getFacadeAccessor()
    {
        return MainCopyscapeClient::class;
    }
}
