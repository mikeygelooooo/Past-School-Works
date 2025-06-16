import java.util.Scanner;

public class Problem3 {
    public static void main(String[] args) {
        // Create Scanner Object
        Scanner scanner = new Scanner(System.in);

        // User Input
        System.out.print("Input: ");
        int num = scanner.nextInt();

        // Calculate Sum
        int sum = 0;

        for (int i = 1; i <= num; i++) {
            sum += i;
        }

        // Output Result
        System.out.printf("\nOutput: %d", sum);

        // Close Scanner Object
        scanner.close();
    }
}