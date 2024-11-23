<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(Request $request) {
        $category = Categories::create([
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
        ]);
        if($category):
            return response()->json(['Message'=>'Inserted Successfully']);
        else:
            return response()->json(['Message'=>'Error']);
        endif;
    }

    public function getAllCategories() {
        $category = Categories::all();
        if($category):
            return response()->json(['Message'=>$category ]);
        else:
            return response()->json(['Message'=>'Error']);
        endif;
    }
    public function getCategoryById($id) {
        $id = Categories::find($id);
        if($id):
            return response()->json(['Message'=>$id]);
        else:
            return response()->json(['Message'=>'Category Is Not Found']);
        endif;
    }
    public function update(Request $request) {
        $id = $request->id;
        $category = Categories::find($id);
        $category->update([
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
        ]);
        if($category):
            return response()->json(['Message'=>$category]);
        else:
            return response()->json(['Message'=>'Category Is Not Found']);
        endif;
    }

    public function delete(Request $request) {
        $id = $request->id;
        $category = Categories::find($id)->delete();
        if($category):
            return response()->json(['Message'=>'Delete Successful']);
        else:
            return response()->json(['Message'=>'Category Is Not Found']);
        endif;
    }

}