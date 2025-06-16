import java.util.Scanner;

public class Problem1 {
    public static void main(String[] args) {
        // Create Scanner Object
        Scanner scanner = new Scanner(System.in);

        // User Input
        System.out.print("Input: ");
        int num = scanner.nextInt();

        // Odd or Even
        if (num % 2 == 0) {
            System.out.println("\nOutput: Even");
        } else {
            System.out.println("\nOutput: Odd");
        }

        // Close Scanner Object
        scanner.close();
    }
}