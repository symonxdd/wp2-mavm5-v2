let date = new Date();
let dd = date.getDate();
let mm = date.getMonth() + 1;
let yyyy = date.getFullYear();

if(dd < 10) {
    dd = '0' + dd;
}
if(mm < 10) {
    mm = '0' + mm;
}

date = yyyy + '-' + mm + '-' + dd;

let min = yyyy + '-' + mm + '-' + dd;
let max = (yyyy + 1) + '-' + mm + '-' + dd;

const datum = document.querySelector("input[type='date']");

datum.setAttribute("min", min);
datum.setAttribute("max", max);




const hidden = document.querySelectorAll('input[name=corona]');
const checkbox = document.querySelectorAll('.corona');
const coronaText = document.querySelectorAll('#switch-text');


window.addEventListener('load', (event) => {
    for (let index = 0; index < hidden.length; index++) {
        const element = hidden[index];
        if(element.value == 1) {
            console.log(checkbox[index]);
            checkbox[index].setAttribute('checked', 'checked');
            coronaText[index].innerText = "Ja";
        }
    }
});


for (let index = 0; index < checkbox.length; index++) {
    const element = checkbox[index];
    element.addEventListener('click', function() {
        if(coronaText[index].innerText == "Nee") {
            coronaText[index].innerText = "Ja";
            hidden[index].setAttribute('value', 1);
        }
        else {
            coronaText[index].innerText = "Nee";
            hidden[index].setAttribute('value', 0);
        }
    });
}



