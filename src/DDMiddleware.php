<?php

namespace DorsetDigital\HTTP2;

use SilverStripe\Control\Middleware\HTTPMiddleware;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Config\Configurable;
use SilverStripe\Core\Injector\Injectable;
use SilverStripe\Control\Director;
use SilverStripe\View\Requirements;
use SilverStripe\Control\HTTPResponse;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Core\Manifest\ResourceURLGenerator;

class DDMiddleware implements HTTPMiddleware
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
        $headerParts = [];
        foreach ($js as $script) {
            $headerParts[] = '<' . $this->pathForFile($script) . '>; rel=preload; as=script';
        }

        $css = array_keys($reqs->getCSS());

        foreach ($css as $style) {
            $headerParts[] = '<' . $this->pathForFile($style) . '>; rel=preload; as=style';
        }


        $scripts = implode(",", $headerParts);
        $response->addHeader('Link', $scripts);

        return $response;
    }

    private function pathForFile($fileOrUrl)
    {
        // Since combined urls could be root relative, treat them as urls here.
        if (preg_match('{^(//)|(http[s]?:)}', $fileOrUrl) || Director::is_root_relative_url($fileOrUrl)) {
            return $fileOrUrl;
        } else {
            return Injector::inst()->get(ResourceURLGenerator::class)->urlForResource($fileOrUrl);
        }
    }


}
