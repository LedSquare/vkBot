<?php

namespace App\Http;

use function json_encode;

class Response
{
    public function __construct(
        private $data
    ) {
    }

    public function toJson(): self
    {
        header('content-type application/json');
        $this->data = json_encode($this->data);
        return $this;
    }

    public function response(): void
    {
        print_r($this->data);
    }
}
