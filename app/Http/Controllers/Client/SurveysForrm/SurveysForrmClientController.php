<?php

namespace App\Http\Controllers\Client\SurveysForrm;

use Exception;
use Illuminate\Http\Request;
use App\Models\DynamicSurveysForms;
use App\Http\Controllers\Controller;
use App\Models\DynamicSurveysFromResponse;
use Illuminate\Validation\ValidationException;

class SurveysForrmClientController extends Controller
{
    /**
     * Function to show survey forms tile to client
     */
    public function viewSurveyForms(){
        try{
            $dynamicSurveysForms = DynamicSurveysForms::all();
            return view('client.survey-forms.select-survey-form')->with([
                'dynamicSurveysForms' => $dynamicSurveysForms,
            ]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }
    
    /**
     * Function to show survey forms tile to client
     */
    public function postResponseSurveyForms(Request $request){
        try{
            $rules = [
                'dynamicSurveysFromId' => 'required|exists:nhapk_dynamic_surveys_forms,id',
            ];
            $this->validate($request,$rules);
            $dynamicSurveysForms = DynamicSurveysForms::find($request->dynamicSurveysFromId);
            // dd($dynamicSurveysForms->toArray());
            if(!($dynamicSurveysForms)){
                return redirect()->back()->with('invalid','Your are accessing invalid forms. Kindly access the valid one.');
            }
            return view('client.survey-forms.post-response-survey-forms')->with([
                'dynamicSurveysForms' => $dynamicSurveysForms,
            ]);
        }
        catch(ValidationException $validationError){
            return redirect()->back()->withErrors($validationError->validator->getMessageBag())->withInput();
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }
    
    
    /**
     * Function to store survey forms response from the  client to the table
     */
    public function storeResponseSurveyForms(Request $request){
        try{
            $dynamicSurveysForms = DynamicSurveysForms::find($request->dynamicSurveysFormsId);
            if(!($dynamicSurveysForms)){
                return redirect()->back()->with('invalid','Your are accessing invalid forms. Kindly access the valid one.');
            }
            $validatedData = $request->validate([
                'dynamicSurveysFormsId' => 'required|exists:nhapk_dynamic_surveys_forms,id',
                'responses' => 'required|array',
            ]);
            // dd($request->all());
            $dynamicSurveysFormsId = $validatedData['dynamicSurveysFormsId'];
            $responses = $validatedData['responses'];
    
            foreach ($responses as $fieldLabel => $responseValue) {
                $formResponse = new DynamicSurveysFromResponse();
                $formResponse->dynamicSurveysFromsId = $dynamicSurveysFormsId;
                $formResponse->field_label = $fieldLabel;
                $formResponse->response_value = $responseValue;
                $formResponse->save();
            }
    
            return redirect()->back()->with('success', 'Form responses saved successfully!');
        }
        catch(ValidationException $validationError){
            return redirect()->back()->withErrors($validationError->validator->getMessageBag())->withInput();
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }
}
