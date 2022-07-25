<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    public static function getTopicsSubtopicsAndCounts($topics) {
//        Structure of object that contains categories and their topics:
//
//        categoriesAndTheirTopics
//            category
//            topics
//                mainTopic
//                subTopics
//                count (thread count)

        $topicsMain = array_filter($topics->toArray(), function($obj){
            if($obj->parent_id == null) return 1;
        });

        $topicsAndTheirSubtopics = Topic::getTopicInfo($topicsMain, $topics);
//        $topicsAndTheirSubtopics = [];
//        foreach ($topicsMain as $mainTopic) {
//            $topicsSub = array_filter($topics, function($obj) use($mainTopic){
//                if($obj->parent_id == $mainTopic->id) return 1;
//            });
//            if (count($topicsSub) > 0) $link = "/subtopics/".$mainTopic->id;
//            else $link = "/topic/".$mainTopic->id;
//
//            $topic = app();
//            $topic = $topic->make('stdClass');
//            $topic->mainTopic = $mainTopic;
//            $topic->subTopics = $topicsSub;
//            $topic->countThreads = Topic::countThreadsPerTopic($mainTopic->id);
//            $topic->countPosts = Topic::countTotalPostsPerTopic($mainTopic->id);
//            $topic->lastThread = Topic::getLastThreadPerTopic($mainTopic->id);
//            $topic->link = $link;
//
//            $topicsAndTheirSubtopics[] = $topic;
//        }

        return $topicsAndTheirSubtopics;
    }
    public static function getTopicInfo($loopedTopics, $allTopics) {
        $allTopics = $allTopics->toArray();

        $topicsAndTheirSubtopics = [];
        foreach ($loopedTopics as $mainTopic) {
            $topicsSub = array_filter($allTopics, function($obj) use($mainTopic){
                if($obj->parent_id == $mainTopic->id) return 1;
            });
            if (count($topicsSub) > 0) $link = "/subtopics/".$mainTopic->id;
            else $link = "/topic/".$mainTopic->id;

            $topic = app();
            $topic = $topic->make('stdClass');
            $topic->general = $mainTopic;
            $topic->mainTopic = $mainTopic;
            $topic->subTopics = $topicsSub;
            $topic->countThreads = Topic::countThreadsPerTopic($mainTopic->id);
            $topic->countPosts = Topic::countTotalPostsPerTopic($mainTopic->id);
            $topic->lastThread = Topic::getLastThreadPerTopic($mainTopic->id);
            $topic->link = $link;

            $topicsAndTheirSubtopics[] = $topic;
        }

        return $topicsAndTheirSubtopics;
    }
    public static function getCategories() {
        return \DB::table('categories')->get();
    }
    public static function getAllTopics() {
        return \DB::table('topics')->get();
    }
    public static function getTopicsByCategory($categoryId) {
        return \DB::table('topics')->where('topics.category_id', '=', $categoryId)->get();
    }
    public static function countThreadsPerTopic($topicId) {
        return \DB::table('threads')
            ->whereIn( 'topic_id', function($query) use ($topicId)
            {
                $query->select('id')
                    ->from('topics')
                    ->where('id', '=', $topicId)
                    ->orWhere('parent_id', '=', $topicId);
            } )
            ->count();
    }
    public static function countTotalPostsPerTopic($topicId) {
        return \DB::table('responses')
            ->select('*')
            ->join('threads','responses.thread_id','=','threads.id')
            ->join('topics','topics.id','=','threads.topic_id')
            ->where('topics.id','=', $topicId)
            ->orWhere('topics.parent_id','=', $topicId)
            ->count();
    }
    public static function getLastThreadPerTopic($topicId) {
        return \DB::table('threads')
            ->select('*', \DB::raw('LEFT(threads.title, 15) as shortenedTitle'), 'threads.created_at as creationDate')
            ->join('topics','threads.topic_id','=','topics.id')
            ->join('users','threads.user_id','=','users.id')
            ->where('topics.id','=',$topicId)
            ->orWhere('topics.parent_id','=',$topicId)
            ->orderBy('threads.created_at','desc')
            ->first();
    }
    public static function getTopic($topicId) {
        return \DB::table('topics')->where('topics.id', '=', $topicId)->first();
    }
    public static function editTopic($topicId, $newName) {
        return \DB::table('topics')->where('topics.id', '=', $topicId)->update([
            'name' => $newName
        ]);
    }
    public static function getSubtopics($mainTopicId) {
        return \DB::table('topics')->where('topics.parent_id', '=', $mainTopicId)->get();
    }
    public static function getTopicSortOptions() {
        return \DB::table('topics_sort_options')->get();
    }
    public static function getThreadsPerTopic($topicId, $orderBy = 'created_at', $orderDirection = 'desc') {
        return \DB::table('threads')
            ->select('*', 'threads.id as threadId', \DB::raw("COUNT(thread_id) - 1 as countReplies"))
            ->leftJoin('responses','threads.id','=','responses.thread_id')
            ->join('users','threads.user_id','=','users.id')
            ->where('threads.topic_id','=',$topicId)
            ->groupBy('threads.id')
            ->orderBy($orderBy, $orderDirection)
            ->get();
    }
    public static function filterByKeyword($keyword, $threads, $charDifference = 2) {
        $keyword = strtolower($keyword);

        if ($keyword == null || $keyword == "") {
            return $threads;
        }
        $filteredThreads = [];
        foreach($threads as $thread) {
            // If a keyword is similar or same as any of the words within a full name (maximum x letter difference), that product will be retrieved.
            $lowercaseProductName = strtolower($thread->title);
            $allwords = explode(" ", $lowercaseProductName);
            foreach($allwords as $word) {
                if (levenshtein($word, $keyword) <= $charDifference) {
                    $filteredThreads[] = $thread;
                    break;
                }
            }
        }

        return $filteredThreads;
    }
    public static function sortTypeAssing($request, $key, $defaultValue) {
        if ($request->has($key)) {
            return $request[$key];
        }
        else {
            return $defaultValue;
        }
    }
    public static function searchTopicsAllPositions($keyword) {
        $keyword = '%'.$keyword.'%';
        return \DB::table('topics')
            ->where('name', 'LIKE', $keyword)
            ->get();
    }
    public static function searchThreadsAllPositions($keyword) {
        $searchedString = '%'.$keyword.'%';
        return \DB::table('threads')
            ->select('*', 'topics.name AS topicName', 'threads.id as threadId', \DB::raw("COUNT(thread_id) as countReplies"), 'threads.views AS threadViews')
            ->leftJoin('responses','threads.id','=','responses.thread_id')
//            ->join('users','threads.user_id','=','users.id')
            ->join('topics', 'threads.topic_id', '=', 'topics.id')
            ->where('title', 'LIKE', $searchedString)
            ->groupBy('threads.id')
            ->get()
            ->toArray();
    }
    public static function getPathForTopic($topic, &$array) {
        if ($topic->parent_id) {
            $mainTopic = Topic::getTopic($topic->parent_id);
            $array = [['Home', '/'], [$mainTopic->name, '/topic/'.$mainTopic->id], [$topic->name,'/topic/'.$topic->id]];
        }
        else {
            $array = [['Home', '/'], [$topic->name,'/topic/'.$topic->name]];
        }
    }
}
