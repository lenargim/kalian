<footer class="footer">
  <div class="container">
    <div class="footer__wrap">
      <a class="logo" href="/"><img src="@asset('images/logo.png')" alt="kalian-smr"></a>
      @if (has_nav_menu('footer'))
        {!! wp_nav_menu(['menu' => 'footer', 'menu_class' => 'footer__menu']) !!}
      @endif
      <div class="footer__side">
        <div class="call">
          <a href="tel:@php the_field('phone',9) @endphp" class="call__phone">
            @include('icon::help-operator', ['class' => 'help'])
            <span href="tel:@php the_field('phone',9) @endphp">@php the_field('phone',9) @endphp</span>
          </a>
          <div class="call__callback open-callback">Заказать звонок</div>
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
<div class="overlay">
  <div class="modal modal-img">
    <div class="modal__close"></div>
    <div class="modal-img__box"></div>
  </div>
  <div class="modal modal-order">
    <div class="modal__close"></div>
    <div class="modal-order__box">
      <div class="modal-order__title">проверьте ваш заказ</div>
      <button class="modal-order__back">Вернуться назад</button>
      @php echo do_shortcode('[contact-form-7 id="142" title="Order"]') @endphp
    </div>
  </div>
  <div class="modal modal-callback">
    <div class="modal__close"></div>
    <div class="modal-callback__box">
      <div class="modal-callback__title">Закажите звонок</div>
      <div class="modal-callback__desc">И мы перезвоним вам в ближайшее время</div>
      @php echo do_shortcode('[contact-form-7 id="182" title="Callback"]') @endphp
    </div>
  </div>
  <div class="modal modal-thx">
    <div class="modal__close"></div>
    <div class="modal-thx__box">
      @include('icon::modal-thx', ['class' => 'icon'])
      <div class="modal-thx__title">Спасибо за вашу заявку</div>
      <div class="modal-thx__phone">Ваш номер телефона: <span class="phone"></span></div>
      <div class="modal-thx__desc">Наш специалист свяжется с Вами <span style="white-space: nowrap">в самое ближайшее время</span></div>
    </div>
  </div>
</div>
