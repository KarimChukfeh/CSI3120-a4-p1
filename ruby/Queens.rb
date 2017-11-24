
@board = Array.new(64, '-')

def printBoard()
  @board.each_with_index do |cell, i|
    if (i%8==0)
      print "\n" end
    print "["+cell+"]"
  end
  print "\n\n"
end

def col(i)
  checker = i
  while checker >= 0
    checker -= 8
  end
  checker += 8
  last = checker + 56
  while checker < (last+8)
    if(@board[checker] == "Q")
      return false
    end
    checker += 8
  end
  return true
end

def row(i)
  checker = i
  while checker%8 != 0
    checker -= 1
  end
  last = checker + 8
  while checker < (last+1)
    if(@board[checker] == "Q")
      return false
    end
    checker += 1
  end
  return true
end

def diag(i)
  checker = i
  while (checker > 8 and (checker)%8 != 0)
    checker -= 9
  end
  while((checker+1)%8 != 0 and checker < 64)
    if(@board[checker] == "Q")
      return false
    end
    checker += 9
  end
  if(@board[checker] == "Q")
    return false
  end

  checker = i
  while (checker > 7 and (checker+1)%8 != 0)
    checker -= 7
  end
  while((checker)%8 != 0 and checker < 64)
    if(@board[checker] == "Q")
      return false
    end
    checker += 7
  end
  if(@board[checker] == "Q")
    return false
  end

  return true
end

def makeBoard()
  @board = Array.new(64, '-')
  queens = 0
  count = 0
  while queens < 8
    i = rand(0..63)
    if(col(i) and row(i) and diag(i))
      @board[i] = "Q"
      queens +=1
    end
    count += 1
    if(count > 3000)
      count = 0
      queens = 0
      @board = Array.new(64, '-')
    end
  end
end

makeBoard()
printBoard()
