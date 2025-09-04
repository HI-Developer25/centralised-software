<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Service\UserService;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Validator;

class UserController extends Controller
{
    public function __construct(protected ApiResponse $apiResponse, protected UserService $user) {}
    public function index() {
        $keyword = request()->keyword;
        $users = User::where("username", "like", "%$keyword%")->paginate(8);

        return UserResource::collection($users);
    }

    public function store() {

        $validator = Validator::make(request()->all(), [
            "username" => [ "required" ],
            "fullname" => [ "required" ],
            "email" => [ "required", "email" ],
            "password" => [ "required" ],
            "permissions" => [ "required" ]
        ]);


        if($validator->fails()) {
            $this->apiResponse->error(422, $validator->errors());
        }


        DB::transaction(function() use($validator) {

            $user = User::create($validator->validated());

            $user->givePermissionsToUser(json_decode(request()->permissions));

        });

        return $this->apiResponse->success("User has been created!");
    }
    public function privileges() {
        return $this->user->getAbilities();
    }
    public function update(User $user) {
        $rules = [
            "username" => [ "required" ],
            "fullname" => [ "required" ],
            "email" => [ "required", "email" ],
            "permissions" => [ "required" ]
        ];

        if(request()->has("password")) {
            $rules["password"] = [ "required" ];
        }

        $validator = Validator::make(request()->all(), $rules);


        if($validator->fails()) {
            $this->apiResponse->error(422, $validator->errors());
        }

        DB::transaction(function() use($validator, $user) {

            // Updating User information
            $user->update($validator->validated());
            
            // Giving Permission to that specific user
            $user->givePermissionsToUser(json_decode(request()->permissions));

            // Deleting all tokens, which are created by that user
            $user->tokens()->delete();
       
        });

        return $this->apiResponse->success("User has been updated!");
    }
    public function delete(User $user) {
        if(!$user) {
            throw new ModelNotFoundException("User not found");
        }

        \Illuminate\Support\Facades\DB::transaction(function() use ($user) {
            $user->tokens()->delete();
            $user->delete();
        });

        return $this->apiResponse->success("User has been deleted");
    }
}
