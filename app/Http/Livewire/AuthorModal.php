<?php

namespace App\Http\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\Author;
use Livewire\WithFileUploads;
use App\Models\Platform;
class AuthorModal extends ModalComponent
{

    use WithFileUploads;

    public $name , $image , $work , $summary , $platforms;

    public $author_id , $author , $platformItems;

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

      

        if($this->author_id)
        {
            
        $this->author = Author::where('id' , $this->author_id)->first();
      
        $this->fill(['name' => $this->author->name , 'work' => $this->author->work , 'summary' => $this->author->summary]);

        $this->image2 =  $this->author->image;   
        } 

    }

    public function save()
{

    $this->validate();

    if($this->author_id)
    {

        $this->author->update([
            'name' => $this->name,
            'work' => $this->work,
            'summary' => $this->summary,
           
        ]);

        if ($this->image) {
            if ($this->author->image) {
               
                    if (File_exists(public_path() . '/storage/' . $this->author->image)) {
                        unlink(public_path() . '/storage/' . $this->author->image);
                   
                }

                $this->author->update(['image' => $this->storeImage()]);
            } else {

                $this->author->update(['image' => $this->storeImage()]);
            }
        }

    }else{
        Author::create([
            'name' => $this->name,
            'image' => $this->storeImage(),
            'work' => $this->work,
            'summary' => $this->summary,
        ]);

    }

    $this->emit('reRender')->to(AuthorItems::class);
    
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
        return view('livewire.author-modal');
    }
}
