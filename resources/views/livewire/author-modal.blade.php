<div class="modal-content p-3">
    <div class="modal-header">
      <h5 class="modal-title">إضافة كاتب</h5>
      
    </div>
  
<form  wire:submit.prevent="save">

    <div class="row">
        <label for="formFileMultiple" class="btn btn-primary btn-sm form-label mt-3 p-2 w-100 radius-10 text-center"><span class="fa fa-image mx-2"></span> اختر الصورة</label>
        <input class="form-control" type="file" wire:model="image" id="formFileMultiple" hidden wire:loading.attr="disabled" wire:target='image' />

        <div wire:loading wire:target="image">تحميل</div>
        <div class="progress">
            <div class="progress-bar" style="width:0%">0%</div>
        </div>
        <div class="cart-img-container">
            @if ($image)
            <div class="deleter" wire:click="deleteImage()">
                <span class="fa fa-trash "></span>
            </div>

            <div class="col-12 mb-1">
                <img class="img-fluid " src="{{ $image->temporaryUrl() }}">
            </div>
            @else
            @if ($image2)
            <div class="deleter" wire:click="deleteImage()">
                <span class="fa fa-trash "></span>
            </div>
            <div class="col-12 mb-1">
                <img class="img-fluid " src="{{ asset('storage/' . $image2) }}">
            </div>
            @endif

            @endif
        </div>

    </div>
    <div class="form-group">
        <label for="name">الاسم</label>
        <input type="text" wire:model="name" class="form-control" id="name" >
       
      </div>
      @error('name')
      <span class="error red-text">{{ $message }}</span>
      @enderror

      <div class="form-group">
        <label for="work">العمل</label>
        <input type="text" wire:model="work" class="form-control" id="work" >
       
      </div>
      @error('work')
      <span class="error red-text">{{ $message }}</span>
      @enderror
      <div class="form-group">
        <label for="summary">نبذة عن الكاتب</label>
        <textarea type="text" wire:model="summary" class="form-control" id="summary" ></textarea>
       
      </div>
      @error('summary')
      <span class="error red-text">{{ $message }}</span>
      @enderror
      


    <div class="modal-footer">
      <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target='save' > <span class="spinner spinner-grow " wire:loading wire:target='save'></span> حفظ</button>
      <button type="button" class="btn btn-secondary" wire:click="closeModal()">إغلاق</button>
    </div>
</form>
  </div>