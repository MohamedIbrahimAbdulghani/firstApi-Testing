<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiHandler;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiHandler;
    public function create(Request $request) {
        $category = Categories::create([
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
        ]);
        if($category):
            return $this->MessageSuccess('Inserted Successfully');
        else:
            return $this->MessageError('Error');
        endif;
    }

    public function getAllCategories(Request $request) {
        if($request->lang):
            $category = Categories::select("id", "name_".$request->lang)->get();
        else:
            $category = Categories::all();
        endif;
        if($category):
            return $this->ReturnData($category);
        else:
            return $this->MessageError('Error');
        endif;
    }
    public function getCategoryById(Request $request) {
        $id = Categories::find($request->id);
        if($id):
            return $this->ReturnData($id);
        else:
            return $this->MessageError('Category Is Not Found');
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
            return $this->ReturnData($category);
        else:
            return $this->MessageError('Category Is Not Found');
        endif;
    }

    public function delete(Request $request) {
        $id = $request->id;
        $category = Categories::find($id)->delete();
        if($category):
            return $this->MessageSuccess('Delete Successful');
        else:
            return $this->MessageError('Category Is Not Found');
        endif;
    }

}
