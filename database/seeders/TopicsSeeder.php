<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $names = ['Topic 1', 'Topic 2', 'Topic 3', 'Topic 4', 'Topic 5', 'Topic 6', 'Topic 7', 'Topic 8', 'Topic 9', 'Subtopic 1', 'Subtopic 2', 'Subtopic 3'];
    private $categoryIds = [1, 1, 1, 2, 2, 2, 3, 3, 3, null, null, null];
    private $parentTopicIds = [null, null, null, null, null, null, null, null, null, 3, 3, 3];

    public function run()
    {
        for($i = 0; $i < count($this->names); $i++) {
            // If thread has a parent, assign it parents value.
            if ($this->parentTopicIds[$i] != null) {
                $categoryId = $this->categoryIds[$this->parentTopicIds[$i] - 1];
            }
            else $categoryId = $this->categoryIds[$i];

            \DB::table('topics')->insert([
                'name' => $this->names[$i],
                'category_id' => $categoryId,
                'parent_id' => $this->parentTopicIds[$i],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
