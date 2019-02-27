@extends('admin.public')
@section('title')
管理员列表管理
@endsection
@section('content_title')
后台权限列表
@endsection
@section('content')
 <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i>后台权限列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 157px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 209px;">权限名</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 209px;">控制器</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 209px;">方法</th>


        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width:200px;">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
      @foreach($nodelist as $row)
       <tr class="odd"> 
        <td class="  sorting_1">{{$row->id}}</td> 
        <td class=" ">{{$row->name}}</td>
        <td class=" ">{{$row->mname}}</td>
        <td class=" ">{{$row->aname}}</td> 
        <td class=" ">
          <form action="admin/adminsuser/{{$row->id}}" method="post">
          <div class=" btn-group form-inline">
            <button class="btn btn-success">删除</button>
            {{method_field("DELETE")}}
            {{csrf_field()}}
          <a href="/adminuser/{{$row->id}}/edit" class="btn btn-info"><i class="icon-wrench"></i>修改</a>
          </div>
          </td>
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
@section('title','后台权限列表')