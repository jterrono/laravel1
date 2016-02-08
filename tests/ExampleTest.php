<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Http\Response;

use App\ApiController;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testGetproducts()
    {
        
       
    }

    public function testGetProduct()
    {
        //$this->call('GET', '/product/1');

        //dd($response);
      //  $data = $this->parseJson($response);

        //dd(json_decode($response));
    }
/*
    public function testCreateProduct()
    {
        $product = array(
            'name' => 'TESTING NAME',
            'description' => "TEST",
            'price' => '199'
        );

     //   $response = $this->call('POST', '/product', $product);

        
    }
*/

}
