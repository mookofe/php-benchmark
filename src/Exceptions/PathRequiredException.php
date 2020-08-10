<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark\Exceptions;

use Exception;
use Throwable;

/**
 * Class PathRequiredException
 *
 * Thrown when the path is not supplied to generate report
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class PathRequiredException extends Exception
{
    /**
     * PathRequiredException constructor.
     *
     * @param Throwable|null $previous
     */
    public function __construct(Throwable $previous = null)
    {
        $message = 'Path required to generate report';

        parent::__construct($message, 0, $previous);
    }
}
