<?php

namespace Chrisbjr\ApiGuard\Http\Controllers;

use Config;
use Exception;
use League\Fractal\Manager;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use EllipseSynergie\ApiResponse\Laravel\Response;


class ApiGuardController extends Controller
{
    public $apiKey = null;
    public $apiLog = null;

    

    public function __construct()
    {
        dd('aa');
       // $this->apiMethods = 10;
        //$serializedApiMethods = serialize($this->apiMethods);

        // Let's instantiate the response class first
        $manager = new Manager;

        // Launch middleware
        $this->middleware('apiguard:'.$serializedApiMethods);

        $manager->parseIncludes(Input::get(Config::get('apiguard.includeKeyword', 'include'), 'include'));

        $this->response = new Response($manager);
    }
}
