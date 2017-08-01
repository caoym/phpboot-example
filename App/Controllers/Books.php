<?php
namespace App\Controllers;
use App\Entities\Book;
use PhpBoot\DB\DB;
use PhpBoot\DI\Traits\EnableDIAnnotations;
use Psr\Log\LoggerInterface;
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
    use EnableDIAnnotations; //启用通过@inject标记注入依赖

    /**
     * @param LoggerInterface $logger 通过依赖注入传入
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger;
    }

    /**
     * 查找图书
     *
     * @route GET /
     *
     * @param string $name  查找书名
     * @param int $offset 结果集偏移 {@v min:0}
     * @param int $limit 返回结果最大条数 {@v max:1000}
     *
     * @throws BadRequestHttpException 参数错误
     * @return Book[] 图书列表
     */
    public function findBooks($name, $offset=0, $limit=100)
    {
        return \PhpBoot\model($this->db, Book::class)
            ->where(['name'=>['LIKE'=>"%$name%"]])
            ->limit($offset, $limit)
            ->get();
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
        $book = \PhpBoot\model($this->db, Book::class)
            ->find($id) or \PhpBoot\abort(new NotFoundHttpException("book $id not found"));
        return $book;
    }

    /**
     * 新建图书
     *
     * 根据指定信息新建图书
     *
     * @route POST /
     * @param Book $book {@bind request.request} 这里将post的内容绑定到 book 参数上
     * @throws BadRequestHttpException
     * @return string 返回新建图书的编号
     */
    public function createBook(Book $book)
    {
        !$book->id or \PhpBoot\abort(new BadRequestHttpException("should not specify id while creating books"));
        $this->logger->info("attempt to create book: ".json_encode($book));

        \PhpBoot\model($this->db, $book)->create();

        $this->logger->info("create book {$book->id} OK");
        return $book->id;
    }

    /**
     * 修改图书
     *
     * 根据指定信息修改图书
     *
     * @route PUT /
     * @param Book $book {@bind request.request} 这里将post的内容绑定到 book 参数上
     * @throws BadRequestHttpException
     * @return void 成功
     */
    public function updateBook(Book $book)
    {
        $book->id or \PhpBoot\abort(new BadRequestHttpException("create "));
        $this->logger->info("attempt to update book: ".json_encode($book));

        \PhpBoot\model($this->db, $book)->update();

        $this->logger->info("update book {$book->id} OK");
    }
    /**
     * 删除图书
     *
     * 删除指定图书
     *
     * @route DELETE /{id}
     * @param string $id
     * @throws NotFoundHttpException 指定图书不存在
     * @return void
     */
    public function deleteBook($id)
    {
        $this->logger->info("attempt to delete $id");

        \PhpBoot\model($this->db, Book::class)->delete() or \PhpBoot\abort(new NotFoundHttpException("book $id not found"));

        $this->logger->info("delete book $id OK");
    }

    /**
     * @inject
     * @var LoggerInterface
     */
    public $logger;

    /**
     * @inject
     * @var DB
     */
    private $db;
}