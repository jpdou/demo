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
        $actressId=  $this->request->get('actress', 0);

        /** @var Actress $actress */
        $actress = $this->objectManager->create(Actress::class);
        $actress->load($actressId);

        /** @var \User\Model\Favorite\Actress $favoriteActress */
        $favoriteActress = $this->objectManager->get(\User\Model\Favorite\Actress::class);
        $collection = $favoriteActress->getCollection();
        $select = $collection->getCountSelect();
        $select->where(['user_id' => $_SESSION['user_id'], 'actress_id' => $actressId]);
        $isFavoriteActress = $collection->count() > 0;

        return $this->layout->renderTemplate($this->template,
            [
                'actress' => $actress,
                'isFavoriteActress' => $isFavoriteActress,
            ]
        );
    }

}