import { currentId, hiddenNumber, initializeDatabase, getGames, createReplay, writeGameInfo, updateGameStatus, writeTurnInfo } from './Model.js';
import { hideElement, unhideElement } from './View.js';

let gameField = document.getElementById("game");
let gameInfo = document.getElementById("info");
let headerBlock = document.getElementById("header");

let startButton = document.getElementById("startGame");
let gamesButton = document.getElementById("showGames");
let replayButton = document.getElementById("showReplay");
let gameButton = document.getElementById("gameButton");

let turnNumber = 0;

window.onload = initializeDatabase;

let playGame = () => {
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
	
	turnNumber++;

	  if (currentStrNumber == hiddenStrNumber) {
		alert('Вы выиграли!');
		writeTurnInfo(currentId, 'Игра выиграна', turnNumber, currentNumber.join(''));
		updateGameStatus('Игра выиграна');
		turnNumber = 1;
	    hideElement(gameField);
	} else if ((currentNumber[0] == hiddenNumber[0]) || (currentNumber[1] == hiddenNumber[1]) 
		|| (currentNumber[2] == hiddenNumber[2])) {
		alert('Горячо!');
		writeTurnInfo(currentId, 'Горячо!', turnNumber, currentNumber.join(''));
	  } else if (heat_array != 0) {
		alert('Тепло!');
		writeTurnInfo(currentId, 'Тепло!', turnNumber, currentNumber.join(''));
	  } else {
		alert('Холодно!');
		writeTurnInfo(currentId, 'Холодно!', turnNumber, currentNumber.join(''));
	  }
}

let startGame = () => {
	let username = prompt("Введите имя игрока");
	hideElement(gameInfo);
	unhideElement(gameField);
	hideElement(headerBlock);
	writeGameInfo(username);
}

let getReplay = () => {
	let gameId = +prompt("Введите id игры");
	createReplay(gameId);
}

startButton.onclick = startGame;
gamesButton.onclick = getGames;
gameButton.onclick = playGame;
replayButton.onclick = getReplay;