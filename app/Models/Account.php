<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Account extends Model
{
    use HasFactory;

    public static function getUser($userId) {
        return \DB::table('users')->where("id", "=", $userId)->first();
    }
    public static function updateUserInfo($userId, $username, $email, $password, $location, $signature) {
        return \DB::table('users')->where('id', '=', $userId)->update([
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'location' => $location,
            'signature' => $signature
            ]);
    }
    public static function updateUserAvatar($userId, $imageName) {
        return \DB::table('users')->where('id', '=', $userId)->update(['avatar' => $imageName]);
    }
    public static function getThreadsByUserId($userId) {
        return \DB::table('threads')
            ->select('*', \DB::raw("COUNT(responses.thread_id) - 1 AS countReplies"), 'threads.created_at AS creationDate', 'threads.id AS threadId', \DB::raw('LEFT(responses.content, 120) as shortenedContent'))
            ->leftJoin('responses', 'threads.id', '=', 'responses.thread_id')
            ->where('threads.user_id', '=', $userId)
            ->groupBy('threads.id')
            ->get();
    }
    public static function getResponsesByUserId($userId) {
        return \DB::table('responses as r1')
            ->select('*', \DB::raw("count(r2.response_id) AS countReplies"), 'r1.created_at as creationDate', 'r1.id AS responseId', 'r1.content AS content', \DB::raw('LEFT(r1.content, 120) as shortenedContent'))
            ->leftJoin('responses as r2','r1.id','=','r2.response_id')
            ->join('threads','threads.id','=','r1.thread_id')
            ->where('r1.main','=',0)
            ->where('r1.user_id','=',$userId)
            ->groupBy('r1.id')
            ->get();

//        return \DB::raw("SELECT *, count(r2.response_id), r.created_at AS creationDate, r.id AS responseId FROM `responses` r LEFT JOIN responses r2 ON r.id = r2.response_id INNER JOIN threads ON threads.id = r.thread_id WHERE r.main = 0 AND r.user_id = $userId GROUP BY r.id")->get();
    }

    public static function insertNotification($notifiedUser, $triggerUser, $eventId, $response_id) {
        return \DB::table('notifications')->insert([
            'notified_user' => $notifiedUser,
            'trigger_user' => $triggerUser,
            'event_id' => $eventId,
            'response_id' => $response_id,
            'viewed' => 0
        ]);
    }
    public static function processNotificationInfo($threadId, $responseId, $userId, $lastInsertedResponseId) {
        $notifiedUsers = [];

        // If new response is quoting an already response within a thread, both thread maker and person who is being responded to are notified.
        if ($responseId != null) {
            $userPostIds = \DB::table('responses')
                ->select('threads.user_id as threadUserId', 'responses.user_id as responseUserId')
                ->join('threads','responses.thread_id','=','threads.id')
                ->where('responses.id','=',$responseId)
                ->first();

            // If quoted reply maker is the same as thread maker only one notification is sent.
            if ($userPostIds->threadUserId == $userPostIds->responseUserId) {
                $notifiedUsers[] = $userPostIds->threadUserId;
            }
            else array_push($notifiedUsers, $userPostIds->threadUserId, $userPostIds->responseUserId);
        }
        // If it is only regular reply to a thread, only thread maker is being notified.
        else {
            $notifiedUsers[] = Thread::getThreadById($threadId)->user_id;
        }

        // If the user sending a reply is the one who made a thread or quoted response he will not be notified.
        Account::stopSameUserFromBeingNotified($notifiedUsers, $userId);

        foreach ($notifiedUsers as $NUId) {
            Account::insertNotification($NUId, $userId, 1, $lastInsertedResponseId);
        }
    }
    public static function stopSameUserFromBeingNotified(&$array, $userId) {
        foreach ($array as $key => $value) {
            if($value == $userId) {
                unset($array[$key]);
            }
        }
    }
    public static function getNotificationsByUserId($userId) {
        return \DB::table('notifications')->select('*', 'notifications.created_at AS notificationCreation')
            ->where('notified_user', '=', $userId)
            ->join('notifications_event', 'notifications.event_id', '=', 'notifications_event.id')
            ->join('responses', 'notifications.response_id', '=', 'responses.id')
            ->join('users', 'notifications.trigger_user', '=', 'users.id')
            ->orderBy('notifications.created_at', 'DESC')
            ->get();
    }
    public static function countUsers() {
        return \DB::table('users')->count();
    }
    public static function countUsersPastMonth() {
        return \DB::table('users')
            ->where('created_at', '>', Carbon::now()->subMonth()->toDateTimeString())
            ->count();
    }
}
