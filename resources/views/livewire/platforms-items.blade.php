<div>
    <div class="d-flex flex-row flex-wrap">
        <button  wire:click="$emit('openModal', 'platforms-modal')"  class="btn btn-outline-primary m-3 ">إضافة جديد</button >
          <a  class="btn btn-outline-primary m-3 " href="{{route('authors')}}">الكتاب</a>
    </div>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">صورة المنصة</th>
            <th scope="col">اسم المنصة</th>
            <th scope="col"> رابط المنصة</th>
            <th> العمليات</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($platforms as $item)
            <tr>
                <td><img 
                    src="{{ $item->image ? asset('storage/'.$item->image) : '' }}"  width="80px"
                    alt=""></td>
            <th>{{$item->name}}</th>
            <td>{{$item->url}}</td>
            <td>   <a  
                wire:click="$emit('openModal', 'platforms-modal' , {platform_id: {{$item->id}}})" ><span
                    class="fa fa-edit"></span> </a>
            <a  wire:click="destroy({{ $item->id }})"><span
                    class="fa fa-remove "></span></a></td>
          </tr>
            @endforeach
        
     
        </tbody>
      </table>
</div>
