<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UplProduct;

class UploadProductController extends Controller
{
    //
    public function __construct(uplproduct $product)
    {
        $this->uplproduct = $product;
    }
    public function me() 
    {
        // use auth()->user() to get authenticated user data
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Product fetched successfully!',
            ]           
        ]);
        
    }
    public function NewUpload(Request $request)
    {
        $this->validate($request, [
            'ProductCode' => 'required|string|min:2|max:255',
            'Name' => 'required|string|max:255|unique:users',
            'Cost' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'Price' => 'required|regex:/^\d+(\.\d{1,2})?$/'            
        ]);

        // if the request valid, create user
        //CB-07092024 Adding isAdmin and Remarks Column into database
        $user = $this->uplproduct::create([
            'ProductCode' => $request['ProductCode'],
            'InsysProductId' => $request['InsysProductId'],
            'InsysProductCode' => $request['InsysProductCode'],
            'Name' => $request['Name'],
            'Cost' => $request['Cost'],
            'Price' => $request['Price'],
            'modelId' => $request['modelId'],
            'categoryId' => $request['categoryId'],
            'status'=> 1,
            'UploadFile'=>$request['UploadFile']            
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
    public function CheckUpload($filename)
    {
        $uplProduct = uplproduct::selectRaw('
                                    ProductCode,InsysProductId,InsysProductCode,uplproducts.Name,Cost,Price,
                            case when productcategory.Name is NUll then \'Not Found\' else productcategory.Name end as Category,
                            case when productmodel.Name is NUll then \'Not Found\' else productmodel.Name end as Model,
                            case when productcategory.Name is NUll then \'Category Not Found\'
                            when productmodel.Name is NUll then \'Model Not Found\' 
                            when (select count(*) from products where productcode = uplproducts.productcode) = 1 then \'Product is Already in Record\'
                            else uplproducts.Remarks end as Remarks,
                            uplproducts.ApproveDate
                        ')
                        ->leftjoin('productcategory','uplproducts.categoryid','=','productcategory.id') 
                        ->leftjoin('productmodel','uplproducts.modelid','=','productmodel.id') 
                        ->where('UploadFile','=',$filename)                                       
                        ->get();

        if($uplProduct->count() > 0)
        {
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Product fetched successfully!',
                ],
                'data' => [
                    'details' => $uplProduct
                ],
            ]);
        }else
        {
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'error',
                    'message' => 'No Upload File found.!',
                ],
                'data' => [
                    'details' => $uplProduct
                ],
            ]);
        }
    }
    public function UploadApproved($id)
    {
        
    }
}
