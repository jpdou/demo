<?php

namespace Video\Controller\Video;

use System\Model\Http\Request;
use System\Model\Layout;
use Video\Model\Video;
use System\Controller\AbstractController;

class GridController extends AbstractController
{
    private $pageCount = 30;

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

        $countSelect = $videos->getCountSelect();

        // filter
        $filters = (array) $this->request->get('filter', []);
        if (count($filters)) {
            foreach ($filters as $filter => $value) {
                if (!$value) {
                    continue;
                }
                switch ($filter) {
                    case 'release_date' :
                        $select->where(['date' => date("Y-m-d 00:00:00")]);
                        $countSelect->where(['date' => date("Y-m-d 00:00:00")]);
                        break;
                    case 'identifier':
                        $select->where(['identifier' => $value]);
                        $countSelect->where(['identifier' => $value]);
                        break;
                    default:
                        break;
                }
            }
        }

        $page = (int) $this->request->get('p', 1);
        $page = ($page - 1) < 0 ? 0 : $page - 1;

        $select->offset($page * $this->pageCount);
        $select->order('date DESC');
        $select->limit($this->pageCount);

        return $this->layout->renderTemplate($this->template,
            [
                'videos' => $videos,
                'filters' => $filters,
                'pageCount' => $this->pageCount
            ]
        );
    }
}