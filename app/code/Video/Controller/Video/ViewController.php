<?php

namespace Video\Controller\Video;

use System\Model\Http\Request;
use System\Model\Layout;
use Video\Model\Video;
use System\Controller\AbstractController;

class ViewController extends AbstractController
{
    public function __construct(
        Request $request,
        Layout $layout
    ) {
        parent::__construct($request, $layout);
        $this->template = 'video.phtml';
    }

    public function execute()
    {
        $videoId = $this->request->get('video');

        /** @var Video $video */
        $video = $this->objectManager->create(Video::class);

        $video->load($videoId);

        return $this->layout->renderTemplate($this->template, ['video' => $video]);
    }
}