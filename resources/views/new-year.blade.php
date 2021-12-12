<?php
/**
 * Template Name: New year
 */
?>

@extends('layouts.app')

@section('content')
  <div class="ny-banner"
       style="background: linear-gradient(99.09deg, #010101 38.5%, rgba(1, 1, 1, 0) 77.88%), url(@php echo get_the_post_thumbnail_url() @endphp) no-repeat right bottom/cover">
    <div class="ny-banner__wrap">
      <div class="container">
        <div class="ny-banner__content">
          <h1 class="ny-banner__title">@php the_field('banner-title') @endphp</h1>
          <div class="ny-banner__text">
            @php the_field('banner-text') @endphp
          </div>
          <div class="ny-banner__absolute">@php the_field('banner-absolute') @endphp</div>
        </div>
        <div class="banner__link ny-banner__button button open-callback">@php the_field('banner-button') @endphp</div>
      </div>
    </div>
    <div class="ny-banner__after" style="background-image: url(@asset('images/new-year/trees.png');)"></div>
  </div>
  <div class="ny-why"
       style="background-image: linear-gradient(97.66deg, rgba(22, 16, 62, 0.68) 20.27%, rgba(73, 19, 19, 0.68) 84.9%), url(@asset('images/new-year/why-bg.jpg'));">
    <div class="container">
      <h2 class="title">Почему нас стоит выбрать на <span class="red">Новый Год?</span></h2>
      <div class="ny-why__wrap">
        <div class="ny-why__item">
          <div class="ny-why__img img"><img src="@asset('images/new-year/why1.png')"></div>
          <div class="ny-why__text">Дарим забивку на гранате</div>
        </div>
        <div class="ny-why__item">
          <div class="ny-why__img img"><img src="@asset('images/new-year/why2.png')"></div>
          <div class="ny-why__text">Дарим сутки аренды + забивку в подарок</div>
        </div>
        <div class="ny-why__item">
          <div class="ny-why__img img"><img src="@asset('images/new-year/why3.png')"></div>
          <div class="ny-why__text">Бронируем в удобное для вас время</div>
        </div>
        <div class="ny-why__item">
          <div class="ny-why__img img"><img src="@asset('images/new-year/why4.png')"></div>
          <div class="ny-why__text">Используем профессиональное оборудование</div>
        </div>
        <div class="ny-why__item">
          <div class="ny-why__img img"><img src="@asset('images/new-year/why5.png')"></div>
          <div class="ny-why__text">Гарантируем качество</div>
        </div>
      </div>
      <div class="ny-why__button button open-callback">@php the_field('why-button') @endphp</div>
    </div>
  </div>
  <div class="ny-actions">
    <div class="container">
      <h2 class="title">Акции</h2>
      <div class="ny-actions__slider">
        @php
          global $post;
          $args = [
            'numberposts' => 3,
            'post_type' => 'sale',
            'action_type' => 'new-year',
          ];
          $actions = get_posts( $args );
        @endphp
        @foreach( $actions as $post )
          @php setup_postdata($post) @endphp
          <a href="@php echo get_post_permalink() @endphp" class="actions-slider__item">
            <div class="actions-label">
              <img src="@asset('images/actions/christmass-tree.svg')">
              <span>Предзаказ на новый год</span>
            </div>
            <div class="actions-slider__img"><img src="@php the_post_thumbnail_url() @endphp"
                                                  alt="@php the_title() @endphp"></div>
            <div class="actions-slider__info">
              <div class="actions-slider__name">@php the_title() @endphp</div>
              <div class="actions-slider__text">@php the_field('short') @endphp
              </div>
            </div>
          </a>
        @endforeach
        @php wp_reset_postdata() @endphp
      </div>
    </div>
  </div>
  <div class="ny-price">
    <div class="container">
      <h2 class="title ny-price__title">Прайс на новогоднюю ночь</h2>
    </div>
    <div class="ny-price__content">
      <span class="ny-price__light ny-price__light_top"
            style="background-image: url(@asset('images/new-year/light.svg'))"></span>
      <div class="container">
        <div class="ny-price__wrap">
          <div class="ny-price__wrap-title">
            <span>Предзаказ*</span>
            <span>Без предзаказа</span>
          </div>
          <div class="ny-price__block">
            @php
              global $post;
              $goodsArgs = [
               'numberposts' => 4,
               'post_type' => 'goods',
               'good_type' => 'ny',
               'order' => 'ASC'
              ];
              $goods = get_posts( $goodsArgs );
            @endphp
            @foreach( $goods as $post )
              @php $terms = get_the_terms( $post->ID, 'good_type' ) @endphp
              <div class="price-block__item price-block__item_slider
              @if( $terms )
              @foreach($terms as $term)
                good-@php echo $term->slug @endphp
              @endforeach
              @endif
                "
                   data-id="@php the_ID() @endphp">
                <div class="price-block__img img"><img src="@php the_post_thumbnail_url() @endphp"
                                                       alt="@php the_title() @endphp"></div>
                <div class="price-block__box">
                  <div class="price-block__name">@php the_title() @endphp</div>
                  <div class="price-block__save">
                    @php the_field('save') @endphp
                  </div>
                  @if(!wp_is_mobile())
                    <div class="price-block__info">
                      <span>Количество:</span>
                      <span class="qty">1 кальян <span class="cup-qty">@php the_field('qty') @endphp</span></span>
                      <span class="present-title">Подарок:</span><span
                        class="present">@php the_field('present') @endphp</span>
                      <span class="time-title">Время:</span>
                      <span class="time">@php the_field('time') @endphp</span>
                      <span>Табак:</span>
                      <span class="tobacco">@php the_field('tabak') @endphp</span>
                      <span>Уголь:</span>
                      <span class="coal">@php the_field('coal') @endphp шт</span>
                      <span class="addition-title">Доп забивка:</span>
                      <span class="addition-desc"><span class="addition">@php the_field('extra') @endphp</span>₽</span>
                      <span>Комплект:</span>
                      <span class="set">@php the_field('set') @endphp</span>
                    </div>
                    <div class="price-block__add">
                      @if( have_rows('info') )
                        @while( have_rows('info') ) @php the_row() @endphp
                        <div class="price-block__add-item">
                          <img src="@php the_sub_field('img'); @endphp" class="price-block__add-img">
                          <div class="price-block__add-desc">@php the_sub_field('desc') @endphp</div>
                        </div>
                        @endwhile
                      @endif
                    </div>
                    <div class="price-block__absolute">
                      <div class="price-block__price">
                  <span class="price-block__price-actual"><span
                      class="calc-price">@php the_field('price') @endphp</span> ₽</span>
                        @if( get_field('old_price') )
                          <span class="price-block__price-old">@php the_field('old_price') @endphp ₽</span>
                        @endif
                      </div>
                      <div class="price-block__order button">Заказать</div>
                    </div>
                  @else
                    <div class="price-block__info">
                      <span>Количество:</span>
                      <span class="qty">1 кальян <span class="cup-qty">@php the_field('qty') @endphp</span></span>
                      <span class="present-title">Подарок:</span><span
                        class="present">@php the_field('present') @endphp</span>
                      <span class="time-title">Время:</span>
                      <span class="time">@php the_field('time') @endphp</span>
                      <span>Табак:</span>
                      <span class="tobacco">@php the_field('tabak') @endphp</span>
                      <div class="price-block__mobile">
                        <div class="price-block__info">
                          <span>Уголь:</span>
                          <span class="coal">@php the_field('qty') @endphp шт</span>
                          <span class="addition-title">Доп забивка:</span>
                          <span class="addition-desc"><span
                              class="addition">@php the_field('extra') @endphp</span>₽</span>
                          <span>Комплект:</span>
                          <span class="set">@php the_field('set') @endphp</span>
                        </div>
                        <div class="price-block__add">
                          @if( have_rows('info') )
                            @while( have_rows('info') ) @php the_row() @endphp
                            <div class="price-block__add-item">
                              <img src="@php the_sub_field('img'); @endphp" class="price-block__add-img">
                              <div class="price-block__add-desc">@php the_sub_field('desc') @endphp</div>
                            </div>
                            @endwhile
                          @endif
                        </div>
                      </div>
                      <div class="price-block__more"></div>
                      <div class="price-block__absolute">
                        <div class="price-block__price">
                    <span class="price-block__price-actual"><span
                        class="calc-price">@php the_field('price') @endphp</span> ₽</span>
                          @if( get_field('old_price') )
                            <span class="price-block__price-old">@php the_field('old_price') @endphp ₽</span>
                          @endif
                        </div>
                        <div class="price-block__order button">Заказать</div>
                      </div>
                    </div>
                  @endif
                </div>
                <form class="price-block__form">
                  <div class="price-block__form-close"></div>
                  <div class="price-block__form-title">Настройка заказа</div>
                  <div class="price-block__form-row">
                    <div class="price-block__qty">
                      <label>Количество кальянов</label>
                      <button class="btn btn-minus change-price-ny">-</button>
                      <input type="number" value="1" min="1" step="1" class="input-shisha-ny input-keyup-ny">
                      <button class="btn btn-plus change-price-ny">+</button>
                    </div>
                    @foreach($terms as $term)
                      @if($term->slug == 'preorder')
                        <div class="price-block__qty">
                          <label>Фруктовая чаша на гранате</label>
                          <button class="btn btn-minus change-price-ny change-fruit">-</button>
                          <input type="number" value="1" min="1" step="1" class="input-fruit-ny input-keyup-ny">
                          <button class="btn btn-plus change-price-ny change-fruit">+</button>
                        </div>
                      @endif
                    @endforeach
                    <div class="price-block__qty">
                      <label>Количество чаш</label>
                      <button class="btn btn-minus change-price-ny">-</button>
                      <input class="input-cups input-keyup-ny" type="number" value="1" min="1" step="1">
                      <button class="btn btn-plus change-price-ny">+</button>
                    </div>
                  </div>
                  @foreach($terms as $term)
                    @if($term->slug == 'no-preorder')
                      <div class="price-block__present-cup">
                        <input type="checkbox" id="present-cup-@php the_ID() @endphp" class="present-checkbox">
                        <label for="present-cup-@php the_ID() @endphp">Хочу 3ю чашу в подарок за отзыв</label>
                      </div>
                    @endif
                  @endforeach
                  <input type="text" class="price-block__form-item input name" placeholder="Имя">
                  <input type="tel" class="tel price-block__form-item input" placeholder="Номер телефона">
                  <div class="price-block__coal-amount">Кол-во углей: <span
                      class="coal">@php the_field('coal') @endphp</span></div>
                  <div class="price-block__total">Итого: <span class="total"></span></div>
                  <input type="checkbox" class="check" checked style="display: none">
                  <input disabled type="submit" value="Оформить заказ" class="price-block__submit button">
                </form>
              </div>
            @endforeach
            @php wp_reset_postdata() @endphp
          </div>
          <div class="ny-price__extra">
            <div class="ny-price__extra-left">
              @php the_field('preorder-text') @endphp
            </div>
            <div class="ny-price__extra-right">
              @php the_field('no-preorder-text') @endphp
            </div>
          </div>
        </div>
      </div>
      <span class="ny-price__light ny-price__light_bottom"
            style="background-image: url(@asset('images/new-year/light.svg'))"></span>
    </div>
  </div>
  <div class="ny-how">
    <img src="@asset('images/new-year/how-bg.png')" class="ny-how__img">
    <div class="ny-how__content">
      <h2 class="title ny-how__title">Как происходит</h2>
      <div class="ny-how__desc">Аренда и доставка кальяна на Новый Год</div>
      <div class="ny-how__table">
        <div class="container">
          <div class="ny-how__wrap">
            <div class="ny-how__block">
              <div class="ny-how__block-title">Для тех кто отдыхает дома</div>
              <div class="ny-how__block-wrap">
                <div class="ny-how__item">
                  @include('icon::ny-hookah1', ['class' => 'ny-how__item-icon'])
                  <div class="ny-how__item-step">Шаг 1</div>
                  <div class="ny-how__item-text">Вы оформляете предзаказ на удобное для вас время.</div>
                </div>
                <div class="ny-how__item">
                  @include('icon::ny-hookah2', ['class' => 'ny-how__item-icon'])
                  <div class="ny-how__item-step">Шаг 2</div>
                  <div class="ny-how__item-text">Вы можете сказать свои предпочтения и мы привезем все готовое или
                    приготовим при вас.
                  </div>
                </div>
                <div class="ny-how__item">
                  @include('icon::ny-hookah3', ['class' => 'ny-how__item-icon'])
                  <div class="ny-how__item-step">Шаг 3</div>
                  <div class="ny-how__item-text">Мы сами приедем и заберем кальян 02.01.2022 до 15:00.*
                    *сроки указаны с учетом
                    тарифа “Предзаказ”
                  </div>
                </div>
              </div>
            </div>
            <div class="ny-how__block">
              <div class="ny-how__block-title">Для тех кто заберет кальян загород</div>
              <div class="ny-how__block-wrap">
                <div class="ny-how__item">
                  @include('icon::ny-hookah1', ['class' => 'ny-how__item-icon'])
                  <div class="ny-how__item-step">Шаг 1</div>
                  <div class="ny-how__item-text">Оговариваем с вами условия и сроки аренды. Оформляем доставку или
                    самовывоз.
                  </div>
                </div>
                <div class="ny-how__item">
                  @include('icon::ny-hookah2', ['class' => 'ny-how__item-icon'])
                  <div class="ny-how__item-step">Шаг 2</div>
                  <div class="ny-how__item-text">Если самовывоз - отдаем все готовое,
                    вам просто собрать. Если доставка - сделаем все сами.
                  </div>
                </div>
                <div class="ny-how__item">
                  @include('icon::ny-hookah3', ['class' => 'ny-how__item-icon'])
                  <div class="ny-how__item-step">Шаг 3</div>
                  <div class="ny-how__item-text">Забираем кальян в оговоренное время, в оговоренном месте.</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="ny-how__button button open-callback">Забронировать кальян</div>
    </div>
  </div>
  <div class="ny-photos">
    <div class="container">
      <h2 class="title ny-photos__title">Фото праздников</h2>
      @php
        $images = get_field('photos');
      @endphp
      @if( $images )
        <div class="ny-photos__slider">
          @foreach($images as $image)
            <div class="ny-photos__item">
              <img src="<?php echo esc_url($image['url']); ?>"/>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </div>
  </div>
  <div class="faq-block">
    <div class="container">
      <h2 class="title">FAQ</h2>
      @include('partials.faq-wrap-ny')
    </div>
  </div>

@endsection
