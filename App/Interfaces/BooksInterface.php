<?php
/**
 * Created by PhpStorm.
 * User: caoyangmin
 * Date: 2018/10/24
 * Time: 下午8:54
 */

namespace App\Interfaces;

use App\Entities\Book;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * 此接口用于演示RPC的使用
 *
 * 注意，App\Controllers\Books 不需要继承自BooksInterface，只需要保证方法上的 @path、@route 等路由、参数绑定等相关注释一致即可
 *
 * @path /books
 */
interface BooksInterface
{
    /**
     * 查找图书
     *
     * @route GET /
     *
     * @param string $name  查找书名
     * @param int $offset 结果集偏移 {@v min:0}
     * @param int $limit 返回结果最大条数 {@v max:1000}
     * @param int $total 总条数
     * @throws BadRequestHttpException 参数错误
     * @return Book[] 图书列表
     */
    public function findBooks($name, &$total, $offset=0, $limit=100);
}