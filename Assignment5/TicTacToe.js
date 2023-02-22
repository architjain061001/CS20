/****************************************************************
*      TicTacToe.js 
*      This file includes the javascript code for TicTacToe.js
*      Comp 20
****************************************************************/

$(document).ready(function() {
    /****************************************************************
    * This section creates elements of the game using javascript    *
    ****************************************************************/
    
    // Initialize game variables
    var grid = ["", "", "", "", "", "", "", "", ""];
    var winner = null;
    var turn = "X";
    const gameOverMessage = document.querySelector('.gameover');

    // Create grid
    for (var i = 0; i < 9; i++) {
      $(".gamegrid").append("<div class='cell'></div>");
    }

    // Start the game
    newGame();


    /******************************************************************
    * This adds event listeners to the grid and the button "New Game" *
    ******************************************************************/

    // Add click event listener to each cell
    $(".cell").click(function() {
      var index = $(this).index();
      if (grid[index] == "" && winner == null) {
        grid[index] = turn;
        $(this).text(turn);
        checkWin();
        if (winner == null) {
          checkStalemate();
          if (winner == null) {
            switchTurn();
          }
        }
      }
    });
  
    // Add click event listener to new game button
    $(".new-game").click(function() {
      newGame();
    })


    /**********************************************************************
    * This section defines functions for the game                         *                                          
    **********************************************************************/

    // Start a new game
    function newGame() {
      // Select a player to play first randomly
      turn = (Math.random() < 0.5) ? "X" : "O";
      $(".playerturn").text(turn + " plays");

      // Set all the cells to be empty 
      $(".cell").text("");

      // Initialize grid to be empty 
      grid = ["", "", "", "", "", "", "", "", ""];
    
      // Create a variable for the winner and set it to null
      winner = null;

      // Remove the message until game is over
      gameOverMessage.classList.add('hidden');

      // show cells 
      $(".cell").show();
    }

    // Switch turn
    function switchTurn() {
      turn == "X" ? turn = "O" : turn = "X";
      $(".playerturn").text(turn + " plays");
    }
  
    // Check for a win
    function checkWin() {
      // check for rows
      for (var i = 0; i < 9; i=i+3) {
        if (grid[i] == turn && grid[i+1] == turn && grid[i+2] == turn) {
          winner = turn;
        } 
      }
      // check for columns
      for (var i = 0; i < 3; i++) {
        if (grid[i] == turn && grid[i+3] == turn && grid[i+6] == turn) {
          winner = turn;
        } 
      }
      // check for diagnols
      if (((grid[0] == turn && grid[8] == turn) || 
           (grid[2] == turn && grid[6] == turn)) && 
           (grid[4] == turn)) {
          winner = turn;
      } 
      // If there's a winner announce it and end the game
      if (winner != null) {
        $(".playerturn").text(turn + " Wins!");
        gameOver();
      }
    }
  
    // Check for stalemate
    function checkStalemate() {
      var isStalemate = true;
      for (var i = 0; i < 9; i++) {
        if (grid[i] == "") isStalemate = false;
      }
      if (isStalemate) {
        winner = "stalemate";
        $(".playerturn").text("Stalemate!");
        gameOver();
      }
    }

    // Add game over text and reset the board 
    function gameOver() {
      gameOverMessage.classList.remove('hidden');
      $(".cell").hide();
    }
});