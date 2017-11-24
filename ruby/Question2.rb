def inCircle(x,y)
   if (((x-1).abs ** 2) + ((y-1).abs ** 2)) < (1 ** 2)
     true
   else
     false
   end
end

total = 100000
incircle = 0

for i in 0..total
  x = rand(0..400)/200
  y = rand(0..400)/200
  if inCircle(x,y)
    incircle += 1
  end
end

puts 4*(incircle/total)
