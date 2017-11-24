class TicTacToe
  # initialize the class with some variables that will be needed
  def initialize
    @board = Array[0,1,2,3,4,5,6,7,8]
    @availableMoves = Array[0,1,2,3,4,5,6,7,8]
    @player = "X"
    @computer = "O"
    @currentPlayer = @computer
  end

  # alternates betweens computer and players turn
  def changePlayer
    if @currentPlayer == @player
      @currentPlayer = @computer
      computersMove
    else
      @currentPlayer = @player
      playerTurn
    end
  end

  # prints the board
  def printBoard
    print @board[0..2]
    puts ""
    print @board[3..5]
    puts ""
    print @board[6..8]
    puts ""
  end

  # starts the player's turn
  def playerTurn
    puts "Your turn"
    printBoard
    puts "Enter a number between 0 and 8"
    move = gets.chomp.to_i
    # checks to see if the move is available or not
    if (@availableMoves.include? move)
      makeMove(@player, move)
      @availableMoves = @availableMoves - [move]
      printBoard
    else
      puts "Spot not available"
      playerTurn
    end
  end

  # makes changes to board in terms of moves
  def makeMove(player, move)
    @board[move] = player
  end

  # checks to see if the game finished if there are no more moves or someone wins
  def gameFinished
    if @availableMoves.empty?
      puts "No winner."
      true
    elsif isWinner(@player)
      puts "You won!"
      true
    elsif isWinner(@computer)
      puts "You lost!"
      true
    else
      false
    end
  end

  # starts the computer's move
  def computersMove
    move = rand(0..8)
    # checks to see if the move is available or not
    if (@availableMoves.include? move)
      puts "Computer's turn"
      makeMove(@computer, move)
      @availableMoves = @availableMoves - [move]
    else
      computersMove
    end
  end

  #Checks to see if the player is a winner or not
  def isWinner(player)
    if @board[0] == player and @board[1] == player and @board[2] == player
      true
    elsif @board[3] == player and @board[4] == player and @board[5] == player
      true
    elsif @board[6] == player and @board[7] == player and @board[8] == player
      true
    elsif @board[0] == player and @board[3] == player and @board[6] == player
      true
    elsif @board[1] == player and @board[4] == player and @board[7] == player
      true
    elsif @board[2] == player and @board[5] == player and @board[8] == player
      true
    elsif @board[0] == player and @board[4] == player and @board[8] == player
      true
    elsif @board[2] == player and @board[4] == player and @board[6] == player
      true
    else
      false
    end
  end


end

#starts the game
board = TicTacToe.new
#keeps alternating between players until game ends
while !board.gameFinished
  board.changePlayer
end
