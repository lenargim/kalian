<?php
/**
 * Template Name: Landing
 */
?>

@extends('layouts.app')

@section('content')
  @include('partials.bannner')
  <div class="actions-slider">
    <div class="container">
      <h2 class="title">Акции</h2>
      <div class="actions-slider__slider">
        @php
          global $post;
          $args = [
            'numberposts' => 9,
            'post_type' => 'sale',
          ];
          $actions = get_posts( $args );
        @endphp
        @foreach( $actions as $post )
          @php setup_postdata($post) @endphp
          <a href="@php echo get_post_permalink() @endphp" class="actions-slider__item">
            <div class="actions-slider__img"><img src="@php the_post_thumbnail_url() @endphp" alt="@php the_title() @endphp"></div>
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

  @include('partials.covid-block')
  <div class="price-block">
    <div class="container">
      <h2 class="title">Прайс на наши кальяны</h2>
      <div class="price-block__wrap price-block__wrap_slider">
        @php
          global $post;
          $goodsArgs = [
           'numberposts' => -1,
           'post_type' => 'goods',
          ];
          $goods = get_posts( $goodsArgs );
        @endphp
        @foreach( $goods as $post )
          @php setup_postdata($post) @endphp
          @php $terms = get_the_terms( $post->ID, 'good_type' ) @endphp
          @if( $terms )
            @php $term = array_shift( $terms ) @endphp
          @endif
          <div class="price-block__item price-block__item_slider good-@php echo $term->slug @endphp"
               data-id="@php the_ID() @endphp">
            <div class="price-block__img img"><img src="@php the_post_thumbnail_url() @endphp"
                                                   alt="@php the_title() @endphp"></div>
            <div class="price-block__box">
              <div class="price-block__name">@php the_title() @endphp</div>
              <div class="price-block__sale">
                @php the_terms( $post, 'sale_type', '', '', '' ) @endphp
              </div>
              <div class="price-block__info">
                <span>Количество:</span>
                <span class="qty">1 кальян <span class="cup-qty">@php the_field('qty') @endphp</span></span>
                <span>Уголь:</span>
                <span class="coal">@php the_field('qty') @endphp шт</span>
                <span>Время:</span>
                <span class="time">@php the_field('time') @endphp</span>
                <span>Табак:</span>
                <span class="tobacco">@php the_field('tabak') @endphp</span>
                <span class="addition-title">Доп забивка:</span>
                <span class="addition-desc"><span class="addition">@php the_field('extra') @endphp</span>₽</span>
              </div>
              <div class="price-block__set">
                <span>Комплект:</span>
                <span class="set">@php the_field('set') @endphp</span>
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
            </div>
            <form class="price-block__form">
              <div class="price-block__form-close"></div>
              <div class="price-block__form-title">Настройка заказа</div>
              <div class="price-block__form-row">
                <div class="price-block__qty">
                  <label>Количество кальянов</label>
                  <button class="btn btn-minus change-price change-shisha">-</button>
                  <input type="number" value="1" min="1" step="1" class="input-shisha input-keyup">
                  <button class="btn btn-plus change-price change-shisha">+</button>
                </div>
                @if( $term->slug == 'main')
                  <div class="price-block__qty">
                    <label>Количество чаш</label>
                    <button class="btn btn-minus change-price change-coal change-cups">-</button>
                    <input class="input-cups input-keyup" type="number" value="1" min="1" step="1">
                    <button class="btn btn-plus change-price change-coal change-cups">+</button>
                  </div>
                @endif
              </div>
              <div class="price-block__delivery">
                <input id="delivery@php the_ID() @endphp" type="checkbox" class="change-price input-delivery">
                <label for="delivery@php the_ID() @endphp"></label>
              </div>
              <input type="text" class="price-block__form-item input name" placeholder="Имя">
              <input type="tel" class="tel price-block__form-item input" placeholder="Номер телефона">
              @if( $term->slug == 'main')
                <div class="price-block__coal-amount">Кол-во углей: <span class="coal"></span></div>
              @endif
              <div class="price-block__total">Итого: <span class="total"></span></div>
              <input type="checkbox" class="check" checked style="display: none">
              <input disabled type="submit" value="Оформить заказ" class="price-block__submit button">
            </form>
          </div>
        @endforeach
        @php wp_reset_postdata() @endphp
      </div>
    </div>
  </div>

  @include('partials.brands')
  <div class="steps">
    <img src="@asset('images/steps-bg.jpg')" alt="steps" class="steps__img">
    <div class="container">
      <h2 class="title steps__title">Как все происходит</h2>
      <div class="steps__desc">Аренда и доставка кальяна на дом в Самаре для вас действуют скидки и акции</div>
    </div>
    @include('partials.steps-box-landing')
  </div>
  </div>

  @include('partials.reviews')
  @include('partials.faq')
@endsection
