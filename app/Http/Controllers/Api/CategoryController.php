<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;

class CategoryController extends Controller
{
    
    public function getAllCategories(Request $request, $company_id) {
        $categories = Categories::where('company_id', $company_id)->get();

        if (isset($categories[0])) {
            $aResponse  = array(
                    'status'    => true,
                    'message'   => 'Categories query successfully',
                    'result'    => $categories
                );

            return response()->json($aResponse, 200)->header('Content-Type', 'application/json');
        } else {
            $aResponse  = array(
                    'status'    => false,
                    'message'   => 'Categories not assigned',
                    'result'    => array()
                );

            return response()->json($aResponse, 400)->header('Content-Type', 'application/json');
        }
    }

    public function getCategories(Request $request, $categoryId) {
        $categories = Categories::where('category_id', $categoryId)->get();

        if (isset($categories[0])) {
            $aResponse  = array(
                    'status'    => true,
                    'message'   => 'Categories query successfully',
                    'result'    => $categories
                );

            return response()->json($aResponse, 200)->header('Content-Type', 'application/json');
        } else {
            $aResponse  = array(
                    'status'    => false,
                    'message'   => 'Categories do not exists',
                    'result'    => array()
                );

            return response()->json($aResponse, 400)->header('Content-Type', 'application/json');
        }
    }

    public function createCategories(Request $request) {
        $aRequest       = $request->all();
        $name           = (isset($aRequest['name'])) ? $aRequest['name'] : "";
        $company_id     = (isset($aRequest['company_id'])) ? $aRequest['company_id'] : "";

        if ($name === "" || $company_id === "") {
            $aResponse      = array(
                'status'    => false,
                'message'   => 'Fields required',
                'result'    => array()
            );

            return response()->json($aResponse, 400)->header('Content-Type', 'application/json');
        } else {
            $categories             = new Categories();
            $categories->name       = $name;
            $categories->company_id = $company_id;
            $categories->save();

            $aResponse      = array(
                'status'    => true,
                'message'   => 'Categories create successfully',
                'result'    => $categories
            );

            return response()->json($aResponse, 200)->header('Content-Type', 'application/json');
        }
    }

    public function deleteCategories(Request $request, $categoryId) {
        $categories = Categories::find($categoryId);
        
        if (isset($categories)) {
            try {
                $categories->delete();

                $aResponse      = array(
                    'status'    => true,
                    'message'   => 'Delete successfully',
                    'result'    => $categories
                );

                return response()->json($aResponse, 200)->header('Content-Type', 'application/json');
            } catch (\Throwable $th) {
                $aResponse      = array(
                    'status'    => false,
                    'message'   => 'Usuarios vinculados en esta categoría',
                    'result'    => array()
                );

                return response()->json($aResponse, 200)->header('Content-Type', 'application/json');
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

    public function updateCategories(Request $request, $categoryId) {
        $aRequest       = $request->all();
        $name           = (isset($aRequest['name'])) ? $aRequest['name'] : "";
        $company_id     = (isset($aRequest['company_id'])) ? $aRequest['company_id'] : "";

        if ($name === "" || $company_id === "") {
            $aResponse      = array(
                'status'    => false,
                'message'   => 'Fields required',
                'result'    => array()
            );

            return response()->json($aResponse, 400)->header('Content-Type', 'application/json');
        } else {
            $categories             = Categories::find($categoryId);
            $categories->name       = $name;
            $categories->company_id = $company_id;
            $categories->save();

            $aResponse      = array(
                'status'    => true,
                'message'   => 'Categories update successfully',
                'result'    => $categories
            );

            return response()->json($aResponse, 200)->header('Content-Type', 'application/json');
        }
    }

}
