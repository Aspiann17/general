def transpose(A:list[list]) -> list:
  tmp = []
  for l in range(len(A[0])):
    tmp2 = []
    for i in range(len(A)):
      for j in range(len(A[i])):
        tmp2.append(A[i][j+l])
        break
    tmp.append(tmp2)
    tmp2 = []
  
  return tmp

A = [
  [1 ,2, 3],
  [5, 6, 7]
]
print(transpose(A))