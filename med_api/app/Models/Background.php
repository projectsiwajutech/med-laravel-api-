<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Background
 * 
 * @property int $id
 * @property string $libelle
 * @property string $code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Patient[] $patients
 *
 * @package App\Models
 */
class Background extends Model
{
	protected $table = 'backgrounds';

	protected $fillable = [
		'libelle',
		'code'
	];

	public function patients()
	{
		return $this->hasMany(Patient::class);
	}
}
