<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Like;
use App\User;
use App\Comment;
use App\Question;
use Auth;
use DB;

class QuestionController extends Controller
{
    public function addQuestion(Request $request)
    {
    	$question=new Question;
        $question->data=$request->question;
        $question->answer=$request->answer;
        $question->save();
        return "0";
    }
    public function checkAnswer(Request $request)
    {
    	$User=Auth::user();
    	$answer=$request->answer;
    	$question=Question::find(($User->level)+1);
    	if($answer==$question->answer)
    	{
    		$User->level++;
    		$User->save();
    		return 0;
    	}
    	return 1;
    }
}
