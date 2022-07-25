<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Topic;
use App\Models\Thread;
use App\Models\Reply;
use App\Models\General;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use PhpParser\Node\Expr\Cast\Object_;
use Session;

class ThreadController extends Controller
{
    public function show(Request $request, $threadId) {
        $thread = Thread::getThreadById($threadId);
        // Increment a view of a thread
        Thread::incrementThreadViews($threadId);

//        Structure of object that contains categories and their topics:
//
//        responsesAndImages
//          response
//          images
//          reply

        $responsesAndImages = [];

        $responses = Thread::getReplies($threadId)->toArray();

        // Pagination
        $responsesAndPageNumbers = General::pagination($request, $responses, 4);
        $responses = $responsesAndPageNumbers[1];

        foreach ($responses as $response) {
            $obj = app();
            $obj = $obj->make('stdClass');
            $obj->response = $response;
            $obj->images = Reply::getImagesPerReply($response->responseId)->toArray();

            if ($response->response_id) {
                $obj->reply = Reply::getReply($response->response_id);
            }

            $responsesAndImages[] = $obj;
        }

        // Page location
        $this->data['page'] = [];
        $topic = Topic::getTopic($thread->topic_id);
        Topic::getPathForTopic($topic, $this->data['page']);
        array_push($this->data['page'], [$thread->title, '/thread/'.$thread->id]);

        $this->data['thread'] = $thread;
        $this->data['numberOfPages'] = $responsesAndPageNumbers[0];
        $this->data['responsesAndImages'] = $responsesAndImages;
        return view('pages.thread.show', $this->data);
    }
    public function makeThread($topicId) {
        // Page location
        $this->data['page'] = [];
        $topic = Topic::getTopic($topicId);
        Topic::getPathForTopic($topic, $this->data['page']);

        return view('pages.thread.add', $this->data);
    }
    public function doMakeThread(Request $request, $topicId) {
        $loggedUser = Session::get('user');

        $rules = [
            'thread-title' => 'required|min:2|max:200|regex:/^[A-z\d\s\W]{2,200}$/',
            'thread-text' => 'required|min:2|max:1000|regex:/^[A-z\d\s\W]{2,1000}$/',
            'images.*' => 'image|min:1'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        else {
            $lastInsertedThreadId = Thread::addThread($request->input('thread-title'), $topicId, $loggedUser->id);

            Reply::addReplyAndImages($lastInsertedThreadId, $loggedUser->id, $request, null, 1);
            return redirect()->route('thread', ['threadId' => $lastInsertedThreadId]);
        }
    }
    public function editThread($threadId) {
        $thread = Thread::getThreadById($threadId);
        $mainResponse = Thread::getMainReply($threadId);

        $this->data['thread'] = $thread;
        $this->data['mainResponse'] = $mainResponse;

        // Page location
        $topic = Topic::getTopic($thread->topic_id);
        if ($topic->parent_id) {
            $mainTopic = Topic::getTopic($topic->parent_id);
            $this->data['page'] = [['Home', '/'], [$mainTopic->name, '/topic/'.$mainTopic->id], [$topic->name,'/topic/'.$topic->id]];
        }
        else {
            $this->data['page'] = [['Home', '/'], [$topic->name,'/topic/'.$topic->name]];
        }
        array_push($this->data['page'], [$thread->title, '/thread/'.$thread->id], ['Edit', '/thread/edit/'.$threadId]);

        return view('pages.thread.edit', $this->data);
    }
    public function doEditThread(Request $request, $threadId) {
        $rules = [
            'thread-title' => 'required|min:2|max:200|regex:/^[A-z\d\s\W]{2,200}$/',
            'thread-text' => 'required|min:2|max:1000|regex:/^[A-z\d\s\W]{2,1000}$/'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        else {
            Thread::updateThread($threadId, $request->get('thread-title'), $request->get('thread-text'));
        }
    }
    public function removeThread($threadId) {
        \DB::table('threads')->where('id', '=', $threadId)->delete();
        Thread::removeAllRepliesInThread($threadId);
        return Redirect::back();
    }

    public function search(Request $request) {
        $threads = Topic::searchThreadsAllPositions($request->get('keyword'));
        $threads = array_slice($threads, 0, 4);

        $encoded = \Psy\Util\Json::encode($threads);
        return $encoded;
    }
    public function searchAll(Request $request) {
        $threads = Topic::searchThreadsAllPositions($request->get('keyword'));

        $encoded = \Psy\Util\Json::encode($threads);
        return $encoded;
    }
    public function showSearch(Request $request) {
        if (!$request->has('keyword')) {
            return redirect()->route('home');
        }

        $threads = Topic::searchThreadsAllPositions($request->keyword);

        $threadsAndPageNumbers = General::pagination($request, $threads, 2);
        $threads = $threadsAndPageNumbers[1];

        $threadsAndInfo = Thread::getThreadInfo($threads);
//        $threadsAndInfo = [];
//        foreach ($threads as $thread) {
//            $obj = app();
//            $obj = $obj->make('stdClass');
//            $obj->thread = $thread;
//            //$obj->counter = Thread::getRepliesCountPerThread($thread->threadId);
//            $obj->lastResponse = Thread::getLastReply($thread->threadId);
//
//            $threadsAndInfo[] = $obj;
//        }

        $this->data['threadsAndInfo'] = $threadsAndInfo;
        $this->data['numberOfPages'] = $threadsAndPageNumbers[0];

        General::incrementView(2);

        $this->data['page'] = [['Home', '/'], ['Search results','/searchresults?keyword='.$request->keyword]];
        return view('pages.search', $this->data);
    }
}
