<?php

namespace App;

use function json_encode;

class Response
{
    public function __construct(
        private $data
    ) {
    }

    public function toJson(): self
    {
        $this->data = json_encode($this->data);
        return $this;
    }

    public function response(): string
    {
        return $this->data;
    }
}
