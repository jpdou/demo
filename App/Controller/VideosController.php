<?php

namespace App\Controller;

use App\Model\Http;
use App\Model\Http\Request;
use App\Model\Video;

class VideosController extends AbstractController
{
    public function __construct(
        Http $http,
        Request $request
    ) {
        parent::__construct($http, $request);
        $this->template = 'videos.phtml';
    }

    public function execute()
    {
        /** @var Video $video */
        $video = $this->objectManager->create(Video::class);
        $videos = $video->getCollection();
        $select = $videos->getSelect();
        $select->limit(100);
        return $this->renderTemplate(['videos' => $videos]);
    }
}