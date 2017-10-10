<?php
/*
|--------------------------------------------------------------------------
| 复写官方函数
|--------------------------------------------------------------------------
|
| 官方函数库路径
| Illuminate/Support/helpers.php
|
*/

if (! function_exists('bcdiv')) {
    /**
     * Generate a URL to a named route.
     *
     * @param  string  $route
     * @param  string  $parameters
     * @return string
     */
    function bcdiv($left_operand, $right_operand, $scale =2)
    {
        return \bcdiv($left_operand, $right_operand, $scale);
    }
}