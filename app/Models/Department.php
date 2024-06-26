<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model {

	use HasFactory;

	protected $fillable = [
		'name',
	];

	public function majors():HasMany{
		return $this->hasMany(Major::class);
	}

	public function jobOffers():HasMany{
		return $this->hasMany(JobOffer::class);
	}

}
