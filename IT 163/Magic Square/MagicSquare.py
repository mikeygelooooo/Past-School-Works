def isMagicSquare(matrix):
    if len(matrix) != 3 or any(len(row) != 3 for row in matrix):
        return False

    nums = [num for row in matrix for num in row]
    if len(nums) != len(set(nums)):
        return False

    magic_sum = sum(matrix[0])

    for i in range(3):
        if sum(matrix[i]) != magic_sum or sum(matrix[j][i] for j in range(3)) != magic_sum:
            return False

    if sum(matrix[i][i] for i in range(3)) != magic_sum or sum(matrix[i][2 - i] for i in range(3)) != magic_sum:
        return False

    return True

# Test
print(isMagicSquare([[4, 9, 2], [3, 5, 7], [8, 1, 6]]))
print(isMagicSquare([[6, 1, 8], [7, 5, 3], [2, 9, 4]]))
print(isMagicSquare([[1, 2, 3], [4, 5, 6], [7, 8, 9]]))
print(isMagicSquare([[2, 2, 2], [2, 2, 2], [2, 2, 2]]))
