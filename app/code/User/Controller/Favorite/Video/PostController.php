<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/24
 * Time: 23:13
 */

namespace User\Controller\Favorite\Video;

use System\Controller\AbstractController;
use System\Model\Http\Request;
use System\Model\Layout;
use System\Model\db;
use User\Model\Favorite\Video as FavoriteVideo;

class PostController extends AbstractController
{
    public function __construct(
        Request $request,
        Layout $layout
    ) {
        parent::__construct($request, $layout);
    }

    public function execute()
    {
        $videoId = $this->request->get('video_id');
        $isCancel = (bool) $this->request->get('cancel');

        if ($videoId) {
            $userId = $_SESSION['user_id'];

            /** @var FavoriteVideo $favoriteVideo */
            $favoriteVideo = $this->objectManager->get(FavoriteVideo::class);
            $favoriteVideoCollection = $favoriteVideo->getCollection();
            $favoriteVideoCollection->getCountSelect()
                ->where(['user_id' => $userId, 'video_id' => $videoId]);

            $count = $favoriteVideoCollection->count();

            if ($isCancel) {
                if ($count) {
                    /** @var db $db */
                    $db = $this->objectManager->get(db::class);
                    $db->delete($favoriteVideo->getTable(), ['user_id' => $userId, 'video_id' => $videoId]);
                }
            } else {
                if (!$count) {
                    $favoriteVideo->setUserId($userId)
                        ->setVideoId($videoId)
                        ->save();
                }
            }

        }
    }

}