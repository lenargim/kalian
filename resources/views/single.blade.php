@extends('layouts.app')

@section('content')
  @include('partials.breadcrumbs')
  <div class="action-detailed">
    <div class="container">
      <div class="action-detailed__wrap">
        <div class="action-detailed__img img"><img src="{{ the_post_thumbnail_url() }}" alt="{{ the_title() }}"></div>
        <div class="action-detailed__text">
          <h1>{{ the_title() }}</h1>
          <div class="action-detailed__date">Дата проведения: @php the_field('date') @endphp</div>
          <div class="action-detailed__text">{{ the_content() }}</div>
        </div>
      </div>
    </div>
  </div>
@endsection
