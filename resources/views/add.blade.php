<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>

  <meta charset="utf-8" />
  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />

  <title>Онлайн-аптека</title>
  
  <!-- Included CSS Files (Compressed) -->
  <link rel="stylesheet" href="{{ asset('stylesheets/foundation.min.css') }}">
  <link rel="stylesheet" href="{{ asset('stylesheets/main.css') }}">
  <link rel="stylesheet" href="{{ asset('stylesheets/app.css') }}">

  <script src="{{ asset('javascripts/modernizr.foundation.js') }}"></script>
  
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
 
<nav>

     <div class="twelve columns header_nav">
     <div class="row">
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
      
        <ul id="menu-header" class="nav-bar horizontal">
        
          <li><a href="/">Главная</a></li>     
          <li><a href="/Category/Искусственный интеллект">Derma косметика</a></li>
          <li><a href="/Category/Искусственная нейронная сеть">Базовый уход</a></li>
          <li><a href="/Category/Распознавание образов">Профессиональная косметика</a></li>
          <li><a href="/Category/Робототехника">Витамины и добавки</a></li>
          <li><a href="/Category/Информационное общество">Болезни суставов</a></li>
          <li><a href="/Category/Автоматическая обработка текста">Зрение</a></li>
          <li><a href="/Category/Информационное общество">Диабет</a></li>
          <li><a href="/Category/Автоматическая обработка текста">Медицинские приборы</a></li>
      
        </ul>
        
        <script type="text/javascript">
         //<![CDATA[
         $('ul#menu-header').nav-bar();
          //]]>
        </script>
        
      </div>  
      </div>
      
</nav><!-- END main menu -->
        
<!-- ######################## Header (featured posts) ######################## -->
     
<header>
   

        <div class="row">
        
        <h1>Добавить статью</h1>
        
</header>
<section>
<div class="section_main">
<div class="row">
<section class="eight columns">          
<form method="POST" action="{{route('AddNews')}}">
{{ csrf_field() }}
Заголовок: <input type="text" name="title"> <br>
Лид: <input type="text" name="lid"><br>
Текст: <textarea type="text" name="content" rows="10"></textarea> <br>
Рубрика:
<select name="rubrics">
  <option value="Искусственный интеллект">Искусственный интеллект</option>
  <option value="Искусственная нейронная сеть">Искусственная нейронная сеть</option>
  <option value="Распознавание образов">Распознавание образов</option>
  <option value="Робототехника">Робототехника</option>
  <option value="Информационное общество">Информационное общество</option>
  <option value="Автоматическая обработка текста">Автоматическая обработка текста</option>
</select><br><br>
Картинка: <input type="text" name="image"> <br>
<button type="submit" style="border-radius: 3px;border: 1px #2ba6cb solid;color: #2ba6cb; font-size:14px;text-align: center;background-color: white;width:150px;height:34px;">Добавить статью</button>
</form>                   
</section>          
</div>
</div>
</section>
      
<!-- ######################## Section ######################## -->




<!-- ######################## Section ######################## -->

   <section>
   
      <div class="section_dark">
      <div class="row"> 
      
      <h2></h2>
      
          <div class="two columns">
          <img src="{{ asset('images/thumb1.jpg') }}" alt="desc" />
          </div>
          
          <div class="two columns">
          <img src="{{ asset('images/thumb2.jpg') }}"  alt="desc" />
          </div>
          
          <div class="two columns">
          <img src="{{ asset('images/thumb3.jpg') }}"  alt="desc" />
          </div>
          
          <div class="two columns">
          <img src="{{ asset('images/thumb4.jpg') }}"  alt="desc" />
          </div>
          
          <div class="two columns">
          <img src="{{ asset('images/thumb5.jpg') }}"  alt="desc" />
          </div>
          
          <div class="two columns">
          <img src="{{ asset('images/thumb6.jpg') }}"  alt="desc" />
          </div>

      
      </div>
      </div>
      
    </section>


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

<!-- ######################## Scripts ######################## --> 

    <!-- Included JS Files (Compressed) -->
    <script src="{{ asset('javascripts/foundation.min.js') }}" type="text/javascript"></script> 
    <!-- Initialize JS Plugins -->
     <script src="{{ asset('javascripts/app.js') }}" type="text/javascript"></script>
</body>
</html>