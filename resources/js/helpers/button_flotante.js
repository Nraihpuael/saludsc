const button = document.getElementById('info');
const infoBox = document.getElementById('info-box');

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
