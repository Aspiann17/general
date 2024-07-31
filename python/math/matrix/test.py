from main import Matrix as M
import unittest

class TestMatrix(unittest.TestCase):    
    def test_ordo(self):
        ordo = M([
            [1, 2, 3, 4],
            [5, 6, 7, 8]
        ]).ordo

        self.assertEqual(ordo, [2, 4])
    
    def test_transpose(self):
        At = M([
            [1, 2, 3, 4],
            [5, 6, 7, 8]
        ]).transpose

        self.assertEqual(At, [
            [1, 5],
            [2, 6],
            [3, 7],
            [4, 8]
        ])

if __name__ == "__main__":
    unittest.main()