<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/20
 * Time: 15:21
 */

namespace Video\Controller\Actress;

use System\Controller\AbstractController;
use System\Model\Http\Request;
use System\Model\Layout;
use Video\Model\Actress;

class ViewController extends AbstractController
{
    public function __construct(
        Request $request,
        Layout $layout
    ) {
        parent::__construct($request, $layout);
        $this->template = 'actress_view';
    }


    public function execute()
    {
        $userId = isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : 0;
        $collection = [];
        if ($userId) {
            /** @var Actress $actress */
            $actress = $this->objectManager->create(Actress::class);

            $collection = $actress->getCollection();

            $collection->getSelect()
                ->join(
                ['subscribed' => 'user_subscribed_actress'],
                'e.id = subscribed.actress_id',
                []
            )->where('subscribed.user_id = '. $userId);

            $collection->load();
        }

        return $this->layout->renderTemplate($this->template, ['actresses' => $collection]);
    }

}