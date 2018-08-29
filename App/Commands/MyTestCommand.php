<?php
/**
 * Created by PhpStorm.
 * User: caoyangmin
 * Date: 2018/8/29
 * Time: 下午2:57
 */

namespace App\Commands;

/**
 * @command my
 */
class MyTestCommand
{
    /**
     * run test
     *
     * @command test    // 命令唯一标识
     *
     * @param int $arg0 arg 0
     * @param string $arg1 arg 1
     * @param string[] $arg2 arg 2
     * @return int
     */
    public function runTest($arg0, $arg1, $arg2){
        var_dump([$arg0, $arg1, $arg2]);
        return 0; // 返回进程的exit code
    }

}