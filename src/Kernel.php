<?php

namespace App;

use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Doctrine\Bundle\MongoDBBundle\DoctrineMongoDBBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;
}
