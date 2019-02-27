@foreach($brand as $row)
<label>
    <input type="radio" name="brand_id" value="{{$row->brand_id}}" checked>
    <font>{{$row->brand_name}}</font>
    <img src="{{$row->img}}" alt="图片缺失" width="50px">
</label>
@endforeach