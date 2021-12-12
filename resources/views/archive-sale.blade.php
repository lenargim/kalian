@extends('layouts.app')

@section('content')
  @include('partials.breadcrumbs')
  <div class="actions-page">
    <div class="container">
      <div class="actions-page__wrap">
        @php
          global $query_string;
          query_posts( $query_string .'&posts_per_page=9' );
        @endphp
        @while( have_posts() ) @php the_post() @endphp
        @php $terms = get_the_terms( $post->ID, 'action_type' ) @endphp
        <a href="@php echo get_post_permalink() @endphp" class="actions-page__item">

          <div class="actions-slider__img"><img src="@php the_post_thumbnail_url() @endphp"
                                                alt="@php the_title() @endphp"></div>
          <div class="actions-slider__info">
            <div class="actions-slider__name">@php the_title() @endphp</div>
            <div class="actions-slider__text">@php the_field('short') @endphp
            </div>
          </div>
        </a>
        @endwhile
        @php wp_reset_query() @endphp
        @php
          global $wp_query;
          $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
          $max_pages = $wp_query->max_num_pages;
        @endphp
        {{--    если страница не последняя показать кнопку "еще"   --}}
        @if( $paged < $max_pages )
          @php
            echo '<div id="loadmore" class="loadmore"><a href="#" data-max_pages="' . $max_pages . '" data-paged="' . $paged . '">Ещё</a></div>';
          @endphp
        @endif
      </div>
    </div>
  </div>
@endsection
