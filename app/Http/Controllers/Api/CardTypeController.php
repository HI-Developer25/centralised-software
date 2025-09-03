<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CardTypeRequest;
use App\Http\Resources\CardTypeResource;
use App\Models\CardType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CardTypeController extends Controller
{
    public function __construct(protected ApiResponse $apiResponse) {
        $this->middleware("auth:sanctum");
    }
    public function store(CardTypeRequest $request) {
        $card_type = CardType::create($request->validated());

        return $this->apiResponse->success("Card Type is created");
    }
    public function index() {
        $keyword = request()->keyword;
        $cardType = CardType::where("card_name", "LIKE", "%$keyword%")
                                ->orWhere("card_color", "LIKE", "%$keyword%")
                                ->orWhere("shade_color", "LIKE", "%$keyword%")
                                ->paginate(8);

        return CardTypeResource::collection($cardType);
    }
    public function getAll() {
        $cardType = CardType::all();
        return CardTypeResource::collection($cardType);
    }
    public function destroy(CardType $cardType) {
        if(!$cardType->exists()) return throw new ModelNotFoundException("Card Type not found");

        $cardType->delete();

        return $this->apiResponse->success("Card Type has been deleted successfully");
    }
    public function update(CardTypeRequest $request, CardType $cardType) {
        $cardType->update($request->validated());

        return $this->apiResponse->success("Card Type has been updated!");
    }
    public function childMemberships() {
        $cardTypes = CardType::whereIn("card_name", [
            "temporary",
            "Temporary",
            "child",
            "Child",
            "household",
            "Household"
        ])->get();

        return $this->apiResponse->success("Card types fetched", $cardTypes);
    }
    
    public function getTypes() {
        $cardTypes = CardType::select('id', 'card_name')->get();
        
        return $this->apiResponse->success("Card types fetched", $cardTypes);
    }
}
