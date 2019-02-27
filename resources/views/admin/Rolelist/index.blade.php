@extends('admin.public')
@section('title')
管理员列表管理
@endsection
@section('content_title')
后台角色列表
@endsection
@section('content')
 <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i>后台角色列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 157px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 209px;">角色名</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 300px;">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
      @foreach($role as $row)
       <tr class="odd"> 
        <td class="  sorting_1">{{$row->id}}</td> 
        <td class=" ">{{$row->name}}</td> 
        <td class=" ">
        <form action="admin/adminuser/{{$row->id}}" method="post">
        <div class=" btn-group form-inline">
            <a href="/auth/{{$row->id}}" class="btn btn-info">分配权限</a>
            <!-- <button class="btn btn-success">普通删除</button> -->
            <!-- <a href="/admin/adminuser/{{$row->id}}/edit" class="btn btn-info"><i class="icon-wrench"></i>普通修改</a> --></td> 
          </div>
            {{method_field("DELETE")}}
            {{csrf_field()}}
          </form>
       </tr>
       @endforeach
      </tbody>
     </table>
     <div class="dataTables_paginate paging_full_numbers" id="pages">
     </div>
    </div> 
   </div> 
  </div>
@endsection
@section('title','后台角色列表')