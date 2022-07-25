<?php

namespace App\Http\Controllers;

use App\Models\General;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Thread;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class TopicController extends BasicController
{
    public function subtopics($mainTopicId) {
        $mainTopic = Topic::getTopic($mainTopicId);
        $subtopics = Topic::getSubtopics($mainTopic->id);

        $subtopicsAndCount = Topic::getTopicInfo($subtopics, $subtopics);
//        $subtopicsAndCount = [];
//        foreach ($subtopics as $topic) {
//            $app = app();
//            $object = $app->make('stdClass');
//
//            $object->general = $topic;
//            $object->countThreads = Topic::countThreadsPerTopic($topic->id);
//            $object->countPosts = Topic::countTotalPostsPerTopic($topic->id);
//            $object->lastThread = Topic::getLastThreadPerTopic($topic->id);
//            $object->link = "/topic/".$topic->id;
//
//            $subtopicsAndCount[] = $object;
//        }
        $this->data['mainTopic'] = $mainTopic;
        $this->data['subtopicsandcounter'] = $subtopicsAndCount;
        $this->data['page'] = [['Home', '/'], [$mainTopic->name,'/topic/'.$mainTopic->name]];

        return view('pages.topic.subtopics', $this->data);
    }

    public function showThreadsPerTopic(Request $request, $topicId) {
        $showCasedTopic = Topic::getTopic($topicId);

        // Sorting
        $orderBy = Topic::sortTypeAssing($request, 'sort', 'threads.created_at');
        $orderDir = Topic::sortTypeAssing($request, 'sort_dir', 'desc');

        $threads = Topic::getThreadsPerTopic($topicId, $orderBy, $orderDir)->toArray();

        // Filter by keyword
        if ($request->has('keyword')) {
            $threads = Topic::filterByKeyword($request->keyword, $threads);
        }

        // Pagination
        $threadsAndPageNumbers = General::pagination($request, $threads, 4);
        $threads = $threadsAndPageNumbers[1];

//        Object that contains threads and amount of replies in those threads:
//         threadsAndReplies
//          thread
//              threadInfo
//              replies

        $threadsAndReplies = Thread::getThreadInfo($threads);
//        $threadsAndReplies = [];
//        foreach ($threads as $thread) {
//            $obj = app();
//            $obj = $obj->make('stdClass');
//            $obj->thread = $thread;
//            //$obj->counter = Thread::getRepliesCountPerThread($thread->threadId);
//            $obj->lastResponse = Thread::getLastReply($thread->threadId);
//
//            $threadsAndReplies[] = $obj;
//        }

        $this->data['showCasedTopic'] = $showCasedTopic;
        $this->data['threadsAndReplies'] = $threadsAndReplies;
        $this->data['numberOfPages'] = $threadsAndPageNumbers[0];
        $this->data['sortOptions'] = Topic::getTopicSortOptions();

        // Page location
        $this->data['page'] = [];
        Topic::getPathForTopic($showCasedTopic, $this->data['page']);

        General::incrementView($topicId, 'topics');
        return view('pages.topic.show', $this->data);
    }

    public function editTopic($topicId) {
        $this->data['topic'] = Topic::getTopic($topicId);

        $this->data['page'] = [['Home', '/'], [$this->data['topic']->name,'/topic/'.$this->data['topic']->id], ['Edit', '/topic/edit/'.$this->data['topic']->id]];
        return view('pages.topic.edit', $this->data);
    }
    public function doEditTopic(Request $request, $topicId) {
        $rules = [
            'topic-tname' => 'required|min:2|max:200|regex:/^[A-z0-9 ]{2,255}$/'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        else {
            Topic::editTopic($topicId, $request->get('topic-tname'));
        }
    }

    public function removeTopic($topicId) {
        $mainAndChildTopicIds = \DB::table('topics')->where('id', '=', $topicId)->orWhere('parent_id', '=', $topicId)->pluck('id')->toArray();

        $threadIds = \DB::table('threads')->whereIn('topic_id', $mainAndChildTopicIds)->pluck('id')->toArray();

        \DB::table('responses')->whereIn('thread_id', $threadIds)->delete();
        \DB::table('threads')->whereIn('topic_id', $mainAndChildTopicIds)->delete();

        \DB::table('topics')->where('id', '=', $topicId)->orWhere('parent_id', $topicId)->delete();
        return Redirect::back();
    }

    public function search(Request $request) {
        $topics = Topic::searchTopicsAllPositions($request->keyword);

        $topicsAndCount = Topic::getTopicInfo($topics, $topics);
//        $topicsAndCount = [];
//        foreach ($topics as $topic) {
//            $app = app();
//            $object = $app->make('stdClass');
//
//            $object->general = $topic;
//            $object->countThreads = Topic::countThreadsPerTopic($topic->id);
//            $object->countPosts = Topic::countTotalPostsPerTopic($topic->id);
//            $topic->lastThread = Topic::getLastThreadPerTopic($topic->id);
//            $object->link = "/topic/".$topic->id;
//
//            $topicsAndCount[] = $object;
//        }

        $encoded = \Psy\Util\Json::encode($topicsAndCount);
        return $encoded;
    }
}
