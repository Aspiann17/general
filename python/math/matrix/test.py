from main import Matrix as M
import unittest

class TestMatrix(unittest.TestCase):    
    def test_ordo(self):
        ordo1 = M([
            [1, 2, 3, 4],
            [5, 6, 7, 8]
        ]).ordo

        ordo2 = M([
            [1, 2],
            [3, 4],
            [5, 6],
            [7, 8]
        ]).ordo

        self.assertEqual(ordo1, [2, 4])
        self.assertEqual(ordo2, [4, 2])

        self.assertIsInstance(ordo1, list)
        self.assertIsInstance(ordo2, list)

    def test_transpose(self):
        At = M([
            [1, 2, 3, 4],
            [5, 6, 7, 8]
        ]).transpose

        Bt = M([
            [1, 5],
            [2, 6],
            [3, 7],
            [4, 8]
        ]).transpose

        self.assertEqual(At, [
            [1, 5],
            [2, 6],
            [3, 7],
            [4, 8]
        ])

        self.assertEqual(Bt, [
            [1, 2, 3, 4],
            [5, 6, 7, 8]
        ])

    def test_generate(self):
        A = M.generate(5, 20, 0, 100)
        At = M(A.transpose)

        self.assertEqual(A.ordo, [5, 20])
        self.assertEqual(At.ordo, [20, 5])

    def test_add(self):

        a = M([
            [1, 2, 3],
            [4, 5, 6]
        ])

        b = M([
            [7, 6, 5],
            [4, 3, 2]
        ])

        result = M.add(a, b)

        self.assertEqual(result, [
            [8], [8], [8],
            [8], [8], [8]
        ])

    def test_sub(self):
        a = M([
            [1, 2, 3],
            [4, 5, 6]
        ])

        b = M([
            [7, 6, 5],
            [4, 3, 2]
        ])

        result = M.sub(a, b)

        self.assertEqual(result, [
            [-6],
            [-4],
            [-2],
            [0],
            [2],
            [4]
        ])
    
    def test_multiply(self):
        a = M([[1, 2, 3]])
        b = M([
            [3],
            [2],
            [1]
        ])

        result1 = M.multiply(a, b)
        result2 = M.multiply(b, a)

        self.assertEqual(result1, [[10]])
        self.assertEqual(result2, [
            [3, 6, 9],
            [2, 4, 6],
            [1, 2, 3]
        ])

if __name__ == "__main__":
    unittest.main()