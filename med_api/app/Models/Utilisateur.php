<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Utilisateur
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Patient[] $patients
 * @property Collection|Rdv[] $rdvs
 *
 * @package App\Models
 */
class Utilisateur extends Model
{
	protected $table = 'utilisateurs';

	public function patients()
	{
		return $this->hasMany(Patient::class);
	}

	public function rdvs()
	{
		return $this->hasMany(Rdv::class, 'patient_id');
	}
}
