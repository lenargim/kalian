<div class="banner">
  <div class="banner__slider-wrap">
    <div class="banner__slider">
      @while(have_rows('banner')) @php the_row() @endphp
      <div class="banner__item-wrap">
        <div class="banner__item">
          <div class="banner__img"><img src="@php the_sub_field('img') @endphp" alt="@php the_sub_field('title') @endphp"></div>
          <div class="container">
            <div class="banner__wrap">
              <div class="banner__title">@php the_sub_field('title') @endphp</div>
              @if(!wp_is_mobile())
                <div class="banner__link button open-callback">Заказать</div>
              @endif
            </div>
            @if( get_sub_field('show-block') == true )
            <div class="banner__info">
              <div class="banner__price">от <span>@php the_sub_field('price') @endphp</span></div>
              <div class="banner__tabak">
                <p class="heading">Табаки:</p>
                @php the_sub_field('tabaki') @endphp
              </div>
              <div class="banner__extra">@php the_sub_field('extra') @endphp</div>
            </div>
            @endif
            @if(wp_is_mobile())
              <div class="banner__link button open-callback">Заказать</div>
            @endif
          </div>
        </div>
      </div>
      @endwhile
    </div>
    <div class="banner__arrow-box">
      <span class="banner__slider-counter"></span>
    </div>
  </div>
  <div class="banner__advantages">
    <div class="container">
      <div class="banner__advantages-wrap">
        <div class="banner__advantages-item">
          @include('icon::hookah1', ['class' => 'hookah'])
          <div class="banner__advantages-text">Работаем <span class="orange">24/7</span>
            <br> с <span class="orange">2015</span> года
          </div>
        </div>
        <div class="banner__advantages-item">
          @include('icon::hookah2', ['class' => 'hookah'])
          <div class="banner__advantages-text">Доставим<br>
            за <span class="orange">30-40</span> мин
          </div>
        </div>
        <div class="banner__advantages-item">
          @include('icon::hookah3', ['class' => 'hookah'])
          <div class="banner__advantages-text">С собой более<br>
            <span class="orange">40 разных вкусов</span></div>
        </div>
        <div class="banner__advantages-item">
          @include('icon::hookah4', ['class' => 'hookah'])
          <div class="banner__advantages-text">Гарантируем качество<br>
            <span class="orange">100%</span></div>
        </div>
      </div>
    </div>
  </div>
</div>
