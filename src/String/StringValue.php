<?php

namespace App\String;

class StringValue
{
    /**
     * @var string
     */
    private $uid;
    /**
     * @var string ;
     */
    private $value;

    /**
     * @param string $uid
     * @param string $value
     */
    public function __construct(string $uid, string $value)
    {
        $this->uid = $uid;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getUid(): string
    {
        return $this->uid;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    public function toArray(): array
    {
        return [
            'key' => $this->getUid(),
            'value' => $this->getValue(),
        ];
    }
}
