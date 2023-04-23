<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\JobOffer;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobOfferFactory extends Factory {

	protected $model = JobOffer::class;

	public function definition():array{
		return [
			'title' => fake()->text(50),
			'description' => fake()->realText(4000),
			'requirements' => fake()->realText(10000),
			'benefits' => fake()->realText(10000),
			'interview_at' => now()->addWeeks(3),
			'department_id' => Department::inRandomOrder()->first('id')->id,
			'starts_at' => now()->subWeek(),
			'ends_at' => now()->addWeek(),
			'visible' => rand(0, 1)
		];
	}

}
