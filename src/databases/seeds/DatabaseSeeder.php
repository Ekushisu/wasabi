<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker\Factory::create('fr_FR');

      $ranks = [
          [
              'name'                    => 'Non affecté',
              'path'                    => null
          ]
      ];


  		$userInsert = [
  			[
  				'username'                => 'Admin',
  				'password'				        => md5(hash('sha512', "Admin")),
  				'email' 				          => 'contact@localhost',
  				'banned'				          => 0,
  				'level'				            => 3,
  				'firstName'               => 'Stefan',
  				'lastName'                => 'Bekowsky',
  				'rank_id'                 => 1,
  				'created_at'			        => Carbon::now()
  			],
  			[
          'username'                => 'John',
          'password'				        => md5(hash('sha512', "John")),
          'banned'				          => 0,
          'level'				            => 1,
          'email' 				          => 'john@localhost',
          'firstName'               => 'John',
          'lastName'                => 'Doe',
          'rank_id'                 => 1,
          'created_at'		        	=> Carbon::now()
  			]
  		];

      for ($i=0; $i < 15; $i++) {
        $toInsert = [
          'username' 					     => $faker->userName,
          'password'				       => md5(hash('sha512', "Admin")),
          'banned' 				         => 0,
           'level' 			           => rand(0,1),
				  'email' 				         => $faker->email,
  				'firstName'              => $faker->firstName,
  				'lastName'               => $faker->lastName,
          'rank_id'                => 1,
  				'created_at'			       => Carbon::now()
        ];
        array_push($userInsert, $toInsert);
      }

      $opexs = [];
      for ($i=0; $i < 15; $i++) {
        $toInsert = [
          'name' 					         => $faker->realText($faker->numberBetween(30,100)),
          'periode'				         => $faker->monthName().' '.$faker->year( $max = 'now'),
          'location' 				       => $faker->region,
          'description' 			     => $faker->realText($faker->numberBetween(30,100)),
          'thumbnail' 				     => $faker->imageUrl,
        ];
        array_push($opexs, $toInsert);
      }

      $briefings = [];
      for ($i=0; $i < 20; $i++) {
        $toInsert = [
          'name' 					         => $faker->realText($faker->numberBetween(30,100)),
          'chapo' 			           => $faker->realText($faker->numberBetween(30,200)),
          'content' 			         => $faker->realText($faker->numberBetween(300,1000)),
          'thumbnail' 				     => $faker->imageUrl,
          'publiState' 			       => rand(0,1),
          'missionState'           => rand(0,1),
          'missionDate'            => $faker->dateTime($max = 'now'),
  				'created_at'			       => Carbon::now()
        ];
        array_push($briefings, $toInsert);
      }

      $categories = [];
      for ($i=0; $i < 3; $i++) {
        $toInsert = [
          'name' 					         => $faker->realText($faker->numberBetween(30,50)),
        ];
        array_push($categories, $toInsert);
      }

      $notes = [];
      for ($i=0; $i < 20; $i++) {
        $toInsert = [
          'name' 					         => $faker->realText($faker->numberBetween(30,50)),
          'category_id' 			     => rand(1,2),
          'author_id' 			       => 1,
          'thumbnail' 				     => $faker->imageUrl,
          'chapo' 				         => $faker->realText($faker->numberBetween(30,100)),
          'content' 			         => $faker->realText($faker->numberBetween(300,1000)),
          'publiState' 			       => rand(0,1),
  				'created_at'			       => Carbon::now()
        ];
        array_push($notes, $toInsert);
      }


  		$this->truncateTable('ranks');
  		DB::table('ranks')->insert($ranks);
  		$this->command->info('Rank table seeded!');

  		$this->truncateTable('users');
  		DB::table('users')->insert($userInsert);
  		$this->command->info('User table seeded!');

  		$this->truncateTable('opexs');
  		DB::table('opexs')->insert($opexs);
  		$this->command->info('Opex table seeded!');

  		$this->truncateTable('briefings');
  		DB::table('briefings')->insert($briefings);
  		$this->command->info('Briefings table seeded!');

  		$this->truncateTable('categories');
  		DB::table('categories')->insert($categories);
  		$this->command->info('Category table seeded!');

  		$this->truncateTable('notes');
  		DB::table('notes')->insert($notes);
  		$this->command->info('Note table seeded!');
    }

    private function truncateTable($table)
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      DB::table($table)->truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
      return true;
    }
}
