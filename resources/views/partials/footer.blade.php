<footer class="footer">
  <div class="container">
    <div class="footer__wrap">
      <a class="logo" href="/"><img src="@asset('images/logo.png')" alt="kalian-smr"></a>
      @if (has_nav_menu('footer'))
        {!! wp_nav_menu(['menu' => 'footer', 'menu_class' => 'footer__menu']) !!}
      @endif
      <div class="footer__menu">
        <a class="footer__sushi" href="https://xopoce.ru/">
          @include('icon::xopoce', ['class' => 'xopoce'])
          <span>Суши-shop</span>
        </a>
        <a href="/covid">COVID-19</a>
      </div>
      <div class="footer__side">
        <div class="call">
          <a href="tel:@php the_field('phone',9) @endphp" class="call__phone">
            @include('icon::help-operator', ['class' => 'help'])
            <span href="tel:@php the_field('phone',9) @endphp">@php the_field('phone',9) @endphp</span>
          </a>
          <div class="call__callback">Заказать звонок</div>
        </div>
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
        <a href="/policy" class="policy">Политика конфиденциальности</a>
      </div>
    </div>
  </div>
</footer>
