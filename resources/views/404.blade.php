@extends('layouts.app')

@section('content')
  <div class="not-found">
    <div class="container">
      <div class="not-found__wrap">
        @include('icon::404', ['class' => 'icon'])
        <div class="not-found__text">
          <div class="not-found__title">Упс... 404 ошибка</div>
          <div class="not-found__desc">Страница не найдена, но вы можете поискать на других страницах:</div>
          <div class="not-found__menu-wrap">
            @if (has_nav_menu('footer'))
              {!! wp_nav_menu(['menu' => 'footer', 'menu_class' => 'not-found__menu']) !!}
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
