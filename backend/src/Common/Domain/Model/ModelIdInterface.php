<?php declare(strict_types=1);


namespace App\Common\Domain\Model;

interface ModelIdInterface
{
    public function __toString(): string;

    /**
     * @return mixed
     */
    public function getValue();
}
