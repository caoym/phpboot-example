<?php
namespace App\Controllers;
use App\Entities\Book;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * 图书管理
 *
 * 这是一个示例, 通过实现一套简单的图书管理接口, 展示 PhpBoot 框架的使用方式。
 *
 * @path /books
 */
class Books
{
    /**
     * 查找图书
     *
     * 根据查询条件获取一组图书
     *
     * @route GET /
     *
     * @param array $search 查找条件, 形式如?search[name]=书名&search[type]=1
     * @param int $total 总结果集条数 {@bind response.content.total}
     * @param int $offset 结果集偏移 {@v min|0}
     * @param int $limit 返回结果最大条数 {@v max|1000}
     *
     * @throws BadRequestHttpException 参数错误, 如查询条件不存在等
     *
     * @return Book[] 图书列表 {@bind response.content.books}
     */
    public function findBooks($search = [], &$total=0, $offset=0, $limit=100)
    {
        $total = 1;
        return [new Book()];
    }

    /**
     * 获取图书
     *
     * 获取指定的图书信息
     *
     * @route GET /{id}
     *
     * @param string $id 指定图书编号
     *
     * @throws NotFoundHttpException 图书不存在
     *
     * @return Book 图书信息
     */
    public function getBook($id)
    {
        return new Book();
    }
}