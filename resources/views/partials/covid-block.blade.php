<div class="covid-block">
  <img src="@asset('images/covid-bg.webp')" alt="covid" class="covid-block__img">
  <div class="container">
    <h2 class="covid-block__title">COVID-19 МЕРЫ ПРЕДОСТОРОЖНОСТИ</h2>
    <div class="covid-block__text">@php the_field('covid'); @endphp</div>
    <div class="covid-block__iframe">
      <iframe width="100%" height="100%" id="covid" src="https://www.youtube.com/embed/yuIeESIKu9c"
              title="Anti-Covid-19"
              frameborder="0"
              allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen></iframe>
    </div>
    <div class="covid-block__link">Подробнее</div>
  </div>
</div>
