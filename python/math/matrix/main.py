from random import randint

class Matrix:
    def __init__(self, matrix:list[list]):
        self.__matrix = matrix

    def __getitem__(self, index:int):
        return self.__matrix[index]

    def __mul__(self, multiply:"Matrix") -> list[list]:
        return [[multiply * item for item in row] for row in self.__matrix]

    @property
    def value(self) -> list[list]:
        return self.__matrix

    @property
    def ordo(self) -> list:
        return [len(self.__matrix), len(self.__matrix[0])]

    @property
    def transpose(self) -> list[list]:
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
    def generate(cls, rows:int, cols:int, start:int = 0, stop:int = 1) -> "Matrix":
        return Matrix([[randint(start, stop) for _ in range(cols)] for _ in range(rows)])

    @classmethod
    def add(cls, a:"Matrix", b:"Matrix"):
        if a.ordo != b.ordo:
            raise TypeError

        result = []

        for row in range(len(a.value)):
            for col in range(len(a.value[0])):
                result.append([
                    a.value[row][col] + b.value[row][col]
                ])

        return result

        # List Comprehension
        # return [[a.value[row][col] + b.value[row][col] for col in range(len(a.value[0]))] for row in range(len(a.value))]

    @classmethod
    def sub(cls, a:"Matrix", b:"Matrix"):
        if a.ordo != b.ordo:
            raise TypeError

        result = []

        for row in range(len(a.value)):
            for col in range(len(a.value[0])):
                result.append([
                    a.value[row][col] - b.value[row][col]
                ])

        return result

        # List Comprehension
        # return [[a.value[row][col] - b.value[row][col] for col in range(len(a.value[0]))] for row in range(len(a.value))]

    @classmethod
    def multiply(cls, a:"Matrix", b:"Matrix"):
        if a.ordo[1] != b.ordo[0]:
            raise TypeError

        # Membuat matrix yang berisi None dengan ukuran a * c
        # sesuai dengan aturan matrix -> a * b . b * c = a * c
        result:list[list] = [[None for _ in range(a.ordo[0])] for _ in range(b.ordo[1])]
        b = Matrix(b.transpose)

        for row in range(len(a.value)):
            for loop in range(len(b.value)):

                for col in range(len(a.value[0])):
                    print(f"{a.value[row][col]} * {b.value[loop][col]} = {a.value[row][col] * b.value[loop][col]}")

                result[row][loop] = sum(
                    [a.value[row][col] * b.value[loop][col] for col in range(len(a.value[0]))]
                )

        return result

        # Semisal
        # a = [
        #     [1, 2, 3],
        #     [4, 5, 6]
        # ]
        #
        # dan
        #
        # b = [
        #     [6, 5],
        #     [4, 3],
        #     [2, 1]
        # ]
        #
        # Melakukan looping dengan array dua dimensi yang memiliki
        # ukuran berbeda sangat menyulitkan, makanya b dikondisikan agar sama dengan a.
        # b = Matrix(b.transpose)
        # Maka akan menjadi
        # a = [
        #     [1, 2, 3],
        #     [4, 5, 6]
        # ]
        #
        # b = [
        #     [6, 4, 2],
        #     [5, 3, 1]
        # ]
        #
        # Kemudian melakukan looping dengan panjang baris a, dalam kasus ini 3 kali.
        # Lalu melakukan loop lagi dengan panjang kolom b yang sudah diubah menjadi baris b.
        #
        # Contoh perkalian matrix (normal):
        # a = [
        #     [1, 2, 3],
        #     [4, 5, 6]
        # ]
        #
        # b = [
        #     [6, 5],
        #     [4, 3],
        #     [2, 1]
        # ]
        #
        # Jika dikalian akan menjadi:
        # hasil = [
        #     [1 * 6 + 2 * 4 + 3 * 2, 1 * 5 + 2 * 3 + 3 * 1],
        #     [4 * 6 + 5 * 4 + 6 * 2, 4 * 5 + 5 * 3 + 6 * 1]
        # ]
        #
        # hasil = [
        #     [ 20, 14 ],
        #     [ 56, 41 ]
        # ]
        #
        # Disini terlihat kalau tiap nilai pada baris a akan dikalikan dengan tiap nilai
        # pada kolom pada b, dikarenakan hal ini, dilakukan lah loop berikut:
        #   for loop in range(len(b.value)): ...
        # Dengan loop tersebut, memungkinkan untuk mengakses baris pada transpose b.
        #
        # Kemudian terdapat baris berikut:
        # result[row][loop] = sum(
        #     [a.value[row][col] * b.value[loop][col] for col in range(len(a.value[0]))]
        # )
        #
        # Nilai result = [
        #     [None, None],
        #     [None, None]
        # ]
        # ordo = 2 * 2
        # Jadi variable loop akan digunakan untuk mengakses baris dari b result.
        #
        # result[row][loop] = sum(
        #     [a.value[row][col] * b.value[loop][col] for col in range(len(a.value[0]))]
        # )
        # malas

if __name__ == "__main__":
    A = Matrix([
        [1, 2, 3],
        [4, 5, 6]
    ])

    B = Matrix([
        [7, 6, 5],
        [4, 3, 2]
    ])

    C = Matrix([
        [11],
        [12],
    ])

    D = Matrix([
        [1, 2],
        [3, 4]
    ])

    E = Matrix([
        [6, 5],
        [4, 3],
        [2, 1]
    ])

    F = Matrix.generate(2, 2, 0, 10)

    print(Matrix.multiply(A, E))