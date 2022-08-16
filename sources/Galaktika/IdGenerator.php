<?php

namespace Galaktika;

interface IdGenerator
{
    public function generateId(): string;
}