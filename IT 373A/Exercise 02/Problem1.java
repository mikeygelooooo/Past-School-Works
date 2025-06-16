import java.util.Scanner;

public class Problem1 {
    public static void main(String[] args) {
        // Create Scanner Object
        Scanner scanner = new Scanner(System.in);

        // User Input
        System.out.print("Enter a string: ");
        String input = scanner.nextLine().toLowerCase();

        // Palindrome Checker
        boolean isPalindrome = true;
        int length = input.length();
        
        for (int i = 0; i < (length / 2); i++) {
            if (input.charAt(i) != input.charAt(length - 1 - i)) {
                isPalindrome = false;

                break;
            }
        }

        // Output Result
        System.out.printf("\nIs palindrome? %b", isPalindrome);

        // Close Scanner Object
        scanner.close();
    }
}
