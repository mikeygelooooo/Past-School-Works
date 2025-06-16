import java.util.Scanner;

public class Problem4 {
    public static void main(String[] args) {
        // Create Scanner Object
        Scanner scanner = new Scanner(System.in);

        // Generate Random Number
        int randomNum = (int)(Math.random() * 101);

        // Guess the Number
        int tries = 1;

        while (true) {
            System.out.print("Guess the number: ");
            int num = scanner.nextInt();

            if (num == randomNum) {
                System.out.printf("Correct! You guessed it in %d tries.", tries);

                break;
            } else if (num > randomNum) {
                System.out.println("Too high.\n");

                tries++;
            } else if (num < randomNum) {
                System.out.println("Too low.\n");

                tries++;
            }
        }

        // Close Scanner Object
        scanner.close();
    }
}