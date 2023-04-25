<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Patient
 * 
 * @property int $id
 * @property int $utilisateur_id
 * @property int $background_id
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Background $background
 * @property Utilisateur $utilisateur
 *
 * @package App\Models
 */
class Patient extends Model
{
	protected $table = 'patients';

	protected $casts = [
		'utilisateur_id' => 'int',
		'background_id' => 'int'
	];

	protected $fillable = [
		'utilisateur_id',
		'background_id',
		'description'
	];

	public function background()
	{
		return $this->belongsTo(Background::class);
	}

	public function utilisateur()
	{
		return $this->belongsTo(Utilisateur::class);
	}
}
