<?php

namespace Database\Seeders;

use Faker\Factory; 
use App\Models\Event;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(int $eventCount = 20, int $ticketCount = 5): void
    {
        //if category empty run CategorySeeder
        if(Category::count() == 0){
            $this->call(CategorySeeder::class);
        }
        //insert data using faker(FAKING A DATA)
        $faker = Factory::Create(); 
        
        // make an event which is base on eventCount
        for($i=0; $i < $eventCount; $i++){
        //create Event
        // $allCategoryIds = Category::pluck('id')->toArray();
        // $category_id = $faker->randomElement($allCategoryIds);

        // $category_id = Category::inRandomOrder()->first()->id;
    $event = Event::create([
        'name'=>$faker->sentence(2),
        'slug'=>$faker->slug(2),
        'headline'=>$faker->sentence(7),
        'description'=>$faker->paragraph(1),
        'start_time'=>$faker->dateTimeBetween('+1month','+6month'),
        'location'=>$faker->address,
        'duration'=>$faker->numberBetween(1,10),
        'is_populer'=>$faker->boolean(20),
        'type'=>$faker->randomElement(['online','offline']),
        'category_id'=>Category::inRandomOrder()->first()->id,
        
        
        ]);
        // make ticket which is base on tickerCount
        for($t = 0; $t < $ticketCount; $t++){
           $event->tickets()->create([
            'name'=>$faker->sentence(2),
            'price'=>$faker->numberBetween(10,100),
            'quantity'=>$faker->numberBetween(10,100),
            'max_buy'=>$faker->numberBetween(1,10),
           ]);
        }
      }
   }
}
