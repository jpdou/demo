<?php

namespace Video\Controller\Video;

use System\Model\Http;
use System\Model\Http\Request;
use System\Model\Layout;
use Video\Model\Video;
use System\Controller\AbstractController;

class GridController extends AbstractController
{
    private $pageCount = 100;

    public function __construct(
        Request $request,
        Layout $layout
    ) {
        parent::__construct($request, $layout);
        $this->template = 'video_grid';
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