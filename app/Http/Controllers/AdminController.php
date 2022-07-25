<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Admin;
use App\Models\Topic;
use App\Models\General;
use Illuminate\Http\Request;
use App\Models\Thread;

class AdminController extends Controller
{
    public function showPanel() {
        $this->data['threadCount'] = Thread::countAllThreads();
        $this->data['threadCountRecent'] = Thread::countAllThreadsPast24h();

        $this->data['responsesCount'] = Thread::countResponses();
        $this->data['responsesCountRecent'] = Thread::countResponsesPast24h();

        $this->data['usersCount'] = Account::countUsers();
        $this->data['usersCountRecent'] = Account::countUsersPastMonth();

        $this->data['pages'] = Admin::getPages();
        $this->data['topics'] = Topic::getAllTopics();

        General::incrementView(3);

        $this->data['currentPage'] = 'main';

        $sum = \DB::select( \DB::raw('SELECT (select sum(views) from threads) + (select sum(views) from topics) + (select sum(views) from pages) as totalVisits') );

        $this->data['totalVisits'] = $sum[0]->totalVisits;
        return view('pages.admin_panel.main', $this->data);
    }
    public function showTopics() {
        General::incrementView(3);
        $topics = Topic::getAllTopics()->toArray();

        $topicsAndCount = [];
        foreach ($topics as $topic) {
            $app = app();
            $object = $app->make('stdClass');

            $object->general = $topic;
            $object->countThreads = Topic::countThreadsPerTopic($topic->id);
            $object->countPosts = Topic::countTotalPostsPerTopic($topic->id);
            $topic->lastThread = Topic::getLastThreadPerTopic($topic->id);
            $object->link = "/topic/".$topic->id;

            $topicsAndCount[] = $object;
        }

        $this->data['topics'] = $topicsAndCount;
        $this->data['currentPage'] = 'topics';

        return view('pages.admin_panel.topics', $this->data);
    }

    public function showThreads() {
        $allThreads = Thread::getAllThreads();
        $this->data['threads'] = $allThreads;

        $this->data['currentPage'] = 'threads';
        return view('pages.admin_panel.threads', $this->data);
    }
}
