<?php

namespace App\Http\Controllers;

use App\Models\ModelTest;
use App\Models\ModelTestPackage;
use Illuminate\Http\Request;

class AdminModelTestPackageController extends Controller
{
    public function all_model_test_packages(){
        return ModelTestPackage::orderBy('id', 'desc')->with('subject')->with('level')->get();
    }
    public function model_test_package($id){
        return ModelTestPackage::with('subject')->with('level')->find($id);
    }
    public function model_test_package_add(Request $req){
        $pkg = new ModelTestPackage ;

        $pkg -> name = $req->name;
        $pkg -> price = $req->price;
        $pkg -> level_id = $req->level_id;
        $pkg -> subject_id = $req -> subject_id;
        $pkg -> cover_image = $req -> cover_image;
        $pkg -> author_name = $req -> author_name;
        $pkg -> author_designation = $req -> author_designation;
        $pkg -> author_picture = $req -> author_picture;

        $pkg -> save();
//        return $pkg;
        return ModelTestPackage::orderBy('id', 'desc')->with('subject')->with('level')->get();

    }
    public function update_model_test_package($id, Request $req){
        $pkg = ModelTestPackage::find($id);

        $pkg -> name = $req->name;
        $pkg -> price = $req->price;
        $pkg -> level_id = $req->level_id;
        $pkg -> subject_id = $req -> subject_id;
        $pkg -> cover_image = $req -> cover_image;
        $pkg -> author_name = $req -> author_name;
        $pkg -> author_designation = $req -> author_designation;
        $pkg -> author_picture = $req -> author_picture;

        $pkg -> save();
        return ModelTestPackage::orderBy('id', 'desc')->with('subject')->with('level')->get();
    }
    public function delete_model_test_package($id){
        $pkg = ModelTestPackage::find($id);
        $pkg -> delete();
        return ModelTestPackage::orderBy('id', 'desc')->with('subject')->with('level')->get();
    }
    public function model_tests($id){
        return ModelTestPackage::find($id)->model_tests;
    }
    public function question_banks($id){
        return ModelTestPackage::find($id)->question_banks;
    }
}
