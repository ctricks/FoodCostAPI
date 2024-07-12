<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;  // add the User model

class UserController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
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
    public function UserDetails($id)
    {
        $data = auth()->user();
        $UserData = user::where('id',$id)->first();
        $dataID = $data['id'];
        $isAdmin = user::where('id',$dataID)->value('isAdmin');


        $isUserAdmin = user::where('id',$id)->value('isAdmin');
        $isAdmin = $isAdmin == 1 ? 'Administrator':'';
        $isUserAdmin = $isUserAdmin == 1 ? 'Administrator':'User';
        

        
        $returnJson = response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'User fetched successfully!',
            ],
            'data' => [                
                'Role' => $isUserAdmin,
                'Details'=>$UserData
            ],
        ]);

        if($isAdmin == '')
        {
            $returnJson = response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'Error',
                    'message' => 'Warning: You\'re not allowed to see this.',                    
                ]                
            ]); 
        }

        if($UserData == null && $isAdmin != '')
        {
            $returnJson = response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'No User Found!',
                ]
            ]);
        }

        return $returnJson;
    }
    public function All()
    {
        $data = auth()->user();
        $id = $data['id'];

        $isAdmin = user::where('id',$id)->value('isAdmin');

        if($isAdmin == '')
        {
            return $returnJson = response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'Error',
                    'message' => 'Your not allow to see this.',
                ]                
            ]); 
        }

        return user::all();
        // return response()->json([
        //     'meta' => [
        //         'code' => 200,
        //         'status' => 'success',
        //         'message' => 'User fetched successfully!',
        //     ],
        //     'data' => [                
        //         'Role' => $id,
        //         'Details'=>$data
        //     ],
        // ]);
        
    }
    public function UpdateUser(Request $request,$id)
    {
        //$UserData = user::find($request['id']);
        $UserData = user::find($id);

        $UserData->update($request->all());

         return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'User updated successfully!',
            ],
            'data' => [                                
                'Details'=>$UserData
            ],
        ]);
    }
    public function UpdateUserDelete($id)
    {
        //$UserData = user::find($request['id']);
        $UserData = user::find($id);        
        $UserData->isActive = 0;
        $UserData->save();

         return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'User deleted successfully!',
            ],
            'data' => [                                
                'Details'=>$UserData
            ],
        ]);
    }
    public function UserDelete($id)
    {
        //$UserData = user::find($request['id']);
        $UserData = user::find($id);        
        
        if ($UserData) {
            // Delete the record
            $UserData->delete();
        }

         return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'User deleted successfully!',
            ]
        ]);
    }
}
