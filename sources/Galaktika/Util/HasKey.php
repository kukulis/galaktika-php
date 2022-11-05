<?php

namespace Galaktika\Util;

interface HasKey
{
    public function getKey(): string;
    public function setKey(string $key);
}