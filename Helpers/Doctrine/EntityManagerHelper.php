<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 04/10/18
 * Time: 08:53
 */

namespace Helpers\Doctrine;

use Doctrine\ORM\EntityManager;
use Sistema\Container\Container;

trait EntityManagerHelper
{
    /**
     * @return mixed
     */
    private function getDoctrine() : EntityManager
    {
        return Container::get(EntityManager::class);
    }
}