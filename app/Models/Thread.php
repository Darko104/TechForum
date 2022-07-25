<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Thread extends Model
{
    use HasFactory;

    public static function getThreadById($threadId) {
        return \DB::table('threads')->where('id', '=', $threadId)->first();
    }
    public static function getAllThreads() {
        return \DB::table('threads')
            ->select('*', 'topics.name AS topicName', 'threads.id AS threadId', \DB::raw("COUNT(thread_id) AS countReplies"), 'threads.views AS threadViews')
            ->leftJoin('responses','threads.id','=','responses.thread_id')
            ->join('topics', 'threads.topic_id', '=', 'topics.id')
            ->groupBy('threads.id')
            ->get();
    }
    public static function getReplies($threadId) {
        return \DB::table('responses')
            ->select('*', 'responses.created_at as responseCreation', 'responses.id as responseId', 'user_privilege.name AS privilegeName')
            ->where('thread_id', '=', $threadId)
            ->join('users', 'users.id', '=', 'responses.user_id')
            ->join('user_privilege', 'users.user_privilege_id', '=', 'user_privilege.id')
            ->get();
    }
//    public function getRepliesCountPerThread($threadId) {
//        return \DB::table('responses')->where('thread_id', '=', $threadId)->count();
//    }
    public static function incrementThreadViews($threadId) {
        \DB::table('threads')->where('id', '=', $threadId)->increment('views', 1);
    }
    public static function addThread($title, $topicId, $userId) {
        return \DB::table('threads')->insertGetId([
            'title' => $title,
            'topic_id' => $topicId,
            'user_id' => $userId
        ]);
    }
    public static function getLastReply($threadId) {
        return \DB::table('responses')
            ->select('*', \DB::raw('LEFT(responses.content, 15) as shortenedContent'))
            ->join('users', 'users.id', '=', 'responses.user_id')
            ->where('responses.thread_id', '=', $threadId)
            ->orderBy('responses.created_at', 'DESC')
            ->first();
    }
    public static function getMainReply($threadId) {
        return \DB::table('responses')
            ->where('responses.thread_id', '=', $threadId)->orderBy('created_at', 'ASC')->first();
    }
    public static function updateThread($threadId, $title, $content) {
        \DB::table('responses')->where('thread_id', '=', $threadId)
            ->where('main', '=', 1)
            ->update([
                'content' => $content
            ]);

        \DB::table('threads')->where('id', '=', $threadId)->update([
            'title' => $title
        ]);
    }
    public static function countAllThreads() {
        return \DB::table('threads')->count();
    }
    public static function removeAllRepliesInThread($threadId) {
        \DB::table('responses')->where('thread_id', '=', $threadId)->delete();
    }
    public static function countAllThreadsPast24h() {
        return \DB::table('threads')
            ->where('created_at', '>', Carbon::now()->subDays(1)->toDateTimeString())
            ->count();
    }
    public static function getThreadInfo($threads) {
        $threadsAndInfo = [];
        foreach ($threads as $thread) {
            $obj = app();
            $obj = $obj->make('stdClass');
            $obj->thread = $thread;
            //$obj->counter = Thread::getRepliesCountPerThread($thread->threadId);
            $obj->lastResponse = Thread::getLastReply($thread->threadId);

            $threadsAndInfo[] = $obj;
        }

        return $threadsAndInfo;
    }
}
