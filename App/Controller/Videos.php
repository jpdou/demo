<?php

namespace App\Controller;

use App\Model\Http;
use App\Model\Http\Request;

class Videos extends AbstractController
{
    public function __construct(
        Http $http,
        Request $request
    ) {
        parent::__construct($http, $request);
    }

    public function fetch()
    {
    }
}