import java.util.Scanner;

public class Problem2 {
    public static void main(String[] args) {
        // Create Scanner Object
        Scanner input = new Scanner(System.in);

        // User Input
        System.out.print("Enter a number: ");
        int num = input.nextInt();

        // Output Result
        if (num % 2 == 0) {
            System.out.printf("\n%d is even.", num);
        } else {
            System.out.printf("\n%d is odd.", num);
        }

        // Close Scanner Object
        input.close();
    }
}