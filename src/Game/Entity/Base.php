<?php

namespace Game\Entity;


class Base extends Tower
{
    public function __construct(int $id)
    {
        parent::__construct($id, 2000, 30);
    }

}