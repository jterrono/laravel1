<?php

//use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{

    /**
     * Get ALL Products
     *
     * Testing for a Successful response in getting all active products in the database.
     *
     * @return void
     */
    public function testGetProductsSuccess()
    {
        //$this->withoutMiddleware();

        $response = $this->call('GET', '/products/');

		$json = json_decode($response->getContent());
		
		if(count($json->data) > 0 && $json->data != "")
		{	
        	$this->assertEquals(200, $response->status());
        	$this->assertEquals(1, $json->success);
        }

    }

    /**
     * Get ALL Products
     *
     * Testing for a Failed response in getting all products in the database.
     *
     * @return void
     */
    public function testGetProductsNegative()
    {
        //$this->withoutMiddleware();

        $response = $this->call('GET', '/products/');
      //  dd($response);
		$json = json_decode($response->getContent());

		if(count($json->data) == 0)
		{
        	$this->assertEquals(404, $response->status());
        	$this->assertEquals(0, $json->success);
        }

    }

    /**
     * Update Product
     *
     * Testing for a POSITIVE response in updating a product
     *
     * @return void
     */
    public function testUpdateProductSuccess()
    {
    	//$this->withoutMiddleware();

    	$post_data = array(
    		'name' => 'Pants',
    		'description' => 'Red Pants',
    		'price' => '299.99'
    	);

    	$response = $this->call('PUT', '/product/2', $post_data);

    	$json = json_decode($response->getContent());


    	$this->assertEquals(200, $response->status());
    	$this->assertEquals(1, $json->success);
    }

    /**
     * Update Product
     *
     * Testing for a NEGATIVE response in updating a product
     *
     * @return void
     */
    public function testUpdateProductMissingInput()
    {
    	//$this->withoutMiddleware();

    	$post_data = array(
    		'name' => 'Pants'
    	);

    	$response = $this->call('PUT', '/product/2', $post_data);
    	
    	$json = json_decode($response->getContent());


    	$this->assertEquals(400, $response->status());
    	$this->assertEquals(0, $json->success);
    }


    
    /**
     * Update Product
     *
     * Testing for a NEGATIVE response in updating a product
     *
     * @return void
     */
    public function testUpdateProductNotFound()
    {
    	//$this->withoutMiddleware();

    	$post_data = array(
    		'name' => 'Pants'
    	);

    	$response = $this->call('PUT', '/product/22', $post_data);
    	
    	$json = json_decode($response->getContent());

    	//dd($response);
    	$this->assertEquals(404, $response->status());
    	$this->assertEquals(0, $json->success);
    }

    /**
     * Delete Product
     *
     * Testing for a Successful response in deleting a product
     *
     * @return void
     */
    public function testDeleteProductSuccessful()
    {
    	//$this->withoutMiddleware();

    	$response = $this->call('DELETE', '/product/2');
    	
    	$json = json_decode($response->getContent());


    	$this->assertEquals(200, $response->status());
    	$this->assertEquals(1, $json->success);
    }

    /**
     * Delete Product
     *
     * Testing for a Failed response in deleting a product
     *
     * @return void
     */
    public function testDeleteProductNotFound()
    {
    	//$this->withoutMiddleware();

    	$response = $this->call('DELETE', '/product/10');
    	
    	$json = json_decode($response->getContent());


    	$this->assertEquals(404, $response->status());
    	$this->assertEquals(0, $json->success);
    }


    /**
     * Create Product
     *
     * Testing for a POSITIVE response in creating a product
     *
     * @return void
     */
    public function testCreateProductSuccess()
    { 
    	//$this->withoutMiddleware();

    	$post_data = array(
    		'name' => 'Pants11',
    		'description' => 'Blue Pants',
    		'price' => '299'
    	);

    	$response = $this->call('POST', '/product', $post_data);

    	$json = json_decode($response->getContent());


    	$this->assertEquals(201, $response->status());
    	$this->assertEquals(1, $json->success);
    	
    }


	/**
     * Create Product
     *
     * Testing for a NEGATIVE response in creating a product
     *
     * @return void
     */
    public function testCreateProductFailure()
    {
    	//$this->withoutMiddleware();

    	$post_data = array(
    		'name' => 'Pants',
    		'description' => 'Blue Pants'
    	);

    	$response = $this->call('POST', '/product', $post_data);

    	$json = json_decode($response->getContent());

    	
    	$this->assertEquals(400, $response->status());
    	$this->assertEquals(0, $json->success);
    }

/*
    public function testFileUpload()
    {
    	$this->withoutMiddleware();

    	$uploadedFile = new Symfony\Component\HttpFoundation\File\UploadedFile('/home/vagrant/Code/hello-james/' . '/lawline.jpeg', 'lawline.jpeg', null, null, null, true);

    	$response = $this->call('POST', '/product_image', [], [], ['filetest' => $uploadedFile]);
    }
*/
  

}