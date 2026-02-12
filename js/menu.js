var button = document.querySelector('.main-nav__toggle');
var menu = document.querySelector('.main-nav__list');
var header = document.querySelector('.page-header');

header.classList.remove('page-header--nojs');

menu.classList.add('main-nav__list--hidden');
button.classList.remove('main-nav__toggle--opened')
button.onclick = function() {
  button.classList.toggle('main-nav__toggle--opened')
  menu.classList.toggle('main-nav__list--hidden');
}


var order = document.querySelector('.featured__button'),
  form = document.querySelector('page-modal'),
  overlay = document.querySelector('#overlay');
