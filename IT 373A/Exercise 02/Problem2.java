import java.util.Scanner;

public class Problem2 {
    public static void main(String[] args) {
        // Create Scanner Object
        Scanner scanner = new Scanner(System.in);

        // User Input
        System.out.print("Enter a string: ");
        String inputString = scanner.nextLine().toLowerCase();

        System.out.print("Enter a character to count: ");
        char inputChar = scanner.next().toLowerCase().charAt(0);

        // Character Counter
        int count = 0;
        
        for (int i = 0; i < inputString.length(); i++) {
            if (inputString.charAt(i) == inputChar) {
                count++;
            }
        }

        // Output Result
        System.out.printf("\nThe character '%c' appears %d times.", inputChar, count);

        // Close Scanner Object
        scanner.close();
    }
}
