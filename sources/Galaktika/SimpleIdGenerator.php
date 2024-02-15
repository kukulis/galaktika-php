<?php

namespace Galaktika;

class SimpleIdGenerator implements IdGenerator
{
    public function generateId(): string
    {
        // may use other function
        return uniqid();
    }
}