<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Platform;
use LivewireUI\Modal\ModalComponent;
use App\Models\Author;
use Livewire\WithFileUploads;
class PlatformsModal extends ModalComponent
{

    use WithFileUploads;

    public $name , $image , $url  ,$author_id;

    public $platform_id , $platform , $authors;

    public $image2 ;
   
    protected $rules = [
        'name' => 'required',
      ];
    
  
    public function updated($propertyName)
    {
      $this->validateOnly($propertyName);
    }


    public function mount()
    {

        $this->authors = Author::get();

        if(!$this->author_id)
        {
             $this->author_id =  $this->authors->count() >0 ? $this->authors[0]->id : null;
        }
       

        if($this->platform_id)
        {
            
        $this->platform = Platform::where('id' , $this->platform_id)->first();
      
        $this->fill(['name' => $this->platform->name , 'url' => $this->platform->url , 'author_id' => $this->platform->author_id ]);

        $this->image2 =  $this->platform->image;   
        } 

    }

    public function save()
{

    $this->validate();

    if($this->platform_id)
    {

        $this->platform->update([
            'name' => $this->name,
            'url' => $this->url,
        ]);

        if ($this->image) {
            if ($this->platform->image) {
               
                    if (File_exists(public_path() . '/storage/' . $this->platform->image)) {
                        unlink(public_path() . '/storage/' . $this->platform->image);
                   
                }

                $this->platform->update(['image' => $this->storeImage()]);
            } else {

                $this->platform->update(['image' => $this->storeImage()]);
            }
        }

    }else{
        Platform::create([
            'name' => $this->name,
            'image' => $this->storeImage(),
            'url' => $this->url,
            'author_id' => $this->author_id
        ]);

    }

    $this->emit('reRender')->to(PlatformsItems::class);
    
    $this->closeModal();
}

public function storeImage()
{
  if (!$this->image) {

    return Null;
  }
  $name = $this->image->store('authors/', 'public');
  return $name;
}
public function deleteImage()
{
  
    $this->image = '';
    $this->image2 = '';
  
}



    public static function closeModalOnClickAway(): bool
    {
        return false;
    }
    public static function modalMaxWidth(): string
   {
   return 'md';
   }

   
    public function render()
    {
        return view('livewire.platforms-modal');
    }
}
