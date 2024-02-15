<?php

namespace App\Http\Controllers\Client\Areas;

use Exception;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class AreaClientController extends Controller
{
    /**
     * Function to store areas
     */
    public function store(Request $request){
        try{
            DB::beginTransaction();
            $rules = [
                'addAreaCountryId' => 'required|exists:countries,id',
                'addAreaStateId' => 'required|exists:states,id',
                'addAreaCityId' => 'required|exists:cities,id',
                'areaTitle' => 'required|unique:nhapk_areas,name',
            ];
            $this->validate($request, $rules);
            $areas = new Area();
            $areas->name = $request->areaTitle;
            $areas->description = $request->areaDescription;
            $areas->countryId = $request->addAreaCountryId;
            $areas->stateId = $request->addAreaStateId;
            $areas->cityId = $request->addAreaCityId;
            $areas->addBy = 'user';
            $result = $areas->save();
            if(!($result)){
                DB::commit();
                return response()->json([
                    'status' => 'error',
                    'message' => 'There is an error while saving the area. Kindly try again.',
                ]);
                return redirect()->back()->with('error', 'There is an error while saving the area. Kindly try again.');
            }
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully! Area Saved Now.',
                'areas' => $areas,
            ]);
        }
        catch(ValidationException $validationException){
            return response()->json([
                'status' =>'validationErrors',
                'errors' => $validationException->validator->getMessageBag()
            ], 422);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is: '.$e->getMessage(),
            ], 500);
        }
    }
}
