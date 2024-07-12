<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; 

class ProductController extends Controller
{
    //
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function me() 
    {
        // use auth()->user() to get authenticated user data

        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'User fetched successfully!',
            ],
            'data' => [
                'user' => auth()->user(),
            ],
        ]);
    }
    public function AddProduct(Request $request)
    {
        // validate the incoming request
        // set every field as required
        // set email field so it only accept the valid email format

        $this->validate($request, [
            'ProductCode' => 'required|string|min:2|max:255',
            'Name' => 'required|string|max:255|unique:users',
            'Cost' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'Price' => 'required|regex:/^\d+(\.\d{1,2})?$/'            
        ]);

        // if the request valid, create user
        //CB-07092024 Adding isAdmin and Remarks Column into database
        $user = $this->product::create([
            'ProductCode' => $request['ProductCode'],
            'InsysProductId' => $request['InsysProductId'],
            'InsysProductCode' => $request['InsysProductCode'],
            'Name' => $request['Name'],
            'Cost' => $request['Cost'],
            'Price' => $request['Price'],
            'modelId' => $request['modelId'],
            'categoryId' => $request['categoryId']
        ]);

       
        // return the response as json 
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Product created successfully!',
            ]
        ]);
    }
    public function getAllProduct()
    {
        return product::all();
    }
    public function getProductByID($id)
    {
        $ProductData = product::where('id',$id)->first();
        

        if($ProductData)
        {
            $returnJson = response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Product found successfully!',
                ],
                'data' => [                
                    'Details'=>$ProductData
                ],
            ]);
        }else
        {
            $returnJson = response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'error',
                    'message' => 'Product not found!',
                ],
                'data' => [                
                    'Details'=>$ProductData
                ],
            ]);
        }

        return $returnJson;
    }
}
