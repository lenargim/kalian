<?php
/**
 * Template Name: Review thankyou
 */
?>

@extends('layouts.app')

@section('content')
  @include('partials.breadcrumbs')
  <div class="reviews-page">
    <div class="container">
      <div class="reviews-page__wrap">
        <div class="reviews-block__item-box">
          @php
            global $post;
            $reviewsArgs = [
                'numberposts' => 10,
                'post_type'   => 'post'
            ];
            $reviews = get_posts($reviewsArgs);
          @endphp
          @foreach( $reviews as $post )
            @php setup_postdata($post) @endphp
          <div class="reviews-block__item img open-modal"><img src="@php the_post_thumbnail_url() @endphp" alt="Отзыв"></div>
          @endforeach
          @php wp_reset_postdata() @endphp
        </div>
        @include('partials.reviews-aside')
      </div>
      <div class="shishamen">
        <h2 class="title">Наши кальянщики</h2>
        <div class="shishamen__wrap">
          @php
            global $post;
            $shishamenArgs = [
                'numberposts' => 3,
                'post_type'   => 'shishamen'
            ];
            $shishamens = get_posts($shishamenArgs);
          @endphp
          @foreach( $shishamens as $post )
            @php setup_postdata($post) @endphp
            <div class="shishamen__item">
              <div class="shishamen__item-img img">
                <img src="@php the_post_thumbnail_url() @endphp" alt="@php the_title() @endphp">
              </div>
              <div class="shishamen__item-name">@php the_title() @endphp</div>
              <div class="shishamen__item-exp">Стаж: @php the_field('experience') @endphp</div>
              <div class="shishamen__item-desc">@php the_field('desc') @endphp</div>
              {{--              <div class="shishamen__item-stars"></div>--}}
              {{--              <div class="shishamen__item-rating"><span>4,2</span> / 5</div>--}}
              <div class="shishamen__item-more button" data-id="@php the_ID() @endphp">Подробнее</div>
            </div>
          @endforeach
          @php wp_reset_postdata() @endphp
        </div>
      </div>
    </div>
  </div>
  <div class="overlay active">
    <div class="modal modal-review-thx active">
      <div class="modal__close"></div>
      <div class="modal-review-thx__box">
        @include('icon::modal-thx-review', ['class' => 'icon'])
        <div class="modal-review-thx__title">Спасибо за Ваш отзыв</div>
        <div class="modal-review-thx__desc">Ваше мнение очень важно для нас,<br>
          в скором времени<br>
          мы опубликуем отзыв на сайте</div>
      </div>
    </div>
  </div>
  <script>
    jQuery(window).click(function () {
      window.location.href = '/';
    })
  </script>
@endsection
