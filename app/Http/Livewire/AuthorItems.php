<?php

namespace App\Http\Livewire;

use App\Models\Author;
use Livewire\Component;

class AuthorItems extends Component
{

    public $authors ;
    
    protected $listeners = ['reRender'];
    

    public function destroy($id)
    { 
        Author::find($id)->delete();
 
        $this->dispatchBrowserEvent('showsuccess', ['title' => 'Success','message'=> 'تم الحذف']);
 
   }

    public function reRender()
    {

        $this->render();
    }
    public function render()
    {

        $this->authors = Author::get();

        return view('livewire.author-items');
    }
}
