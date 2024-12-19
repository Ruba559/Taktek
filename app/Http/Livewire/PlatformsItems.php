<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Platform;
class PlatformsItems extends Component
{

    public $platforms ;
    
    protected $listeners = ['reRender'];
    

    public function destroy($id)
    { 
        Platform::find($id)->delete();
 
        $this->dispatchBrowserEvent('showsuccess', ['title' => 'Success','message'=> 'تم الحذف']);
 
   }

    public function reRender()
    {

        $this->render();
    }
    public function render()
    {

        $this->platforms = Platform::get();
   
        return view('livewire.platforms-items');
    }
}
