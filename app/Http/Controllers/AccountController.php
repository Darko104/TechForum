<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Account;
use App\Models\General;
use Illuminate\Support\Facades\Redirect;
use Session;

class AccountController extends Controller
{
    public function updateProfileInfo(Request $request) {
        $loggedUser = Session::get('user');
        $currentInfo = Account::getUser($loggedUser->id);

        $rules = [
            'update-username' => 'required|min:2|max:30|alpha_dash',
            'update-email' => 'required|email|max:100',
            'update-location' => 'regex:/^[A-z\d\s,.]+$/|min:3|max:60|nullable',
            'update-signature' => 'regex:/^[A-z\d\s\W]+$/|min:3|max:150|nullable'
        ];

        // If password field is empty, old password is being reasigned
        if ($request->filled('update-password')) {
            $passRule = array('update-password' => 'required|min:5');
            $rules = array_merge($rules, $passRule);
            $currentInfo->password = md5($request->input('update-password'));
        }

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        // Insert data
        else {
            $currentInfo->username = $request->input('update-username');
            $currentInfo->email = $request->input('update-email');
            $currentInfo->location = $request->input('update-location');
            $currentInfo->signature = $request->input('update-signature');

            Account::updateUserInfo($currentInfo->id, $currentInfo->username, $currentInfo->email, $currentInfo->password, $currentInfo->location, $currentInfo->signature);
            Session::put('user', Account::getUser($loggedUser->id));
        }

        return Redirect::back();
    }

    public function updateProfileAvatar(Request $request) {
        $loggedUser = Session::get('user');
        $userInfo = Account::getUser($loggedUser->id);

        echo $userInfo->avatar;

        if ($request->hasFile('update-avatar')) {
            $destination = "assets/img/".$userInfo->avatar;

            if(File::exists($destination) && $userInfo->avatar != "default_avatar.jpg") {
                File::delete($destination);
            }
            $file = $request->file('update-avatar');
            $extention = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extention;
            $file->move('assets/img/', $fileName);
            Account::updateUserAvatar($userInfo->id, $fileName);
            Session::put('user', Account::getUser($loggedUser->id));
        }

        return Redirect::back();
    }

    public function showPosts() {
        $user = Session::get('user');

        $threads = Account::getThreadsByUserId($user->id)->toArray();
        $responses = Account::getResponsesByUserId($user->id)->toArray();

        $posts = array_merge($threads, $responses);
        usort($posts, function($a, $b) {
            return strtotime($b->creationDate) - strtotime($a->creationDate);
        });

        $this->data['posts'] = $posts;
        $this->data['page'] = [['Home', '/'], [$user->username, '/profile'], ['Posts', '/profile/posts']];
        return view('pages.profile.posts', $this->data);
    }

    public function showNotifications() {
        $user = Session::get('user');

        $notifs = Account::getNotificationsByUserId($user->id)->toArray();

        foreach ($notifs as $n) {
            $n->notificationCreation = date("F j, Y, g:i a", strtotime($n->notificationCreation));
        }

        $this->data['notifications'] = $notifs;
        $this->data['page'] = [['Home', '/'], [$user->username, '/profile'], ['Notifications', '/profile/notifications']];
        return view('pages.profile.notifications', $this->data);
    }

}
