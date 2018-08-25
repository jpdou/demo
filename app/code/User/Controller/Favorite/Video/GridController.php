<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/25
 * Time: 14:55
 */

namespace User\Controller\Favorite\Video;


use System\Controller\AbstractController;
use System\Model\Http\Request;
use System\Model\Layout;
use Video\Model\Video;

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

        /** @var \User\Model\Favorite\Video $favoriteVideo */
        $favoriteVideo = $this->objectManager->get(\User\Model\Favorite\Video::class);
        $select->join(
            ['favorite' => $favoriteVideo->getTable()],
            'e.id = favorite.video_id',
            []
        )->where(['favorite.user_id' => $_SESSION['user_id']]);

        $page = (int) $this->request->get('p', 1);
        $page = ($page - 1) < 0 ? 0 : $page - 1;

        $select->offset($page * $this->pageCount);
        $select->order('date DESC');
        $select->limit($this->pageCount);

        $videos->load();

        return $this->layout->renderTemplate($this->template, ['videos' => $videos, 'pageCount' => $this->pageCount]);
    }
}