<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\AboutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/subtopics/{mainTopicId}', [TopicController::class, 'subtopics'])->name('subtopics');
Route::get('/topic/{topicId}', [TopicController::class, 'showThreadsPerTopic'])->name('topic');

Route::get('/thread/{threadId}', [ThreadController::class, 'show'])->name('thread');

Route::post('/ajaxsearchthreads', [ThreadController::class, 'search'])->name('ajaxsearch');
Route::get('/searchresults', [ThreadController::class, 'showSearch'])->name('searchresults');
Route::get('/about', [AboutController::class, 'show'])->name('about');

Route::middleware('isGuest')->group(function(){
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
    Route::post('/register', [AuthController::class, 'doRegister'])->name('register.doRegister');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
    Route::post('/login', [AuthController::class, 'doLogin'])->name('login.doLogin');
});

Route::middleware('isLoggedIn')->group(function(){
    Route::get('/logoff', [AuthController::class, 'logoff'])->name('login.logoff');

    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::get('/profile/posts', [AccountController::class, 'showPosts'])->name('profile.posts');
    Route::get('/profile/notifications', [AccountController::class, 'showNotifications'])->name('profile.notifications');
    Route::post('/profile/update/info', [AccountController::class, 'updateProfileInfo'])->name('update.profile');
    Route::post('/profile/update/avatar', [AccountController::class, 'updateProfileAvatar'])->name('update.avatar');

    Route::get('/thread/add/{topicId}', [ThreadController::class, 'makeThread'])->name('thread.add');
    Route::post('/thread/add/{topicId}', [ThreadController::class, 'doMakeThread'])->name('thread.doAdd');

    Route::get('/reply/add/{threadId}/{responseId?}', [ReplyController::class, 'addReply'])->name('reply.add');
    Route::post('/reply/add/{threadId}/{responseId?}', [ReplyController::class, 'doAddReply'])->name('reply.doAdd');
});
Route::middleware('isAdmin')->group(function(){
    Route::get('/topic/edit/{topicId}', [TopicController::class, 'editTopic'])->name('topic.edit');
    Route::post('/topic/edit/{topicId}', [TopicController::class, 'doEditTopic'])->name('topic.doEdit');
    Route::get('/topic/remove/{threadId}', [TopicController::class, 'removeTopic'])->name('topic.remove');

    Route::get('/thread/edit/{threadId}', [ThreadController::class, 'editThread'])->name('thread.edit');
    Route::post('/thread/edit/{threadId}', [ThreadController::class, 'doEditThread'])->name('thread.doEdit');
    Route::get('/thread/remove/{threadId}', [ThreadController::class, 'removeThread'])->name('thread.remove');

    Route::post('/reply/remove/{responseId}', [ReplyController::class, 'removeReply'])->name('reply.remove');
    Route::get('/reply/edit/{responseId}', [ReplyController::class, 'editReply'])->name('reply.edit');
    Route::post('/reply/edit/{responseId}', [ReplyController::class, 'doEditReply'])->name('reply.doEdit');
    Route::post('/reply/removeImage', [ReplyController::class, 'removeImageReply'])->name('reply.removeImage');

    Route::get('/panel', [AdminController::class, 'showPanel'])->name('panel.main');
    Route::get('/panel/topics', [AdminController::class, 'showTopics'])->name('panel.topics');
    Route::get('/panel/threads', [AdminController::class, 'showThreads'])->name('panel.threads');
    Route::post('/adminsearchtopics', [TopicController::class, 'search'])->name('panel.search.topics');
    Route::post('/adminsearchthreads', [ThreadController::class, 'searchAll'])->name('panel.search.threads');
});
