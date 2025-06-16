import java.util.Scanner;

public class Problem2 {
    public static void main(String[] args) {
        // Create Scanner Object
        Scanner scanner = new Scanner(System.in);

        // User Input
        System.out.print("Input: ");
        int num = scanner.nextInt();

        // Day of the Week
        switch (num) {
            case 1:
                System.out.println("\nOutput: Monday");
                break;
            case 2:
                System.out.println("\nOutput: Tuesday");
                break;
            case 3:
                System.out.println("\nOutput: Wednesday");
                break;
            case 4:
                System.out.println("\nOutput: Thursday");
                break;
            case 5:
                System.out.println("\nOutput: Friday");
                break;
            case 6:
                System.out.println("\nOutput: Saturday");
                break;
            case 7:
                System.out.println("\nOutput: Sunday");
                break;
            default:
                System.out.println("\nOutput: Does not exist");
                break;
        }

        // Close Scanner Object
        scanner.close();
    }
}