class Matrix:
    def __init__(self, matrix:list[list]):
        self.__matrix = matrix

    @property
    def ordo(self) -> list:
       return [len(self.__matrix), len(self.__matrix[0])]

    @property
    def transpose(self) -> list:
        tmp = []
        for k in range(len(self.__matrix[0])):
            tmp2 = []
            for i in range(len(self.__matrix)):

                for j in range(len(self.__matrix[i])):
                    tmp2.append(self.__matrix[i][j + k])
                    break

            tmp.append(tmp2)
            tmp2 = []

        return tmp

    @classmethod
    def add(cls):
        ...

if __name__ == "__main__":
    A = Matrix([
        [1 ,2, 3],
        [5, 6, 7]
    ])

    print(A.transpose)