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
  <link rel="stylesheet" href="stylesheets/foundation.min.css">
  <link rel="stylesheet" href="stylesheets/main.css">
  <link rel="stylesheet" href="stylesheets/app.css">

  <script src="{{ asset('javascripts/modernizr.foundation.js') }}"></script>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js">
    </script> 
  <link rel="stylesheet" href="fonts/ligature.css">
  
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
         <div style="text-align: right">
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
     <div class="row">

        <ul id="menu-header" class="nav-bar horizontal">
        
          <li><a href="/">Главная</a></li>   
            @foreach($categories as $category)
          <li><a href="/category/{{$category->id_category}}">{{$category->name}}</a></li>
             @endforeach 

      
        </ul>

        
      </div>  
      </div>
      
</nav><!-- END main menu -->
        
<!-- ######################## Header (featured posts) ######################## -->
     
<header style="height: 150px;">
        <h1 style="margin-left: 630px">Онлайн-аптека</h1>
        <form method="get" action="{{ route('search') }}">
          <input name="s" id="s" placeholder="Введите название товара" type="search" style="width: 900px; margin-left: 300px"> <button type="submit" style="float: right; margin: 0 250px -100px 0; box-sizing:none">Найти</button>
        </form>
        
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
             <a href="" class="th"><img src="images/{{$record->image}}" alt="desc" /></a>
             </div>
             <div class="nine columns">
              <p style="color: red"> ХИТ ПРОДАЖ! </p>
              <a href="{{route('description',['id'=>$record->id_medicine])}}"><h4>{{$record->title}}</h4></a>
              <p> Производитель: {{$record->maker->title}}</p>
              <p> Цена: {{$record->cost}} руб.</p>


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

      <script src="{{ asset('javascripts/foundation.min.js') }}" type="text/javascript"></script> 
             <script src="{{ asset('javascripts/app.js') }}" type="text/javascript"></script>
    <!-- Initialize JS Plugins -->
    

</body>
</html>