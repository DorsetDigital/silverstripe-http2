<?php

namespace DorsetDigital\HTTP2;

use    SilverStripe\Control\Middleware\HTTPMiddleware;
use    SilverStripe\Control\HTTPRequest;
use    SilverStripe\Core\Config\Configurable;
use    SilverStripe\Core\Injector\Injectable;
use    SilverStripe\Control\Director;
use SilverStripe\View\Requirements;
use SilverStripe\Control\HTTPResponse;

class    DDMiddleware implements HTTPMiddleware
{

    use    Injectable;
    use    Configurable;

    /**
     * @config
     * Is the module enabled or disabled
     * @var boolean
     */
    private static $enabled = false;

    /**
     * Process the request
     * @param HTTPRequest $request
     * @param $delegate
     * @return
     */
    public function process(HTTPRequest $request, callable $delegate)
    {

        $response = $delegate($request);

        if ($this->config()->get('enabled') !== true) {
            return $response;
        }

        $reqs = Requirements::backend();
        $js = array_keys($reqs->getJavascript());
        $newJS = [];
        foreach ($js as $script) {
            $newJS[] = Director::absoluteURL($script);
        }

        $scripts = implode(",", $newJS);
        $response->addHeader('X-Link', $scripts);

        return $response;
    }


}
