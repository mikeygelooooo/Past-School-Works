import java.util.Scanner;

public class Problem3 {
    public static void main(String[] args) {
        // Create Scanner Object
        Scanner input = new Scanner(System.in);

        // User Input
        System.out.print("Enter a number: ");
        int num = input.nextInt();

        int factorial = 1;

        for (int i = 1; i <= num; i++) {
            factorial *= i;
        }

        // Output Result
        System.out.printf("\nFactorial of %d is: %d", num, factorial);

        // Close Scanner Object
        input.close();
    }
}