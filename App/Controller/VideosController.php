<?php

namespace App\Controller;

use App\Model\Http;
use App\Model\Http\Request;
use App\Model\Layout;
use App\Model\Video;

class VideosController extends AbstractController
{
    private $pageCount = 100;

    public function __construct(
        Http $http,
        Request $request,
        Layout $layout
    ) {
        parent::__construct($http, $request, $layout);
        $this->template = 'videos.phtml';
    }

    public function execute()
    {
        /** @var Video $video */
        $video = $this->objectManager->create(Video::class);
        $videos = $video->getCollection();
        $select = $videos->getSelect();

        $page = $this->request->get('p', 1);
        $page--;

        if ($page < 0) {
            $page = 0;
        }

        $select->offset($page * $this->pageCount);
        $select->limit($this->pageCount);
        return $this->layout->renderTemplate($this->template, ['videos' => $videos, 'pageCount' => $this->pageCount]);
    }
}