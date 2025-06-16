import java.util.Scanner;
import java.util.Arrays;

public class Problem5 {
    public static void main(String[] args) {
        // Create Scanner Object
        Scanner scanner = new Scanner(System.in);

        // Array Size
        System.out.print("Array Length: ");
        int arrLength = scanner.nextInt();

        // Input Array
        int[] arr = new int[arrLength];

        for (int i = arrLength - 1; i >= 0; i--) {
            System.out.print("Input: ");
            arr[i] = scanner.nextInt();
        }

        // Output Result
        System.out.println("\nOutput: " + Arrays.toString(arr));

        // Close Scanner Object
        scanner.close();
    }
}