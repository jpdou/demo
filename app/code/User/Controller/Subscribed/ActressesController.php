<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/20
 * Time: 15:21
 */

namespace User\Controller\Subscribed;

use System\Controller\AbstractController;
use System\Model\Http\Request;
use System\Model\Layout;
use Video\Model\Video;

class ActressesController extends AbstractController
{
    public function __construct(
        Request $request,
        Layout $layout
    ) {
        parent::__construct($request, $layout);
        $this->template = 'user_actress';
    }


    public function execute()
    {
        $userId = isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : 0;
        $collection = [];
        if ($userId) {
            /** @var Video $video */
            $video = $this->objectManager->create(Video::class);

            $collection = $video->getCollection();

            $collection->getSelect()
                ->join(
                'actress_video',
                'e.id = actress_video.video_id',
                []
            )->join(
                ['subscribed' => 'user_subscribed_actress'],
                'actress_video.actress_id = subscribed.actress_id',
                []
            )->where('subscribed.user_id = '. $userId);

            $collection->load();
        }

        return $this->layout->renderTemplate($this->template, ['videos' => $collection]);
    }

}