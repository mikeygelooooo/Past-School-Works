import java.util.Scanner;

public class Problem5 {
    public static void main(String[] args) {
        // Create Scanner Object
        Scanner scanner = new Scanner(System.in);

        // User Input
        System.out.print("Enter a string: ");
        String inputString = scanner.nextLine().toLowerCase();

        // Boolean Checker
        boolean booleanValue;
        String[] booleanStrings = {"true", "false"};

        if (inputString.equals(booleanStrings[0])) {
            booleanValue = true;

            System.out.printf("\nBoolean value? %b", booleanValue);
        } else if (inputString.equals(booleanStrings[1])) {
            booleanValue = false;

            System.out.printf("\nBoolean value? %b", booleanValue);
        } else {
            System.out.printf("\nBoolean value? NULL");
        }

        // Close Scanner Object
        scanner.close();
    }
}