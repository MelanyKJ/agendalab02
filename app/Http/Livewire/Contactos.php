<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Contacto;

class Contactos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $apellido, $edad, $cumpleaños, $direccion, $telefono;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.contactos.view', [
            'contactos' => Contacto::latest()
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('apellido', 'LIKE', $keyWord)
						->orWhere('edad', 'LIKE', $keyWord)
						->orWhere('cumpleaños', 'LIKE', $keyWord)
						->orWhere('direccion', 'LIKE', $keyWord)
						->orWhere('telefono', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->nombre = null;
		$this->apellido = null;
		$this->edad = null;
		$this->cumpleaños = null;
		$this->direccion = null;
		$this->telefono = null;
    }

    public function store()
    {
        $this->validate([
		'nombre' => 'required',
		'apellido' => 'required',
		'edad' => 'required',
		'cumpleaños' => 'required',
		'direccion' => 'required',
		'telefono' => 'required',
        ]);

        Contacto::create([ 
			'nombre' => $this-> nombre,
			'apellido' => $this-> apellido,
			'edad' => $this-> edad,
			'cumpleaños' => $this-> cumpleaños,
			'direccion' => $this-> direccion,
			'telefono' => $this-> telefono
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Contacto Successfully created.');
    }

    public function edit($id)
    {
        $record = Contacto::findOrFail($id);

        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->apellido = $record-> apellido;
		$this->edad = $record-> edad;
		$this->cumpleaños = $record-> cumpleaños;
		$this->direccion = $record-> direccion;
		$this->telefono = $record-> telefono;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required',
		'apellido' => 'required',
		'edad' => 'required',
		'cumpleaños' => 'required',
		'direccion' => 'required',
		'telefono' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Contacto::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'apellido' => $this-> apellido,
			'edad' => $this-> edad,
			'cumpleaños' => $this-> cumpleaños,
			'direccion' => $this-> direccion,
			'telefono' => $this-> telefono
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Contacto Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Contacto::where('id', $id);
            $record->delete();
        }
    }
}
