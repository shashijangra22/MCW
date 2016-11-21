<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use File;
use App\Http\Requests;
use App\Post;
use App\Like;
use App\User;
use App\Comment;
use App\Question;
use App\Level;
use Auth;
use Image;
use DB;

class QuestionController extends Controller
{
    public function addQuestion(Request $request)
    {
    	$question=new Question;
        $question->data=$_POST["qBox"];
        $question->answer=$_POST["answerBox"];
        if (Input::hasFile('image')) 
        {
            $image=Input::file('image');
            $image_name=time().$image->getClientOriginalName();
            $image->move('uploads',$image_name);
            $question->path='uploads/'.$image_name;
                $question->save();
        return 0;
        }
        return 1;
    }
    public function checkAnswer(Request $request)
    {
    	$User=Auth::user();
    	$answer=$request->answer;
    	$question=Question::find(($User->level->level)+1);
    	if($answer==$question->answer)
    	{
    		$level=$User->level;
            $level->level++;
            $level->save();

    		return 0;
    	}
    	return 1;
    }
}
