const corona = document.querySelector('input[name=corona]');
const coronaSwitch = document.getElementById('corona');
const coronaText = document.getElementById('switch-text');

window.addEventListener('load', (event) => {
    if(corona.value == 1) {
        coronaSwitch.setAttribute('checked', 'checked');
        coronaText.innerText = "Ja";
    }
});

coronaSwitch.addEventListener('click', function() {
    if(coronaText.innerText == "Nee") {
        coronaText.innerText = "Ja";
        corona.setAttribute('value', 1);
    }
    else {
        coronaText.innerText = "Nee";
        corona.setAttribute('value', 0);
    }
})
