<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/7
 * Time: 12:25
 */

namespace App\Model;


class Actress
{
    private $video;

    public function __construct(
        VideoInterface $video
    ) {
        $this->video = $video;
    }
}