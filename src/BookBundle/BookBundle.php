<?php

namespace BookBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BookBundle extends Bundle
{
    public function getParent()
    {
        return 'AppBundle';
    }
}
