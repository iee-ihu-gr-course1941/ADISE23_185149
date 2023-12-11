# ADISE23_185149

Battleship board game

## How to play:

 - Set up your ships vertically or horizontally.
 - One shot at a turn guessing where the enemy ships are.
 - Once you sink all of the enemy ships, you win.
 - Once all of your ships are sunk, you lose.
 - Try to win.
 - Have fun. (**Mandatory**)




## Current Link (Subject to change): 

[Let's Play](https://users.iee.ihu.gr/~it185149/adise/DEV/Battleship/index.php)

## API: 

### Implemented:

- ```/boards/``` GET 	- Returns your boards
- ```/boards/``` POST 	- Initializes boards and returns player boards
- ```/board/{board_name}``` GET 	- Returns your selected board
- ```/board/my_ships/{ship_name}``` GET 	- Returns position of ship if set
- ```/board/my_ships/{ship_name}/{x1}/{y1}/{x2}/{y2}``` POST 	- sets ship on position x1y1 to x2y2 and returns boards
- ```/board/enemy/{x}/{y}``` GET 	- Returns current cell status
- ```/board/enemy/{x}/{y}``` POST 	- Attacks current cell, returns whole board
- ```/status/``` GET 	- Returns game status


### Optional features (Working on them):

- ```/players/{p}```	GET		- Returns given player’s info
- ```/players/``` GET		- Returns all players data


### Variable values:

board_name values:
- ```my_ships```
- ```enemy```

ship_name values:
- ```battleship``` (3 spaces)
- ```boat``` (2 spaces)
- ```carrier``` (4 spaces)
- ```submarine``` (3 spaces)

y values:
- ```1```
- ```2```
- ```3```
- ```4```
- ```5```
- ```6```

x values:
- ```a```
- ```b```
- ```c```
- ```d```
- ```e```
- ```f```
