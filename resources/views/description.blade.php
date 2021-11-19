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
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title>Лекарство</title>
  
  <!-- Included CSS Files (Uncompressed) -->
  <!--
  <link rel="stylesheet" href="stylesheets/foundation.css">

  <!-- Included CSS Files (Compressed) -->
  <link rel="stylesheet" href="{{ asset('stylesheets/foundation.min.css') }}">
  <link rel="stylesheet" href="{{ asset('stylesheets/main.css') }}">
  <link rel="stylesheet" href="{{ asset('stylesheets/app.css') }}">

         <script>
  
             function bt_plus($auth) 
             {
                 if($auth)
                 {
                    var wasted =  parseInt(document.getElementById('wasted').value);
                    var all = parseInt(document.getElementById('all').value);
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

  
  <link rel="stylesheet" href="{{ asset('fonts/ligature.css') }}">
  
  <!-- Google fonts -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic' rel='stylesheet' type='text/css' />

  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
<style>

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
</head>

<body>

<!-- ######################## Main Menu ######################## -->

        
<!-- ######################## Header ######################## -->
     
    <header>
            <div class="twelve columns header_nav">

     <div class="row">
         
         <div id="line_block" style="text-align: right">
        <div style="margin-right: 20px">
          @if(Auth::check())
          {{ Auth::user()->name }}
          <a class="dropdown-item" href="{{ url('/logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Выход
          </a>
          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
          @csrf
          </form>
        </div>
          @else
             <div style="margin-right: 20px">
                <a href="{{ url('/login') }}">Вход</a><p>
                <a href="{{ url('/register') }}">Регистрация</a>
            </div>
          @endif
        </div>
         
            <div id="line_block">
                @if(Auth::check())
             <a href="{{route('cart',['status'=>'in'])}}" class="th"><img src="{{ asset('images/cart.png') }}" width=50 alt="desc" /></a>
                  @else 
                <a href="{{route('cart',['status'=>'out'])}}" class="th"><img src="{{ asset('images/cart.png') }}" width=50 alt="desc" /></a>
                  @endif
             </div>
         
         
         </div>
      </div>
            <div class="row">
               <h4 style="margin-left:15px">{{ $medicine->category->name}}</h4>
    <article>
            
             <div class="twelve columns">
                 <h1>{{ $medicine->title}}</h1>
                      <p class="excerpt">
                      Форма выпуска: {{ $medicine->release->title}}
                      </p>    
             </div>
             
    </article>
    
    
            </div>
            
    </header>
      
<!-- ######################## Section ######################## -->

<section class="section_light">

      
      <div class="row">
      

      <p> <img src="{{ asset('images') }}/{{ $medicine->image }}" alt="desc" width=300 align=left hspace=30>
      <b>Применение:</b> {{$medicine->testimony}}</p>
      <p><b>Производитель:</b>  {{$medicine->maker->title}}</p>
      <p><b> Цена:</b> {{$medicine->cost}} руб.</p>
           @if($supply != null)
       <input type="hidden" name="supplies" id="all" value="{{$supply->total}}">
          @endif
          @if($order!= null)
       <input type="hidden" name="orders" id="wasted" value="{{$order->total}}">
          @else 
           <input type="hidden" name="orders" id="wasted" value="0">
          @endif
          
           @if(Auth::check())
           <form method="POST" action="{{route('changeCart',['id'=>$medicine->id_medicine, 'auth'=>Auth::user()->id])}}"  class="quantity_inner">  
            {{ csrf_field() }}
               <button class="bt_minus" onclick="bt_minus({{Auth::check()}})">
                <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            </button>
            <input onchange="changeItem({{Auth::check()}})" name="output" type="text" value="{{$amount}}" size="2" id="output">
            <input type="hidden" name="authen" id="auth" value="{{Auth::user()->id}}">
            <input type="hidden" name="medicine" id="med" value="{{$medicine->id_medicine}}">
                <button class="bt_plus"  onclick="bt_plus({{Auth::check()}})">
                <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            </button>
          </form>
            @else 
          <div class="quantity_inner"> 
               <button class="bt_minus" onclick="bt_minus({{Auth::check()}})">
                <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            </button>
            <input onchange="changeItem({{Auth::check()}})" name="output" type="text" value="{{$amount}}" size="2" id="output"/>
            <input type="hidden" name="authen" id="auth" value="0">
            <input type="hidden" name="medicine" id="med" value="{{$medicine->id_medicine}}">
                <button class="bt_plus"  onclick="bt_plus({{Auth::check()}})">
                <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            </button>
            </div>
            @endif
      </div>


      
      

<!-- ######################## Footer ######################## -->  
      
<footer>

      <div class="row">
      
          <div class="twelve columns footer">
              <a href="" class="lsf-icon" style="font-size:16px; margin-right:15px" title="twitter">Twitter</a> 
              <a href="" class="lsf-icon" style="font-size:16px; margin-right:15px" title="facebook">Facebook</a>
              <a href="" class="lsf-icon" style="font-size:16px; margin-right:15px" title="pinterest">Pinterest</a>
              <a href="" class="lsf-icon" style="font-size:16px" title="instagram">Instagram</a>
          </div>
          
      </div>

</footer>		  
    </section>
<!-- ######################## Scripts ######################## --> 
     
    <!-- Initialize JS Plugins -->
</body>
</html>