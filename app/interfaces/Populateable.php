<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 12/06/15
 * Time: 09:48
 */

namespace app\interfaces;


interface Populateable
{
    public function populate($arr);
}