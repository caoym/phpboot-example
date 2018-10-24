<?php
/**
 * Created by PhpStorm.
 * User: caoyangmin
 * Date: 2018/8/29
 * Time: 下午2:57
 */

namespace App\Commands;
use App\Interfaces\BooksInterface;
use PhpBoot\DI\Traits\EnableDIAnnotations;

/**
 * @command my
 */
class MyTestCommand
{

    /**
     * 演示命令行的使用
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

    /**
     * 演示RPC的使用
     *
     * @command rpc    // 命令唯一标识
     * @return int
     */
    public function runRpcTest($name = "", $offset=0, $limit=1){

        // 注意，引用类型的值无法通过远程方法获取，详见这里: http://phpboot.org/zh/latest/advanced/rpc.html
        print_r($this->books->findBooks($name,$total, $offset, $limit));

        return 0; // 返回进程的exit code
    }

    use EnableDIAnnotations;

    /**
     * @inject
     * @var BooksInterface
     */
    private $books;
}