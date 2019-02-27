@extends('admin.public')
@section('title')
尤洪后台管理首页
@endsection

@section('content_title')
欢迎来到后台首页
@endsection
@section('content')
<div class="col-sm-12">
                <section class="panel">
                <header class="panel-heading">
                    站内信列表
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                         <a href="javascript:;" class="fa fa-times"></a>
                     </span>
                </header><!--  -->
                <table class="table table-striped table-hover table-bordered dataTable" id="editable-sample" aria-describedby="editable-sample_info">
                <thead>
                <tr role="row">
                <th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="First Name" style="width: 205px;">id</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="editable-sample" rowspan="1" colspan="1" aria-label="Last Name: activate to sort column ascending" style="width: 200px;">标题
                </th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="editable-sample" rowspan="1" colspan="1" aria-label="Points: activate to sort column ascending" style="width: 129px;">内容
                </th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="editable-sample" rowspan="1" colspan="1" aria-label="Points: activate to sort column ascending" style="width: 129px;">选择发送用户
                </th>
                
                
                <th class="sorting" role="columnheader" tabindex="0"  aria-controls="editable-sample" rowspan="1" colspan="1" aria-label="Delete: activate to sort column ascending" style="width: 134px;">删除</th>
                </tr>
                </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
            <tr class="odd">
            @foreach($Mali as $row)
             <td class=" sorting_1">{{$row->id}}</td>
             <td class=" ">{{$row->title}}</td>
             <td class=" ">{{$row->content}}</td>
             <td>
             <button ><a class="fa-share" href="">点击选择</a>
            </button>
            </td>
            <!--  <form action="/link/{{$row->id}}" method="post">
            {{csrf_field()}}
            {{method_field('DELETE')}}
             </form> -->
             <form action="/Mali/{{$row->id}}" method="post">
            {{csrf_field()}}
            {{method_field('DELETE')}}
           <td> <button type="submit"  class="fa fa-trash-o">删除</button></td> 
             </form>
             </tr>
            @endforeach

            </tbody>
            </table>
            <div class="row">
            <div class="col-lg-6"></div>
            <div class="col-lg-6">
            {{$Mali->render()}}
            </div>
            </div>
            </div>
                </div>
                </div>
                </section>
                </div>
@endsection