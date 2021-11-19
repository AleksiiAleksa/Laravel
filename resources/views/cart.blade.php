
<!DOCTYPE html>

<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />

  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />

  <title>Лекарство</title>
  
  <!-- Included CSS Files (Uncompressed) -->
  <!--
  <link rel="stylesheet" href="stylesheets/foundation.css">
  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <!-- Included CSS Files (Compressed) -->
  <link rel="stylesheet" href="{{ asset('stylesheets/foundation.min.css') }}">
  <link rel="stylesheet" href="{{ asset('stylesheets/main.css') }}">
  <link rel="stylesheet" href="{{ asset('stylesheets/app.css') }}">

         <script>
             function bt_plus($auth) 
             {
                 if($auth)
                 {
                    var all = parseInt(document.getElementById('all').value);
                    var wasted =  parseInt(document.getElementById('wasted').value);
                    var balance = all - wasted;
	                var num = parseInt(document.getElementById('output').value);
                    if(num < balance)
                    {
                        document.getElementById('output').value = num+1;
                    }
                    else
                    {
                        alert('На складе нет такого количества товара!');
                    }
                 }
                 else
                 {
                     alert("Авторизуйтесь!")
                 }
            }
             function bt_minus($auth) {
                 if($auth)
                 {
	                var num = parseInt(document.getElementById('output').value);
                    if(num<1)
                    {
                        document.getElementById('output').value = 0;
                    }
                    else
                    {
                        document.getElementById('output').value = num-1; 
                    }
                 }
                 else
                 {
                     alert("Авторизуйтесь!")
                 }
            }
             
             function changeItem($auth) {
                 if($auth)
                 {
                    var all = document.getElementById('all').value;
                    var wasted = document.getElementById('wasted').value;
                    var balance = all - wasted;
	                var num = parseInt(document.getElementById('output').value);
                    if(num<1)
                    {
                        document.getElementById('output').value = 0;
                    }
                    else if(num > balance)
                    {
                        alert('На складе нет такого количества товара!');
                        document.getElementById('output').value = balance;
                    }
                    else if(isNaN(num))
                    {
                        document.getElementById('output').value = 0;
                    }
                    else
                    {
                        document.getElementById('output').value = num; 
                    }
                 }
                 else
                 {
                     alert("Авторизуйтесь!")
                     document.getElementById('output').value = 0;
                 }
            }
        
        
         </script>

  <style>
      .table {
	width: 100%;
	margin-bottom: 20px;
	border: 1px solid #dddddd;
	border-collapse: collapse; 
}
.table th {
	font-weight: bold;
	padding: 5px;
	background: #efefef;
	border: 1px solid #dddddd;
}
.table td {
	border: 1px solid #dddddd;
	padding: 5px;
}

.quantity_inner * {
    box-sizing: border-box;    
}    
.quantity_inner {
    display: inline-flex;
    border-radius: 26px;
    border: 4px solid #337AB7;
}        
.quantity_inner .bt_minus,
.quantity_inner .bt_plus,
.quantity_inner #output {
    height: 40px;
    width: 40px;
    padding: 0;
    border: 0;
    margin: 0;
    background: transparent;
    cursor: pointer;
    outline: 0;
}
.quantity_inner #output {
    width: 75px;
    text-align: center;
    font-size: 30px;
    font-weight: bold;
    color: #000;
    font-family: Menlo,Monaco,Consolas,"Courier New",monospace;
}
.quantity_inner .bt_minus svg,
.quantity_inner .bt_plus svg {
    stroke: #337AB7;
    stroke-width: 4;
    transition: 0.5s;
    margin: 10px;
}    
 
.quantity_inner .bt_minus:hover svg,
.quantity_inner .bt_plus:hover svg {
    stroke: #000;
}
    </style>
  <link rel="stylesheet" href="{{ asset('fonts/ligature.css') }}">
  
  <!-- Google fonts -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic' rel='stylesheet' type='text/css' />

  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

</head>

<body>

<!-- ######################## Main Menu ######################## -->
 
<header>

     <div class="twelve columns header_nav">
     <div class="row">
        <a href="{{route('index')}}" >На главную</a>
        <div style="text-align: right">
          @if(Auth::check())
          {{ Auth::user()->name }}
          <a class="dropdown-item" href="{{ url('/logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выход
          </a>
          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
          @csrf
          </form>
          @else
          <a href="{{ url('/login') }}">Вход</a><br>
          <a href="{{ url('/register') }}">Регистрация</a>
          @endif
        </div>
      
        

        
      </div>  
      </div>
      
</header><!-- END main menu -->
        
<!-- ######################## Header ######################## -->
       
            <div class="row">
              
    <article>
            
             <div class="twelve columns">  
                  @if($auth == 'in') 
                 @if($cart->isEmpty())
                  <p>ВАША КОРЗИНА ПУСТАЯ</p>
                  @else
            <p>ВАША КОРЗИНА</p>
                    <table class="table">
                        	<thead>
		                      <tr>
			                     <th></th>
			                     <th>Название</th>
			                     <th>Количество</th>
                                  <th></th>
		                      </tr>
	                       </thead>
                        <tbody>
                @foreach($cart as $record)
                    @if($record->user_id == Auth::user()->id)
                            <tr><td><img src="{{ asset('images') }}/{{$record->medicine->image}}" alt="desc" width=200 align=center ></td><td><a href="{{route('description',['id'=>$record->medicine_id, 'auth'=>Auth::user()->id])}}" >{{$record->medicine->title}}</a></td><td>{{$record->amount}}</td><td> 
                        <form method="POST" action="{{route('changeCartIn',['id'=>$record->medicine_id, 'auth'=>Auth::user()->id])}}"  class="quantity_inner">  
                            {{ csrf_field() }}
                        <button class="bt_minus" onclick="bt_minus({{Auth::check()}})">
                            <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        </button>
                        <input onchange="changeItem({{Auth::check()}})" name="output" type="text" value="{{$record->amount}}" size="2" id="output">
                        <input type="hidden" name="authen" id="auth" value="{{Auth::user()->id}}">
                        <input type="hidden" name="medicine" id="med" value="{{$record->medicine_id}}">
                            @if(!$supply -> isEmpty())
                            @foreach($supply as $rec)
                            @if($record->medicine_id == $rec->medicine_id)
                        <input type="hidden" name="supplies" id="all" value="{{$rec->total}}">
                            @endif
                            @endforeach
                            @endif
                            
                             @if(!$order -> isEmpty())
                            @foreach($order as $rec)
                            @if($record->medicine_id == $rec->medicine_id)
                        <input type="hidden" name="orders" id="wasted" value="{{$rec->total}}">
                            @endif
                            @endforeach
                            @else
                            <input type="hidden" name="orders" id="wasted" value="0">
                            @endif
  
                        <button class="bt_plus"  onclick="bt_plus({{Auth::check()}})">
                            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        </button>
                        </form>
                        </td></tr>
                    @endif
                @endforeach
                        </tbody>
                </table>
                 <form method="POST" action="{{route('buying',['auth'=>Auth::user()->id])}}">
                     {{ csrf_field() }}
                     <button>
                            Купить
                        </button>
                 </form>
                  @endif
          @else 
            <p>Вы не авторизованы!</p>
                 <p>Таблица пуста!</p>
          @endif
             </div>
             
    </article>
    
    
            </div>

</body>
</html>