const inputs = document.getElementsByClassName("character-input");

const availablePoints = Number.parseInt(document.getElementById("available-points").textContent);
let currentlyUsedPoints = 0;


// Input controllati con min e max
const inputCounters = [];

for (let i = 0; i < inputs.length; i++) {
    let input = inputs.item(i);
    let decr = input.previousElementSibling; // prima
    let incr = input.nextElementSibling; // dopo

    let options = {
        onIncrement: () => {
            currentlyUsedPoints++;
            document.getElementById("available-points").textContent = availablePoints - currentlyUsedPoints;

            if (availablePoints - currentlyUsedPoints <= 0) {
                // disabilita tutti gli input
                for (let j = 0; j < inputCounters.length; j++) {
                    inputCounters[j]._incrementEl.disabled = true;
                }
            }
        },
        onDecrement: () => {
            currentlyUsedPoints--;
            document.getElementById("available-points").textContent = availablePoints - currentlyUsedPoints;

            if (availablePoints - currentlyUsedPoints > 0) {
                // abilita tutti gli input
                for (let j = 0; j < inputCounters.length; j++) {
                    inputCounters[j]._incrementEl.disabled = false;
                }
            }
        },
        minValue: input.getAttribute('data-input-counter-min'),
        maxValue: input.getAttribute('data-input-counter-max')
    }

    inputCounters.push(new InputCounter(input, incr, decr, options));
}

// Setta il min e max di tutti gli input
const set = (min, max) => {
    if (min > max) {
        return;
    }

    inputCounters.forEach((item) => {
        item._options.minValue = min;
        item._options.maxValue = max;

        if (item.getCurrentValue() < min) {
            item._targetEl.value = min;
        } else if (item.getCurrentValue() > max) {
            item._targetEl.value = max;
        }
    });
}