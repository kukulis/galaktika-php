<?php

namespace Galaktika\V2\Data;

use Symfony\Component\Uid\Uuid;

class Ship
{
    public function getId() {
        Uuid::v6()->toBinary();
    }
}