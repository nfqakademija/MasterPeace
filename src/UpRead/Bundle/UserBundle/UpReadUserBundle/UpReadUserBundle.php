<?php
namespace UpRead\Bundle\UserBundle\UpReadUserBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;
class UpReadUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
