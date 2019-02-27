@extends('admin.public')
@section('title')
管理员列表管理
@endsection
@section('content_title')
管理员列表管理
@endsection
@section('content')
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i>后台管理员列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 157px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 209px;">管理员</th>
        <!-- <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 137px;">密码</th> -->
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 900px;">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
         @foreach($adminuser as $row)
       <tr class="odd"> 
        <td class="  sorting_1">{{$row->id}}</td> 
        <td class=" ">{{$row->name}}</td> 
        <!-- <td class=" ">{{$row->password}}</td> -->
        <td class=" ">
          <form action="/admin/adminsuser/{{$row->id}}" method="post">
          <div class=" btn-group form-inline">
            <a href="/adminrole/{{$row->id}}" class="btn btn-success"><i class="fa fa-users"></i>分配角色</a>
            <button type='submit' class="btn btn-danger"><i class='fa fa-trash-o '></i>删除用户</button>
            <!-- <a class='btn btn-info' href="/adminsuser/{{$row->id}}/edit" ><i class="fa fa-sun-o">修改用户</i></a>  -->
            </div>
          {{method_field("DELETE")}}
          {{csrf_field()}}
          </form>
        </td>
      </tr>
      @endforeach
      </tbody>
     </table>
     <div class="dataTables_paginate paging_full_numbers" id="pages">
     {{$adminuser->render()}}
     </div>
    </div> 
   </div> 
  </div>
@endsection
@section('content-title','后台管理员列表')