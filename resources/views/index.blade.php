@extends('layouts.app')

@section('content')
  @include('partials.breadcrumbs')
  <div class="reviews-page">
    <div class="container">
      <div class="reviews-page__wrap">
        <div class="reviews-block__item-box">
          @php
            global $query_string;
            query_posts( $query_string .'&posts_per_page=10' );
          @endphp
          @while(have_posts()) @php the_post() @endphp
          <div class="reviews-block__item img open-modal"><img src="@php the_post_thumbnail_url() @endphp" alt="Отзыв"></div>
          @endwhile
          @php wp_reset_query() @endphp
          @php
            global $wp_query;
            $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
            $max_pages = $wp_query->max_num_pages;
          @endphp
        </div>
        @include('partials.reviews-aside')
      </div>
      {{--    если страница не последняя показать кнопку "еще"   --}}
      @if( $paged < $max_pages )
        @php
          echo '<div id="loadmore-reviews" class="loadmore"><a href="#" data-max_pages="' . $max_pages . '" data-paged="' . $paged . '">Ещё</a></div>';
        @endphp
      @endif
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
@endsection
