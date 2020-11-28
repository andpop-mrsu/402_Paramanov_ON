import { shuffle, hiddenNumber } from './Model.js';

export function startGame() {
	let currentNumber = document.getElementById("guess").value;
	let currentCheckNumber = Number(currentNumber);

	if (!Number.isInteger(currentCheckNumber)) {
    	alert('Ошибка! Введите число.');
    	return;
  	}

	if (currentNumber.length != 3) { 
		alert('Ошибка! Число должно быть трехзначным');
		return;
	}

	currentNumber = currentNumber.split('');
	let heat_array = hiddenNumber.filter(value => currentNumber.includes(value));

	let currentStrNumber = currentNumber.toString();
	let hiddenStrNumber = hiddenNumber.toString();
 
	  if (currentStrNumber == hiddenStrNumber) {
	    alert('Вы выиграли!');
	    location.reload();
	} else if ((currentNumber[0] == hiddenNumber[0]) || (currentNumber[1] == hiddenNumber[1]) 
		|| (currentNumber[2] == hiddenNumber[2])) {
		alert('Горячо!');
	  } else if (heat_array != 0) {
	    alert('Тепло!');
	  } else {
	  	alert('Холодно!');
	  }
}