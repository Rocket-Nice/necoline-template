// Получаем ссылки на кнопки и поле ввода
const plusButton = document.querySelector('.container-counter__button--plus');
const minusButton = document.querySelector('.container-counter__button--minus');
const inputField = document.querySelector('.field-num__input');

// Обработчик события для кнопки "Плюс"
plusButton.addEventListener('click', function() {
  // Увеличиваем значение в поле ввода на 1
  inputField.value = parseInt(inputField.value) + 1;
});

// Обработчик события для кнопки "Минус"
minusButton.addEventListener('click', function() {
  // Уменьшаем значение в поле ввода на 1, но не меньше 0
  if (parseInt(inputField.value) > 0) {
    inputField.value = parseInt(inputField.value) - 1;
  }
});