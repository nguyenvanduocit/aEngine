<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 10/13/2015
 * Time: 10:22 AM.
 */

namespace AEngine;

abstract class ThemeBase extends AppBase
{
    public function getDIR()
    {
        return get_template_directory();
    }
}
