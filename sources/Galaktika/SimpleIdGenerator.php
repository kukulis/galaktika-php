<?php

namespace Galaktika;

class SimpleIdGenerator implements IdGenerator
{
    public function generateId(): string
    {
        return uniqid();
    }
}