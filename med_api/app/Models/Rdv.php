<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Rdv
 * 
 * @property int $id
 * @property Carbon $date_rdv
 * @property Carbon $heure_rdv
 * @property int $patient_id
 * @property int $medecin_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Utilisateur $utilisateur
 *
 * @package App\Models
 */
class Rdv extends Model
{
	protected $table = 'rdv';

	protected $casts = [
		'date_rdv' => 'datetime',
		'heure_rdv' => 'datetime',
		'patient_id' => 'int',
		'medecin_id' => 'int'
	];

	protected $fillable = [
		'date_rdv',
		'heure_rdv',
		'patient_id',
		'medecin_id'
	];

	public function utilisateur()
	{
		return $this->belongsTo(Utilisateur::class, 'patient_id');
	}
}
