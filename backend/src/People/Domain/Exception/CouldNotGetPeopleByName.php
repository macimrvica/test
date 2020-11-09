<?php declare(strict_types=1);


namespace App\People\Domain\Exception;

use Exception;
use RuntimeException;

class CouldNotGetPeopleByName extends RuntimeException
{
    public static function because(string $message, Exception $previous = null): self
    {
        return new self(
            $message,
            0,
            $previous
        );
    }
}
