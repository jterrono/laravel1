<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestApiController extends Controller
{
	private $username = 'james.terrono@furthered.com';
	private $password = 'password';
	private $url = 'hello-james.dev';

	function send_curl($destination = null, $method = false, $params = array() )
	{
		//$method = 'GET';
        $url = $this->url . '/' . $destination;

        $headers = array("Content-Type: application/json; charset=utf-8", "API-USERNAME: $this->username", "API-KEY: $this->password");
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        if($method)
        {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        }
        if(!empty($params))
        {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
        }
        $result = curl_exec($curl);
        echo '------------------';
        print_r($result);
        curl_close($curl);
        echo '<pre>';
        print_r(json_decode($result));
        echo '</pre>';
	}

     /**
     * List ALL Products
     *
     */
    function list_products()
    {
    	$this->send_curl('get_products');
    }

    function add_product()
    {
    	$input = array(
    		'name' => 'API Product',
    		'description' => 'API DESCRIPTION',
    	);

    	$this->send_curl('product', 'POST', $input);
    }

    function get_product($id)
    {
    	$this->send_curl('product/2');
    }

    function get_products()
    {
    	$this->send_curl('products');
    }

    function update_product()
    {
    	$this->send_curl('product/2', 'PUT', array('description' => 'api test description'));
    }

    function delete_product()
    {
    	$this->send_curl('product/3', 'DELETE');
    }

    function get_user_products()
    {
    	$this->send_curl('');
    }

}
