<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>

  <meta charset="utf-8" />
  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />

  <title>Аптека</title>
  
  <!-- Included CSS Files (Compressed) -->
  <link rel="stylesheet" href="{{ asset('stylesheets/foundation.min.css') }}">
  <link rel="stylesheet" href="{{ asset('stylesheets/main.css') }}">
  <link rel="stylesheet" href="{{ asset('stylesheets/app.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/ligature.css') }}">

  
  <link rel="stylesheet" href="../fonts/ligature.css">
  
  <!-- Google fonts -->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic' rel='stylesheet' type='text/css' />

  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

</head>

<body>

<!-- ######################## Main Menu ######################## -->
 
 
<nav>

     <div class="twelve columns header_nav">

     <div class="row">
         <div id="line_block" width="50px">
        <ul id="menu-header" class="nav-bar horizontal">
        
          <li><a href="/">Главная</a></li>   
            @foreach($categories as $category)
          <li><a href="/category/{{$category->id_category}}">{{$category->name}}</a></li>
             @endforeach 

      
        </ul>
        </div> 
         
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
             <a href="{{route('cart',['status'=>'in'])}}" class="th"><img src="{{ asset('images') }}/cart.png" width=50 alt="desc" /></a>
                  @else 
                <a href="{{route('cart',['status'=>'out'])}}" class="th"><img src="{{ asset('images') }}/cart.png" width=50 alt="desc" /></a>
                  @endif
             </div>
         
         
         </div>
      </div>
<style>
#line_block {  
    position: relative;
        height:50%; 
        float:left; 
        margin: 0 15px 15px 0; 
        text-align:center;
        padding: 10px;
        }
</style>

      
</nav><!-- END main menu -->
        
<!-- ######################## Header (featured posts) ######################## -->
     
<header>
   

        <div class="row">
        
        <h1>Онлайн-аптека</h1>
        <form method="get" action="{{ route('search2',['number'=>$number])}}">
          <input name="s" id="s" placeholder="Введите название товара" type="search">
            <button class="" type="submit">Найти</button>
        </form>
    </div>
        
</header>
      
<!-- ######################## Section ######################## -->

<section>

  <div class="section_main">
   
      <div class="row">
      
          <section class="eight columns"> 
          @if(count($medicines))       
          @foreach($medicines as $record)
          <article class="blog_post">
          
             <div class="three columns">
             <a href="/{{$record->id_medicine}}" class="th"><img src="{{ asset('images') }}/{{ $record->image }}" alt="desc" /></a>
             </div>
             <div class="nine columns">
              <h4>{{$record->title}}</h4>
              <p> Производитель: {{$record->maker->title}}</p>
              <p> Цена: {{$record->cost}} руб.</p>
                 @if(Auth::check())
              <div><a href="{{route('description',['id'=>$record->id_medicine, 'auth'=>Auth::user()->id])}}"> Перейти на страницу товара</a></div>
                @else 
              <div><a href="{{route('description',['id'=>$record->id_medicine, 'auth'=>'0'])}}"> Перейти на страницу товара</a></div>
                @endif
              @if(Auth::check() && Auth::user()->role == "admin")<div><a href="{{route('Delete',['id'=>$statya->id] )}}">Удалить</a></div>
              @endif
              </div>
              
              
          </article>
          @endforeach 
          @else 
            <p>По вашему запросу ничего не найдено</p><br><br><br><br><br><br><br>
          @endif
          </section>
          @if(Auth::check() && Auth::user()->role == "admin")
          <section class="four columns">
            <H3>  &nbsp; </H3>
             <div class="panel">
              <h3>Админ-панель</h3>

            <ul class="accordion">
              <li class="active">
                <div class="title">
                   <a href="/add"><h5>Добавить статью</h5></a>
                </div>
               
              </li>
            </ul>
               
             </div>
          </section>
          @endif
         
          
      </div>
      
    </div>
      
</section>


<!-- ######################## Section ######################## -->

   <section>
   
      <div class="section_dark" style="bottom:20px">
        <table style="background-color: #262626; border: none; margin:auto;">
        <caption style="color:white;">Коронавирусная инфекция (COVID-19), Россия</caption>
          <tr>
            <td>
              <div style="color:gray; padding-top: 20px;">Случаи заболевания:</div>
              <div style="color:white; font-size: 24px; padding: 4px 0 0; padding-top: 20px;">{{ $covidData['confirmed'] }}</div>
              <div style="color:gray; font-size: 12px; padding-top: 10px;">(+{{ $covidData['confirmed_diff'] }})</div>
            </td>

            <td>
              <div style="color:gray; padding-top: 20px;">Летальные исходы:</div>
              <div style="color:white; font-size: 24px; padding: 4px 0 0; padding-top: 20px;">{{ $covidData['deaths'] }}</div>
              <div style="color:gray; font-size: 12px; padding-top: 10px;">(+{{ $covidData['deaths_diff'] }})</div>
            </td>
          </tr>
        </table>
        <p style="color: red; margin-left: 30%; padding-top: 15px; font-size: 16px;">Берегите себя! Не болейте и закупайтесь у нас на сайте только проверенными препаратами!</p>
      </div>
      
    </section>
<!-- ######################## Footer ######################## -->  
      
<footer style="">

      <div class="row" style="">
      
          <div class="twelve columns footer">
              <a href="" class="lsf-icon" style="font-size:16px; margin-right:15px" title="twitter">Twitter</a> 
              <a href="" class="lsf-icon" style="font-size:16px; margin-right:15px" title="facebook">Facebook</a>
              <a href="" class="lsf-icon" style="font-size:16px; margin-right:15px" title="pinterest">Pinterest</a>
              <a href="" class="lsf-icon" style="font-size:16px" title="instagram">Instagram</a>
          </div>
          
      </div>

</footer>		  

<!-- ######################## Scripts ######################## --> 

    <!-- Included JS Files (Compressed) -->
    <!-- Initialize JS Plugins -->

</body>
</html>