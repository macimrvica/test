<?php declare(strict_types=1);


namespace App\Common\Domain\Model;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class UuidModelId implements ModelIdInterface
{
    private UuidInterface $value;

    private function __construct(UuidInterface $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->getValue()->toString();
    }

    public function getValue(): UuidInterface
    {
        return $this->value;
    }

    public static function create()
    {
        $uuid = Uuid::uuid4();

        return new self($uuid);
    }
}
