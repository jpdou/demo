<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/25
 * Time: 14:55
 */

namespace User\Controller\Favorite\Actress;


use System\Controller\AbstractController;
use System\Model\Http\Request;
use System\Model\Layout;
use Video\Model\Actress;

class GridController extends AbstractController
{
    private $pageCount = 30;

    public function __construct(
        Request $request,
        Layout $layout
    ) {
        parent::__construct($request, $layout);
        $this->template = 'actress_grid';
    }

    public function execute()
    {
        /** @var Actress $actress */
        $actress = $this->objectManager->create(Actress::class);
        $actresses = $actress->getCollection();
        $select = $actresses->getSelect();

        /** @var \User\Model\Favorite\Actress $favoriteActress */
        $favoriteActress = $this->objectManager->get(\User\Model\Favorite\Actress::class);
        $select->join(
            ['favorite' => $favoriteActress->getTable()],
            'e.id = favorite.actress_id',
            []
        )->where(['favorite.user_id' => $_SESSION['user_id']]);

        $page = (int) $this->request->get('p', 1);
        $page = ($page - 1) < 0 ? 0 : $page - 1;

        $select->offset($page * $this->pageCount);
        $select->limit($this->pageCount);

        $actresses->load();

        return $this->layout->renderTemplate($this->template, ['actresses' => $actresses, 'pageCount' => $this->pageCount]);
    }
}