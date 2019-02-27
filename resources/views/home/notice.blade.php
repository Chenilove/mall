@extends('home/public')

@section('title')
尤洪 买你所买
@endsection

@section('link')
<link type="text/css" rel="stylesheet" href="/status/home/css/style.css" />
    <!--[if IE 6]>
    <script src="/status/home/js/iepng.js" type="text/javascript"></script>
        <script type="text/javascript">
           EvPNG.fix('div, ul, img, li, input, a'); 
        </script>
    <![endif]-->    
    <script type="text/javascript" src="/status/home/js/jquery-1.11.1.min_044d0927.js"></script>
    <script type="text/javascript" src="/status/home/js/jquery.bxslider_e88acd1b.js"></script>
    
    <script type="text/javascript" src="/status/home/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/status/home/js/menu.js"></script>    
        
    <script type="text/javascript" src="/status/home/js/select.js"></script>
    
    <script type="text/javascript" src="/status/home/js/lrscroll.js"></script>
    
    <script type="text/javascript" src="/status/home/js/iban.js"></script>
    <script type="text/javascript" src="/status/home/js/fban.js"></script>
    <script type="text/javascript" src="/status/home/js/f_ban.js"></script>
    <script type="text/javascript" src="/status/home/js/mban.js"></script>
    <script type="text/javascript" src="/status/home/js/bban.js"></script>
    <script type="text/javascript" src="/status/home/js/hban.js"></script>
    <script type="text/javascript" src="/status/home/js/tban.js"></script>
    
    <script type="text/javascript" src="/status/home/js/lrscroll_1.js"></script>
    
@endsection

@section('content')

            <p></p>
            <div class="mem_tit">{{$info->tishi}}</div>
			<div class="address">
            	
            	<table border="0" class="" align="center"  cellspacing="0" cellpadding="0" width="100%">
                  <tbody>
                  <tr>
                  	<td width="40%"></td>
                    <td  style="font-size:20px; color:#ff4e00;">
                    {{$info->title}}
                    </td>
                 
                  </tr>
                  <tr>
					<td style="font-size:17px;" colspan="2">
						{!!$info->descr!!}
                    </td>
                  </tr>
                </tbody></table>
				
                

            </div>
       
@endsection