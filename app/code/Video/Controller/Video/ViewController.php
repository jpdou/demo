<?php

namespace Video\Controller\Video;

use System\Model\Http\Request;
use System\Model\Layout;
use Video\Model\Video;
use System\Controller\AbstractController;
use User\Model\Favorite\Video as FavoriteVideo;

class ViewController extends AbstractController
{
    public function __construct(
        Request $request,
        Layout $layout
    ) {
        parent::__construct($request, $layout);
        $this->template = 'video_view';
    }

    public function execute()
    {
        $videoId = $this->request->get('video');

        /** @var Video $video */
        $video = $this->objectManager->create(Video::class);
        $video->load($videoId);

        /** @var FavoriteVideo $favoriteVideo */
        $favoriteVideo = $this->objectManager->get(FavoriteVideo::class);
        $favoriteVideos = $favoriteVideo->getCollection();
        $select = $favoriteVideos->getCountSelect();
        $select->where(['user_id' => $_SESSION['user_id']])
            ->where(['video_id' => $video->getId()]);
        $isFavoriteVideo = $favoriteVideos->count() > 0;

        return $this->layout->renderTemplate($this->template,
            [
                'video' => $video,
                'isFavoriteVideo' => $isFavoriteVideo
            ]
        );
    }
}