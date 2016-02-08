<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;

use App\Product;
use App\User;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response as LaravelResponse;
use Input;


class ApiController extends Controller
{

    /**
      * Get User ID
      *
      * This method will return the logged in users ID.
      *
      * @return int $user->id
      */
    private function getUserId()
    {
        $user = Auth::user();
        dd('zzz');
        return $user->id;
    }

    /**
     * _Output
     *
     * This function will return the JSON response.
     *
     * @return JSON
     */
    private function _output($success = 1, $txt = '', $data = null, $code = 200)
    {
        return response()->json(
            [
                'success' => $success,
                'response_text' => $txt,
                'data' => (empty($data)) ? '' : $data,
            ], 
            $code
        );
    }

    /**
     * Response 404
     *
     * Method will return the default 404 response.
     *
     */
    private function _output_404()
    {
        return $this->_output('0', 'Not Found', '', '404'); 
    }

    /**
     * Response Ok
     *
     * Method will return the default 200 response.
     *
     */
    private function _output_200($data = null)
    {
        return $this->_output('1', 'Success', $data, '200'); 
    }

    /**
     * Response Created
     *
     * Method will return the default 201 response.
     *
     */
    private function _output_201($data = null)
    {
        return $this->_output('1', 'Success', $data, '201'); 
    }

    /**
     * Response Form Validation Error
     *
     * Method will return the default form validation errors response.
     *
     */
    private function _output_errors()
    {

    }




    /**
     * Get ALL Products
     *
     * Returns all active products in the database.
     *
     * @return json
     */
    public function get_products()
    {   

    	$products = Product::where('status', '=', '1')

                            ->get();

        dd($products);
        if($products->isEmpty())
        {
            return $this->_output_404();
        }

        
    	return $this->_output_200($products); 
    }


    /**
     * Get Product
     *
     * Returns the product based off the id that is passed.
     *
     * @return json
     */
    public function get_product($id)
    { 
    	$product = Product::where('status', '=', '1')->find($id);

        if(!$product)
        {
            return $this->_output_404(); 
        }


    	return $this->_output_200($product); 
    }


    /**
     * Create Product
     *
     * This method will validate the input & will create a record in the database if 
     * it passed.
     *
     * @return
     */
    public function add_product(REQUEST $request)
    {	
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        if($validator->fails())
        {
            return $this->_output('0', 'Error', $this->formatValidationErrors($validator), '400'); 

        }
    	
        
    	Product::create($request->input());

        return $this->_output_201(); 
    }


    /**
     * Update Product
     *
     * Method will update a products(name, description, price).
     *
     */
    public function update_product($id, Request $request)
    {
        $product = Product::find($id);
        
        if(!$product)
        {
            return $this->_output_404();
        }

        
    	$validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        if($validator->fails())
        {	
            return $this->_output('0', 'Error', $this->formatValidationErrors($validator), '400'); 
        }

        $product->update($request->input());
    	

        return $this->_output_200(); 
    }


    /**
     * Delete a product
     *
     * Method will get passed a product ID, Find that product & then delete it.
     *
     */
    public function delete_product($id)
    {
    	$product = Product::where('status', '=', '1')->find($id);
        
        if(!$product)
        {
            return $this->_output_404();
        }
    
    	$product->update(array('status' => '0'));


        return $this->_output_200();
    }



    /**
     * Attach User Product
     *
     * Method will attach a product to a user.
     */
    public function add_user_product(REQUEST $request)
    {

    	$user = User::find($this->$this->getUserId());

        $validator = Validator::make($request->all(), [
            'product_id' => 'required'
        ]);

        if($validator->fails())
        {
            

            return response()->json([
            'success' => '0',
            'data' => $this->formatValidationErrors($validator)], 200);

        }

    	$user->products()->attach($request->product_id);

        return $this->_output_201();

    }

    /**
     * List all User Products
     *
     * Method will list all active products user has attached to them.
     *
     */
    public function get_user_products()
    {   
    	$products = User::find($this->getUserId())
                        
                        ->products()

                        ->where('product_user.status', '=', '1')

                        ->get();
        

    	return $this->_output_200($products);
    }


    /**
     * Detach User Product
     *
     * Method will detach/remove an attached product from user.
     *
     */
    public function delete_user_product(REQUEST $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json([
            'success' => '0',
            'data' => $this->formatValidationErrors($validator)], 200);

        }

    	$user = User::find($this->getUserId())->products()->updateExistingPivot($request->product_id, array('status' => '0'));

        return $this->_output_200();
    }



/*

    public function product_image($id, REQUEST $request)
    {   dd($id);

        $dir_path = base_path() . '/public/uploads/';
        $file = $request->file('filetest');

        if($file->isValid())
        {
            $file->move($dir_path);


        }

    }
    */
}
