<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentationFile extends Model {

	use HasFactory;

	protected $fillable = [
		'path'
	];

	public function application():BelongsTo{
		return $this->belongsTo(Application::class);
	}

}
