<?php
namespace MasterPeace\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MasterPeaceUserBundle extends Bundle
{
    /**
     * @return string
     */
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
