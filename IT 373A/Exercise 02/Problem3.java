import java.util.Scanner;
import java.util.Arrays;

public class Problem3 {
    public static void main(String[] args) {
        // Create Scanner Object
        Scanner scanner = new Scanner(System.in);

        // User Input
        System.out.print("Enter first string: ");
        String str1 = scanner.nextLine().toLowerCase().replaceAll("\\s", "");

        System.out.print("Enter second string: ");
        String str2 = scanner.nextLine().toLowerCase().replaceAll("\\s", "");

        // Anagram Checker
        boolean areAnagrams = true;

        if (str1.length() != str2.length()) {
            areAnagrams = false;
        } else {
            char[] charArray1 = str1.toCharArray();
            char[] charArray2 = str2.toCharArray();

            Arrays.sort(charArray1);
            Arrays.sort(charArray2);

            areAnagrams = Arrays.equals(charArray1, charArray2);
        }

        // Output Result
        System.out.printf("\nAre anagrams? %b", areAnagrams);

        // Close Scanner Object
        scanner.close();
    }
}
