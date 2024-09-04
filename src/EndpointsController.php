<?php

namespace Symbiote\ApiWrapper;

use SilverStripe\Control\Controller;

class EndpointsController extends Controller
{
    use WrappedApi;

    private static array $allowed_actions = [
        'list'
    ];

    public function list()
    {
        return $this->sendResponse(['items' => ['TODO']]);
    }
}
