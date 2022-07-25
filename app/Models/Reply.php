<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Reply extends Model
{
    use HasFactory;

    public static function addReplyToThread($threadId, $userId, $content, $responseId, $main) {
        return \DB::table('responses')->insertGetId([
            'thread_id' => $threadId,
            'user_id' => $userId,
            'content' => $content,
            'response_id' => $responseId,
            'main' => $main
        ]);
    }
    public static function insertPicturesInReply($responseId, $imageName) {
        return \DB::table('response_image')->insert([
            'response_id' => $responseId,
            'image_name' => $imageName,
        ]);
    }
    public static function addReplyAndImages($threadId, $userId, $request, $responseId, $main = 0) {
        $lastInsertedResponseId = Reply::addReplyToThread($threadId, $userId, $request->input('thread-text'), $responseId, $main);

        Account::processNotificationInfo($threadId, $responseId, $userId, $lastInsertedResponseId);

        if($request->hasFile('images')) {
            $images = $request->file('images');
            $imageCounter = 0;
            foreach ($images as $image) {
                $extention = $image->getClientOriginalExtension();
                $fileName = time().$imageCounter.'.'.$extention;
                $imageCounter++;
                $image->move('assets/img/', $fileName);

                Reply::insertPicturesInReply($lastInsertedResponseId, $fileName);
            }
        }
    }
    public static function getReply($responseId) {
        return \DB::table('responses')->join('users', 'users.id', '=', 'responses.user_id')->where('responses.id', '=', $responseId)->first();
    }
    public static function getImagesPerReply($responseId) {
        return \DB::table('response_image')->where('response_id', '=', $responseId)->get();
    }
    public static function updateReply($responseId, $content) {
        \DB::table('responses')->where('id', '=', $responseId)->update([
            'content' => $content
        ]);
    }
    public static function countReplies() {
        return \DB::table('responses')->where('main', '=', 0)->count();
    }
    public static function countRepliesPast24h() {
        return \DB::table('responses')
            ->where('main', '=', 0)
            ->where('created_at', '>', Carbon::now()->subDays(1)->toDateTimeString())
            ->count();
    }
}
