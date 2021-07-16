export default {
  init() {
    // JavaScript to be fired on all pages
  },
  finalize() {
    $('.tel').mask('+7(Z00) 000-00-00', { translation: { 'Z': { pattern: /[0-79]/ } } })
  },
};

$('.price-block__sale a').on('click', function(e){
 e.preventDefault();
})

$('.price-block__form-close').on('click', function(){
  $(this).parent('.price-block__form').removeClass('active')
})

$('.price-block__order').on('click', function(){
  $(this).parents('.price-block__box').siblings('.price-block__form').addClass('active')
})

$('.cup-qty').each(function() {
  let qty = +parseInt($(this).text(), 10);
  let parent = $(this).parents('.price-block__item');
  parent.find('.input-cups').val(qty);
  parent.find('.input-cups').attr('coef', qty)
  changeCoalQty(parent, qty);
})

/*  Калькулятор */

$('.change-price').on('input keyup change', function(){
  let parent = $(this).parents('.price-block__item');
  changeTotal(parent)
})

$('.input-keyup').on('input keyup', function(){
  let qty = $(this).val()
  let parent = $(this).parents('.price-block__item');
  if (qty < 1) {
    $(this).val(1)
  }
  if ( $(this).hasClass('input-shisha')  ) {
    changeCupsQty(parent, qty)
  } else if ( $(this).hasClass('input-cups') ) {
    changeCoalQty(parent, qty)
  }
})

$('.change-shisha').on('click', function(e){
  e.preventDefault();
  let input = $(this).siblings('.input-shisha');
  let qty = input.val()
  let parent = $(this).parents('.price-block__item');
  if ( $(this).hasClass('btn-plus') ) {
      input.val( ++qty )
    } else if (qty > 1) {
      input.val( --qty )
    }
    changeCupsQty(parent, qty);
})

$('.change-cups').on('click', function(e){
  e.preventDefault();
  let input = $(this).siblings('.input-cups');
  let qty = input.val();
  let coef = input.attr('coef');
  let parent = $(this).parents('.price-block__item');
  let shishaQty = parent.find('.input-shisha').val()
  if ( $(this).hasClass('btn-plus') ) {
      input.val( ++qty )
    } else if (qty > shishaQty * coef) {
      input.val( --qty )
    }
    changeCoalQty(parent, qty)
})

function changeCupsQty(parent, qty) {
  let coef = parent.find('.input-cups').attr('coef')
  let input = parent.find('.input-cups');
  if (  (qty * coef) > input.val() ) {
    input.val(qty*coef)
  }
  changeCoalQty(parent, input.val())
}

function changeCoalQty(parent, qty) {
  qty = +qty;
  switch (qty) {
    case 1:
      parent.find('.coal').text('4 шт');
      break;
    case 2:
        parent.find('.coal').text('12 шт');
        break;
    default:
        parent.find('.coal').text(`${qty*4 + 4 + (qty-2)*2} шт`);
    }
    changeTotal(parent)
}

function changeTotal(parent) {
  let shisha = parent.find('.input-shisha').val();
  let cups = parent.find('.input-cups').val();
  let delivery = parent.find('.input-delivery').prop('checked');
  let deliverySum = delivery == true ? 500 : 0;
  let price = parent.find('.calc-price').html();
  let extraCupsPrice = parent.find('.addition').text();
  let coef = parent.find('.input-cups').attr('coef');
  let shishaSum;
  let cupsSum;
  let extraCupsQty = cups - coef * shisha;
  let total = parent.find('.price-block__total');
  if (shisha == 1) {
    shishaSum = +price;
    cupsSum = extraCupsQty * extraCupsPrice;
  } else if (shisha == 2) {
    shishaSum = +price*(1 + 0.8);
    let half = Math.ceil(extraCupsQty/2);
    cupsSum = half * extraCupsPrice + (extraCupsQty - half) * 0.8 * extraCupsPrice
  } else if ( shisha == 3 ) {
    shishaSum = +price*(1 + 0.8 + 0.7);
    let half = Math.ceil(extraCupsQty/2);
    let quarter = Math.ceil( (extraCupsQty - half)/2 );
    cupsSum = Math.round( extraCupsPrice * (half + 0.8*quarter + 0.7*(extraCupsQty-half-quarter)) )
  }
  let totalSum = shishaSum+cupsSum+deliverySum;
  //total.html(shishaSum+cupsSum+deliverySum + '₽')
  total.html(`Итого: <span class="total">${totalSum}₽</span>`)
 if (!totalSum || totalSum == 'NaN₽' ) {
    total.html('<span class="total">Уточните заполнив форму</span>')
  }
}
/*  Конец Калькулятор */

$('.open-modal').on('click', function() {
  let content = $(this).html();
  $('.modal-img__box').html(content);
  $('.modal-img').addClass('active');
  $('.overlay').addClass('active');
})

$('.modal__close').on('click', function() {
  $('.overlay').removeClass('active')
  $('.modal').removeClass('active')
  $('.modal-img__box').html('');
})

$('.price-block__form-item').on('input', function(){
  if ( $(this).hasClass('name') )  {
    $(this).val().length > 1 ? $(this).addClass('filled') : $(this).removeClass('filled');
  } else if ( $(this).hasClass('tel') ) {
    $(this).val().length == 17 ? $(this).addClass('filled') : $(this).removeClass('filled')
  }
  let form = $(this).parents('.price-block__form');
  checkForm(form);
})

function checkForm(form) {
  if ( form.find('.tel').hasClass('filled') &&  form.find('.name').hasClass('filled')  ) {
    form.find('.price-block__submit').prop('disabled', false);
  } else {
    form.find('.price-block__submit').prop('disabled', true);
  }
}

$('.price-block__form').on('submit', function(e){
  e.preventDefault();
  $('.modal-order').addClass('active');
  $('.overlay').addClass('active');
  let form = $('.modal-order .wpcf7-form')
  let item = $(this).parents('.price-block__item');
  let id = item.data('id')
  $('.modal-order__back').attr('data-id', id);
  form.find('.modal-order__form-input, .modal-order__form-title').attr('readonly', false);
  form.find('.modal-order__form-title').val( item.find('.price-block__name').text() )
  form.find('.shisha').val( item.find('.input-shisha').val() + ' шт' )
  form.find('.cups').val( item.find('.input-cups').val() + ' шт' )
  form.find('.coal').val( item.find('.price-block__coal-amount .coal').text() )
  form.find('.time').val( item.find('.time').text() )
  form.find('.tabak').val( item.find('.tobacco').text() )
  let delivery = item.find('.input-delivery').prop('checked');
  delivery == true
  ? form.find('.delivery').removeClass('red').val('Есть (+ 500 ₽)') : form.find('.delivery').addClass('red').val('Нет')
  form.find('.name').val( item.find('.name').val() )
  form.find('.tel').val( item.find('.tel').val() )
  form.find('.modal-order__form-price').val( item.find('.total').text() )
  form.find('.modal-order__form-input, .modal-order__form-title').attr('readonly', true);
})

$('.modal-order__back').on('click', function(){
  let id = $(this).attr('data-id');
  $('.overlay').removeClass('active')
  $('.modal').removeClass('active')
  $(`.price-block__item[data-id="${id}"]`).find('.name').focus()
})

document.addEventListener( 'wpcf7mailsent', function( ) {
  document.location.href = '/spasibo';
}, false );
