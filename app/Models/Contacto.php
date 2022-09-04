<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'contactos';

    protected $fillable = ['nombre','apellido','edad','cumpleaños','direccion','telefono'];
	
}
