<?php declare(strict_types=1);

namespace CQRS;

class ClassName
{
    private $value;

    public function __construct(string $value)
    {
        self::validateValue($value);
        $this->value = $value;
    }

    public static function fromObject(object $object): self
    {
        return new self(get_class($object));
    }

    private static function validateValue(string $value): void
    {
        if (class_exists($value) === false) {
            throw ClassNameException::invalidValue($value);
        }
    }

    public function mustImplement(string $interface): void
    {
        $interface = new ClassName($interface);
        if ($this->getReflection()->implementsInterface((string) $interface) === false) {
            throw ClassNameException::missingInterface($this, $interface);
        }
    }

    public function mustHaveMethod(string $method): void
    {
        if ($this->getReflection()->hasMethod($method) === false) {
            throw ClassNameException::missingMethod($this, $method);
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private function getReflection(): \ReflectionClass
    {
        return new \ReflectionClass($this->value);
    }
}

