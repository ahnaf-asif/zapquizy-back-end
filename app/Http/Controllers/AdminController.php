<?php

namespace App\Http\Controllers;

use App\Models\ModelTest;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Exception;

class AdminController extends Controller
{
    public function model_test_add(Request $req){
        $new_model_test = new ModelTest;
        $new_model_test -> name = $req->name;
        $new_model_test -> duration = $req -> duration;
        $new_model_test -> level_id = $req -> level_id;
        $new_model_test -> subject_id = $req -> subject_id;

        $new_model_test -> save();

        return ModelTest::with('subject')->with('level')->orderBy('id', 'desc')->get();
    }
    public function all_model_tests(){
        return ModelTest::with('subject')->with('level')->orderBy('id', 'desc')->get();
    }
    public function model_test($id){
        return ModelTest::with('subject')->with('level')->find($id);
    }
    public function update_model_test($id, Request $mt){
        $model_test = ModelTest::find($id);

        $model_test -> name = $mt -> name;
        $model_test -> duration = $mt -> duration;
        $model_test -> subject_id = $mt -> subject_id;
        $model_test -> level_id = $mt -> level_id;

        $model_test -> save();

        return ModelTest::with('subject')->with('level')->find($id);
    }
    public function get_model_test_questions($id){
        return ModelTest::find($id)->questions;
    }
    public function add_model_test_question($id, Request $req){
        $question = new Question;

        $question->model_test_id = $id;
        $question->name = $req->name;
        $question->type = $req->type;
        $question->save();

        foreach($req->options as $option){
            $new_op = new Option;
            $new_op -> name = $option['name'];
            $new_op -> correct = $option['correct'];
            $new_op -> question_id = $question->id;

            $new_op -> save();
        }
        return ModelTest::find($id)->questions;
    }
}
