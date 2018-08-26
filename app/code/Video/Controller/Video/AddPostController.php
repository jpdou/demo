<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/26
 * Time: 16:13
 */

namespace Video\Controller\Video;


use System\Controller\AbstractController;
use Video\Model\Video;

class AddPostController extends AbstractController
{
    public function execute()
    {
        $identifier = $this->request->get('identifier');
        $originHref = $this->request->get('origin_href');


        if ($identifier && $originHref) {
            /** @var Video $video */
            $video = $this->objectManager->create(Video::class);
            $video->load($identifier, 'identifier');

            if (!$video->getId()) {
                $video->setIdentifier($identifier)
                    ->setOriginHref($originHref)
                    ->save();
                echo 'success';
            } else {
                echo 'Already existed';
            }
        } else {
            echo 'Failed';
        }
    }
}