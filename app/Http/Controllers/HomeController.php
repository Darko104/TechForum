<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\General;
use phpDocumentor\Reflection\Types\ClassString;

class HomeController extends BasicController
{
    public function index() {
        $categories = Topic::getCategories();
        $categoriesAndTheirTopics = [];

        foreach ($categories as $category) {
            $topics = Topic::getTopicsByCategory($category->id);

            $app = app();
            $object = $app->make('stdClass');
            $object->category = $category;
            $object->topics = Topic::getTopicsSubtopicsAndCounts($topics);

            $categoriesAndTheirTopics[] = $object;
        }

        $this->data['categories'] = $categoriesAndTheirTopics;
        $this->data['page'] = [['Home', '/'], ['Forum Index','/']];

        General::incrementView(1);

        return view('pages.home', $this->data);
    }
}
