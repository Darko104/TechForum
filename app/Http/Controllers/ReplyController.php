<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Session;

class ReplyController extends Controller
{
    //
    public function addReply($threadId, $responseId = null) {
        $routeVariables = ['threadId' => $threadId];
        if($responseId) {
            $routeVariables = Arr::add($routeVariables, 'responseId' , $responseId);
            $this->data['responsePreview'] = Reply::getReply($responseId);
        }
        $this->data['routeVariables'] = $routeVariables;

        // Page location
        $thread = Thread::getThreadById($threadId);
        $topic = Topic::getTopic($thread->topic_id);
        if ($topic->parent_id) {
            $mainTopic = Topic::getTopic($topic->parent_id);
            $this->data['page'] = [['Home', '/'], [$mainTopic->name, '/topic/'.$mainTopic->id], [$topic->name,'/topic/'.$topic->id]];
        }
        else {
            $this->data['page'] = [['Home', '/'], [$topic->name,'/topic/'.$topic->name]];
        }
        array_push($this->data['page'], [$thread->title, '/thread/'.$thread->id], ['Add reply', '/reply/add/'.$threadId]);

        return view('pages.reply.add', $this->data);
    }

    public function doAddReply(Request $request, $threadId, $responseId = null) {
        $loggedUser = Session::get('user');
        $rules = [
            'thread-text' => 'required|min:2|max:1000|regex:/^[A-z\d\s\W]{2,1000}$/',
            'images.*' => 'image|min:1'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        else {
            Reply::addReplyAndImages($threadId, $loggedUser->id, $request, $responseId);
            return redirect()->route('thread', ['threadId' => $threadId]);
        }
    }
    public function editReply($responseId) {
        $this->data['response'] = Reply::getReply($responseId);
        $thread = Thread::getThreadById($this->data['response']->thread_id);
        $this->data['images'] = Reply::getImagesPerReply($responseId)->toArray();

        // Page location
        $thread = Thread::getThreadById($thread->id);
        $topic = Topic::getTopic($thread->topic_id);
        if ($topic->parent_id) {
            $mainTopic = Topic::getTopic($topic->parent_id);
            $this->data['page'] = [['Home', '/'], [$mainTopic->name, '/topic/'.$mainTopic->id], [$topic->name,'/topic/'.$topic->id]];
        }
        else {
            $this->data['page'] = [['Home', '/'], [$topic->name,'/topic/'.$topic->name]];
        }
        array_push($this->data['page'], [$thread->title, '/thread/'.$thread->id], ['Edit reply', '/reply/edit/'.$responseId]);

        return view('pages.reply.edit', $this->data);
    }
    public function doEditReply(Request $request, $responseId) {
        $rules = [
            'thread-text' => 'required|min:2|max:1000|regex:/^[A-z\d\s\W]{2,1000}$/'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        else {
            Reply::updateReply($responseId, $request->input('thread-text'));

            $response = Reply::getReply($responseId);
            $loggedUser = Session::get('user');
            Account::insertNotification($response->user_id, $loggedUser->id,3, $response->id);
        }
    }
    public function removeReply($responseId) {
        \DB::table('responses')->where('id', '=', $responseId)->delete();
        return Redirect::back();
    }
    public function removeImageReply(Request $request) {
        $destination = \DB::table('response_image')->where('id', '=', $request->get('id'))->first();
        File::delete( "assets/img/".$destination->image_name);
        \DB::table('response_image')->where('id', '=', $request->get('id'))->delete();

//        $encoded = \Psy\Util\Json::encode($destination->image_name);
//        return $encoded;
    }
}
