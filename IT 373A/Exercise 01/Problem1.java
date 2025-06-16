import java.util.Scanner;

public class Problem1 {
    public static void main(String[] args) {
        // Create Scanner Object
        Scanner input = new Scanner(System.in);

        // User Input
        System.out.print("Enter first number: ");
        int num1 = input.nextInt(); // First number
        System.out.print("Enter second number: ");
        int num2 = input.nextInt(); // Second number

        // Output Results
        System.out.printf("\nSum: %d\n", num1 + num2);
        System.out.printf("Difference: %d\n", num1 - num2);
        System.out.printf("Product: %d\n", num1 * num2);
        System.out.printf("Quotient: %d\n", num1 / num2);

        // Close Scanner Object
        input.close();
    }
}