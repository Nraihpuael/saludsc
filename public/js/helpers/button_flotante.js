/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************************!*\
  !*** ./resources/js/helpers/button_flotante.js ***!
  \*************************************************/
var button = document.getElementById('info');
var infoBox = document.getElementById('info-box');
button.addEventListener('click', function (e) {
  e.preventDefault();
  button.classList.add("hidden");
  infoBox.classList.remove("hidden");
});
infoBox.addEventListener('click', function (e) {
  e.preventDefault();
  button.classList.remove("hidden");
  infoBox.classList.add("hidden");
});
/******/ })()
;