<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class CompanyController extends Controller
{
    
    public function getAllCompany(Request $request) {
        $company    = Company::get();

        $aResponse  = array(
                'status'    => true,
                'message'   => 'Company query successfully',
                'result'    => $company
            );

        return response()->json($aResponse, 200)->header('Content-Type', 'application/json');
    }

    public function getCompany(Request $request, $companyId) {
        $company    = Company::find($companyId);

        $aResponse  = array(
                'status'    => true,
                'message'   => 'Company query successfully',
                'result'    => $company
            );

        return response()->json($aResponse, 200)->header('Content-Type', 'application/json');
    }

    public function createCompany(Request $request) {
        $aRequest       = $request->all();
        $name           = (isset($aRequest['name'])) ? $aRequest['name'] : "";
        $description    = (isset($aRequest['description'])) ? $aRequest['description'] : "";

        if ($name === "" || $description === "") {
            $aResponse      = array(
                'status'    => false,
                'message'   => 'Fields required',
                'result'    => array()
            );

            return response()->json($aResponse, 400)->header('Content-Type', 'application/json');
        } else {
            $company                = new Company();
            $company->name          = $name;
            $company->description   = $description;
            $company->save();

            $aResponse      = array(
                'status'    => true,
                'message'   => 'Company create successfully',
                'result'    => $company
            );

            return response()->json($aResponse, 200)->header('Content-Type', 'application/json');
        }
    }

    public function deleteCompany(Request $request, $companyId) {
        $company = Company::find($companyId);
        
        if (isset($company)) {
            try {
                $company->delete();
                $aResponse      = array(
                    'status'    => true,
                    'message'   => 'Delete successfully',
                    'result'    => $company
                );
    
                return response()->json($aResponse, 200)->header('Content-Type', 'application/json');
            } catch (\Throwable $th) {
                $aResponse      = array(
                    'status'    => false,
                    'message'   => 'Categorías vinculados en esta empresa',
                    'result'    => array()
                );
    
                return response()->json($aResponse, 404)->header('Content-Type', 'application/json');
            }

            
        } else {
            $aResponse      = array(
                'status'    => false,
                'message'   => 'Parameter incorrect',
                'result'    => array()
            );

            return response()->json($aResponse, 400)->header('Content-Type', 'application/json');
        }
    }

    public function updateCompany(Request $request, $companyId) {
        $aRequest       = $request->all();
        $name           = (isset($aRequest['name'])) ? $aRequest['name'] : "";
        $description    = (isset($aRequest['description'])) ? $aRequest['description'] : "";

        if ($name === "" || $description === "") {
            $aResponse      = array(
                'status'    => false,
                'message'   => 'Fields required',
                'result'    => array()
            );

            return response()->json($aResponse, 400)->header('Content-Type', 'application/json');
        } else {
            $company                = Company::find($companyId);
            $company->name          = $name;
            $company->description   = $description;
            $company->save();

            $aResponse      = array(
                'status'    => true,
                'message'   => 'Company update successfully',
                'result'    => $company
            );

            return response()->json($aResponse, 200)->header('Content-Type', 'application/json');
        }
    }

}
