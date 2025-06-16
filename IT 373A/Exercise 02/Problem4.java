import java.util.Scanner;

public class Problem4 {
    public static void main(String[] args) {
        // Create Scanner Object
        Scanner scanner = new Scanner(System.in);

        // User Input
        System.out.print("Enter a string: ");
        String inputString = scanner.nextLine().toLowerCase();

        // Vowel Checker
        boolean vowelChecker = false;
        char[] vowels = {'a', 'e', 'i', 'o', 'u'};
        char firstChar = inputString.charAt(0);

        for (int i = 0; i < vowels.length; i++) {
            if (firstChar == vowels[i]){
                vowelChecker = true;

                break;
            }
        }

        // Output Result
        System.out.printf("\nStarts with a vowel? %b", vowelChecker);

        // Close Scanner Object
        scanner.close();
    }
}