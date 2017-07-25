<?php

namespace App\Entities;

/**
 * 图书信息
 * @table books
 * @pk id
 */
class Book
{
    /**
     * @var int
     * @v optional
     */
    public $id;
    /**
     * 书名
     * @var string
     */
    public $name='';

    /**
     * 简介
     * @var string
     */
    public $brief='';

    /**
     * 图片url
     * @var string[]
     */
    public $pictures=[];
}