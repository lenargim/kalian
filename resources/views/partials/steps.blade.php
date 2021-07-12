<div class="steps">
  <div class="container">
    <h2 class="title steps__title">Как все происходит</h2>
    <div class="steps__desc">Закажите паровой коктейль домой с доставкой, для вас действуют скидки и акции</div>
  </div>
  <div class="steps__box">
    <div class="container">
      <div class="steps__wrap">
        <div class="steps__item">
          @include('icon::step1', ['class' => 'steps__svg'])
          <div class="steps__number">Шаг 1</div>
          <div class="steps__text">К Вам приезжает кальянщик и проходит к Вам на кухню</div>
        </div>
        <div class="steps__item">
          @include('icon::step2', ['class' => 'steps__svg'])
          <div class="steps__number">Шаг 2</div>
          <div class="steps__text">Вы определяетесь
            <span style="white-space: nowrap">со вкусами,</span>
            <span style="white-space: nowrap">а Кальянщик готовит</span> необходимое количество забивок</div>
        </div>
        <div class="steps__item">
          @include('icon::step3', ['class' => 'steps__svg'])
          <div class="steps__number">Шаг 3</div>
          <div class="steps__text">1-ую забивку
            <span style="white-space: nowrap">он раскуривает</span></div>
        </div>
        <div class="steps__item">
          @include('icon::step4', ['class' => 'steps__svg'])
          <div class="steps__number">Шаг 4</div>
          <div class="steps__text">Последующие забивки Вы самостоятельно меняете, разогревая угольки на плитке, которую мы тоже Вам оставляем</div>
        </div>
        <div class="steps__item">
          @include('icon::step5', ['class' => 'steps__svg'])
          <div class="steps__number">Шаг 5</div>
          <div class="steps__text">Согласно оговоренному времени, мы приезжаем и забираем кальян</div>
        </div>
        <div class="steps__item">
          @include('icon::step6', ['class' => 'steps__svg'])
          <div class="steps__number">Шаг 6</div>
          <div class="steps__text">Мыть ничего не нужно, мы все сделаем самостоятельно.</div>
        </div>
      </div>
    </div>
  </div>
  <div class="steps__link">
    <a href="/price" class="button">Смотреть каталог</a>
  </div>
  </div>
</div>
