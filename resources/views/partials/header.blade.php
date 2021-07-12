<header class="header">
  <div class="container">
    <div class="header__wrap">
      <a class="logo img" href="/"><img src="@asset('images/logo.png')" alt="kalian-smr"></a>
      <div class="socials">
        <a class="socials-link" href="https://www.instagram.com/@php the_field('instagram',9) @endphp"
           target="_blank">
          @include('icon::instagram', ['class' => 'icon'])
        </a>
        <a class="socials-link" href="https://api.whatsapp.com/send?phone=@php the_field('whatsapp',9) @endphp"
           target="_blank">
          @include('icon::whatsapp', ['class' => 'icon'])
        </a>
        <a class="socials-link" href="tg://resolve?domain=@php the_field('telegram',9) @endphp" target="_blank">
          @include('icon::telegram', ['class' => 'icon'])
        </a>
      </div>
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'header__menu']) !!}
      @endif
      <a class="header__sushi" href="https://xopoce.ru/">
        @include('icon::xopoce', ['class' => 'xopoce'])
        <span>Суши-shop</span>
      </a>
      <div class="call">
        <a href="tel:@php the_field('phone',9) @endphp" class="call__phone">
          @include('icon::help-operator', ['class' => 'help'])
          <span href="tel:@php the_field('phone',9) @endphp">@php the_field('phone',9) @endphp</span>
        </a>
        <div class="call__callback">Заказать звонок</div>
      </div>
    </div>
  </div>
</header>
