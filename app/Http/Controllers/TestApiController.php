<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestApiController extends Controller
{
	private $username = 'james.terrono@futhered.com';
	private $password = 'password';
	private $url = 'hello-james.dev';

	function send_curl($destination = null, $method = false, $params = array() )
	{
		//$method = 'GET';
        $url = $this->url . '/' . $destination;

        $headers = array("Content-Type: application/json; charset=utf-8", "API-USERNAME: $this->username", "API-KEY: $this->password");
        $headers = array("Content-Type: application/json; charset=utf-8", "API-USERNAME: $this->username", "API-KEY: $this->password");
        //$headers = array("Content-Type: application/json; charset=utf-8", "X-Authorization: 8c19a4c01cd97a72bf751a8a5a7f399ef6f004f7");
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
        //echo '------------------';
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
    	$this->send_curl('product/10', 'DELETE');
    }

    function get_user_products()
    {
    	$this->send_curl('/user/products');
    }

    function add_user_product()
    {
        $input = array('product_id' => '7');

        $this->send_curl('/user/product', 'POST', $input);
    }

    function delete_user_product()
    {
        $input = array('product_id' => '7');

        $this->send_curl('/user/product', 'DELETE', $input);
    }

    function update_product_image()
    {
        /*
        $filename = app_path() . '/public/lawline.jpeg';

        $cfile = $this->getCurlValue($filename,'image/jpeg','cattle-01.jpg');
        
        $data = array('file22' => $cfile);
*/
        $file = app_path() . '/public/lawline.jpeg';
$filename = basename($file);
$data = [
    'uploaded_file' => curl_file_create($file, 'image/jpeg', $filename),
];

        $this->send_curl('/product_image', 'POST', $data);
    }


    function getCurlValue($filename, $contentType, $postname)
    {
        // PHP 5.5 introduced a CurlFile object that deprecates the old @filename syntax
        // See: https://wiki.php.net/rfc/curl-file-upload
        if (function_exists('curl_file_create')) {

            return curl_file_create($filename, $contentType, $postname);
        }
     
        // Use the old style if using an older version of PHP
        $value = "@{$this->filename};filename=" . $postname;
        if ($contentType) {
            $value .= ';type=' . $contentType;
        }
     
        return $value;
    }
    


}
