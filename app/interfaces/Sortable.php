<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 12/06/15
 * Time: 09:49
 */

namespace app\interfaces;


interface Sortable
{
    public static function comparator($a,$b);
}