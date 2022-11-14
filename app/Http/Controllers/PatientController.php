<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Validator;

class PatientController extends Controller
{
    # get all patient data 
    function index()
    {
        # get patient data
        $patientData = Patient::get();
        
        # check if data is not empty
        if($patientData->count() !== 0){
            $data = [
                'message' => 'Get All Resource',
                'code' => 200,
                'data' => $patientData,
            ];
        } else {
            $data = [
                'message' => 'Data is empty',
                'code' => 200,
            ];
        }

        #return response 
        return response()->json($data,200);
    }

    # create a new patient data 
    function store(Request $request)
    {
        # set validation rule
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'status' => 'required',
            'in_date_at' => 'required',
            'out_date_at' => 'required',
        ]);
 
        # check if validation rule passed
        if (!$validator->fails()) {
            $patientData = Patient::create($request->all());
    
            $data = [
                'message' => 'Resource is added successfully',
                'code' => 201,
                'data' => $patientData,
            ];
        } else {
            $data = [
                'message' => $validator->errors(),
                'code' => 200,
            ];
        }

        # return response data
        return response()->json($data,$data['code']);
    }

    # update patient data 
    function update(Request $request, $id)
    {
        #get patient data
        $patientData = Patient::find($id);

        #check if patient data is not null
        if($patientData != NULL) { 
            /*
            ternary used to check if request is not null, 
            then get data from request otherwise, just get from database
            
            this way used to prevent bug
            */
            $patientData->name = $request->name != 0 ? $request->name : $patientData->name;
            $patientData->phone = $request->phone != 0 ? $request->phone : $patientData->phone;
            $patientData->address = $request->address != 0 ? $request->address : $patientData->address;
            $patientData->status = $request->status != 0 ? $request->status : $patientData->status;
            $patientData->in_date_at = $request->in_date_at != 0 ? $request->in_date_at : $patientData->in_date_at;
            $patientData->out_date_at = $request->out_date_at != 0 ? $request->out_date_at : $patientData->out_date_at;
            $patientData->save();
        
            $data = [
                'message' => 'Resource is update successfully',
                'code' => 200,
                'data' => $patientData,
            ];
        } else {
            $data = [
                'message' => 'Resource not found',
                'code' => 404,
            ];
        }

        # return response data
        return response()->json($data,$data['code']);
    }

    # delete patient data 
    function destroy($id)
    {
        // get patient data
        $patientData = Patient::find($id);

        #check if patient data is not null
        if($patientData != NULL) { 
            $patientData->delete();

            $data = [
                'message' => 'Resource is delete successfully',
                'code' => 200
            ];
        } else {
            $data = [
                'message' => 'Resource not found',
                'code' => 404
            ];
        }

        # return response data
        return response()->json($data,$data['code']);
    }

    # get detail patient data 
    function show($id)
    {
        // get patient data
        $patientData = Patient::find($id);

        #check if patient data is not null
        if($patientData != NULL) { 
            $data = [
                'message' => 'Get Detail Resource',
                'code' => 200,
                'data' => $patientData,
            ];
        } else {
            $data = [
                'message' => 'Resource not found',
                'code' => 404
            ];
        }

        # return response data
        return response()->json($data,$data['code']);
    }

    # search patient data by name
    function search($name)
    {
        # Get patient data where name is equal to parameter
        $patientData = Patient::where('name','LIKE','%'.$name.'%')->get();

        # Check if patient data is not null
        if($patientData->count() !== 0){
            $data = [
                'message' => 'Get searched resource',
                'code' => 200,
                'data' => $patientData,
            ];
        } else {
            $data = [
                'message' => 'Resource not found',
                'code' => 404,
            ];
        }

        # return response data
        return response()->json($data,$data['code']);
    }

    # get positive patient data 
    function positive($positive)
    {
        # get patient data
        $patientData = Patient::where('status',$positive)->get();

        # Check if patient data is not null
        if ($patientData->count() !== 0) {
            $data = [
                'message' => 'Get positive resource',
                'total' => $patientData->count(),
                'code' => 200,
                'data' => $patientData,
            ];
        }

        # return response data
        return response()->json($data,$data['code']);

    }

    # get recovered patient data
    function recovered($recovered)
    {
        # get patient data
        $patientData = Patient::where('status',$recovered)->get();

        # Check if patient data is not null
        if ($patientData->count() !== 0) {
            $data = [
                'message' => 'Get recovered resource',
                'total' => $patientData->count(),
                'code' => 200,
                'data' => $patientData,
            ];
        } else {
            $data = [
                'message' => 'Resource not found',
                'total' => $patientData->count(),
                'code' => 404,
            ];
        }

        # return response data
        return response()->json($data,$data['code']);
    }

    # get dead patient data
    function dead($dead)
    {
        # get patient data
        $patientData = Patient::where('status',$recovered)->get();

        # Check if patient data is not null
        if ($patientData->count() !== 0) {
            $data = [
                'message' => 'Get dead resource',
                'total' => $patientData->count(),
                'code' => 200,
                'data' => $patientData,
            ];
        }else {
            $data = [
                'message' => 'Resource not found',
                'total' => $patientData->count(),
                'code' => 404,
            ];
        }

        # return response data
        return response()->json($data,$data['code']);
    }
}
