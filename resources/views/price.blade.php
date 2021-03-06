<?php
/**
 * Template Name: price
 */
?>

@extends('layouts.app')

@section('content')
  @include('partials.breadcrumbs')
  <div class="container">
    @if(!wp_is_mobile())
      {{ the_content() }}
    @endif
    <div class="price-block__wrap price__wrap">
      @php
        global $post;
        $goodsArgs = [
         'numberposts' => -1,
         'post_type' => 'goods',
         'good_type' => 'main, rent'
        ];
        $goods = get_posts( $goodsArgs );
      @endphp
      @foreach( $goods as $post )
        @php $terms = get_the_terms( $post->ID, 'good_type' ) @endphp
        @if( $terms )
          @php $term = array_shift( $terms ) @endphp
        @endif
        <div class="price-block__item good-@php echo $term->slug @endphp" data-id="@php the_ID() @endphp">
          <div class="price-block__img img"><img src="@php the_post_thumbnail_url() @endphp"
                                                 alt="@php the_title() @endphp"></div>
          <div class="price-block__box">
            <div class="price-block__name">@php the_title() @endphp</div>
            <div class="price-block__sale">
              @php the_terms( $post, 'sale_type', '', '', '' ) @endphp
            </div>
            @if(!wp_is_mobile())
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
                  @if( get_field('old_price') && get_field('is_sale') == true )
                    <span class="price-block__price-old">@php the_field('old_price') @endphp ₽</span>
                  @endif
                </div>
                <div class="price-block__order button">Заказать</div>
              </div>
            @else
              <div class="price-block__info">
                <span>Количество:</span>
                <span class="qty">1 кальян <span class="cup-qty">@php the_field('qty') @endphp</span></span>
                <span>Время:</span>
                <span class="time">@php the_field('time') @endphp</span>
                <span>Табак:</span>
                <span class="tobacco">@php the_field('tabak') @endphp</span>
                <div class="price-block__mobile">
                  <div class="price-block__info">
                    <span>Уголь:</span>
                    <span class="coal">@php the_field('qty') @endphp шт</span>
                    <span class="addition-title">Доп забивка:</span>
                    <span class="addition-desc"><span class="addition">@php the_field('extra') @endphp</span>₽</span>
                    <span>Комплект:</span>
                    <span class="set">@php the_field('set') @endphp</span>
                  </div>
                </div>
                <div class="price-block__more"></div>
                <div class="price-block__absolute">
                  <div class="price-block__price">
                    <span class="price-block__price-actual"><span
                        class="calc-price">@php the_field('price') @endphp</span> ₽</span>
                    @if( get_field('old_price') && get_field('is_sale') == true )
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
    <h2 class="title">Кальяны на фруктовой чаше</h2>
    <div class="price-block__wrap price__wrap">
      @php
        global $post;
        $goodsArgs = [
         'numberposts' => -1,
         'post_type' => 'goods',
         'good_type' => 'fruit'
        ];
        $goods = get_posts( $goodsArgs );
      @endphp
      @foreach( $goods as $post )
        @php $terms = get_the_terms( $post->ID, 'good_type' ) @endphp
        @if( $terms )
          @php $term = array_shift( $terms ) @endphp
        @endif
        <div class="price-block__item good-@php echo $term->slug @endphp" data-id="@php the_ID() @endphp">
          <div class="price-block__img img"><img src="@php the_post_thumbnail_url() @endphp"
                                                 alt="@php the_title() @endphp"></div>
          <div class="price-block__box">
            <div class="price-block__name">@php the_title() @endphp</div>
            <div class="price-block__sale">
              @php the_terms( $post, 'sale_type', '', '', '' ) @endphp
            </div>
            @if(!wp_is_mobile())
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
                  @if( get_field('old_price') && get_field('is_sale') == true )
                    <span class="price-block__price-old">@php the_field('old_price') @endphp ₽</span>
                  @endif
                </div>
                <div class="price-block__order button">Заказать</div>
              </div>
            @else
              <div class="price-block__info">
                <span>Количество:</span>
                <span class="qty">1 кальян <span class="cup-qty">@php the_field('qty') @endphp</span></span>
                <span>Время:</span>
                <span class="time">@php the_field('time') @endphp</span>
                <span>Табак:</span>
                <span class="tobacco">@php the_field('tabak') @endphp</span>
                <div class="price-block__mobile">
                  <div class="price-block__info">
                    <span>Уголь:</span>
                    <span class="coal">@php the_field('qty') @endphp шт</span>
                    <span class="addition-title">Доп забивка:</span>
                    <span class="addition-desc"><span class="addition">@php the_field('extra') @endphp</span>₽</span>
                    <span>Комплект:</span>
                    <span class="set">@php the_field('set') @endphp</span>
                  </div>
                </div>
                <div class="price-block__more"></div>
                <div class="price-block__absolute">
                  <div class="price-block__price">
                    <span class="price-block__price-actual"><span
                        class="calc-price">@php the_field('price') @endphp</span> ₽</span>
                    @if( get_field('old_price') && get_field('is_sale') == true )
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
                <button class="btn btn-minus change-price change-shisha">-</button>
                <input type="number" value="1" min="1" step="1" class="input-shisha input-keyup">
                <button class="btn btn-plus change-price change-shisha">+</button>
              </div>
            </div>
            <div class="price-block__delivery">
              <input id="delivery@php the_ID() @endphp" type="checkbox" class="change-price input-delivery">
              <label for="delivery@php the_ID() @endphp"></label>
            </div>
            <input type="text" class="price-block__form-item input name" placeholder="Имя">
            <input type="tel" class="tel price-block__form-item input" placeholder="Номер телефона">
            <div class="price-block__coal-amount">Кол-во углей: <span class="coal"></span></div>
            <div class="price-block__total">Итого: <span class="total"></span></div>
            <input type="checkbox" class="check" checked style="display: none">
            <input disabled type="submit" value="Оформить заказ" class="price-block__submit button">
          </form>
        </div>
      @endforeach
      @php wp_reset_postdata() @endphp
    </div>
  </div>
  <div class="map">
    <div class="container">
      <h2 class="title">Карта доставки</h2>
      <div class="map__desc">Уточните стоимость доставки, возможно у администратора найдется бонус для вас.
      </div>
      @include('partials.map')
    </div>
  </div>
@endsection
