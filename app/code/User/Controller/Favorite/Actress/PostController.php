<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/24
 * Time: 23:13
 */

namespace User\Controller\Favorite\Actress;

use System\Controller\AbstractController;
use System\Model\Http\Request;
use System\Model\Layout;
use System\Model\db;
use User\Model\Favorite\Actress as FavoriteActress;

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
        $actressId = $this->request->get('actress_id');
        $isCancel = (bool) $this->request->get('cancel');

        if ($actressId) {
            $userId = $_SESSION['user_id'];

            /** @var FavoriteActress $favoriteActress */
            $favoriteActress = $this->objectManager->get(FavoriteActress::class);
            $favoriteActressCollection = $favoriteActress->getCollection();
            $favoriteActressCollection->getCountSelect()
                ->where(['user_id' => $userId, 'actress_id' => $actressId]);

            $count = $favoriteActressCollection->count();

            if ($isCancel) {
                if ($count) {
                    /** @var db $db */
                    $db = $this->objectManager->get(db::class);
                    $db->delete($favoriteActress->getTable(), ['user_id' => $userId, 'actress_id' => $actressId]);
                }
            } else {
                if (!$count) {
                    $favoriteActress->setUserId($userId)
                        ->setActressId($actressId)
                        ->save();
                }
            }

        }
    }

}