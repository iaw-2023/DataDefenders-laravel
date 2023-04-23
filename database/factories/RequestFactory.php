<?php

namespace Database\Factories;

use App\Models\ExchangeOffer;
use App\Models\InternshipOffer;
use App\Models\JobOffer;
use App\Models\Request;
use App\Models\ScholarshipOffer;
use App\Models\User;
use App\Patterns\State\Request\RequestStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestFactory extends Factory {

	protected $model = Request::class;

	public function definition():array{
		$rand = rand(0, 1);
		return [
			'number' => fake()->numberBetween(),
			'user_id' => User::inRandomOrder()->first('id')->id,
			'offer_id' => match($rand){
				0 => JobOffer::inRandomOrder()->first('id')->id,
				1 => ScholarshipOffer::inRandomOrder()->first('id')->id,
			},
			'offer_type' => match($rand){
				0 => JobOffer::class,
				1 => ScholarshipOffer::class,
			},
			'status' => RequestStatus::Pending,
		];
	}

}
