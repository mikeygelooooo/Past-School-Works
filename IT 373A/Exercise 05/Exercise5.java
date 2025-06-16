import java.util.Scanner;

public class Exercise5 {
    // Create Scanner Object
    private static Scanner scanner = new Scanner(System.in);

    public static void main(String[] args) {
        int choice;
        do {
            System.out.print("\033[H\033[2J");
            System.out.flush();
            System.out.println("=================================");
            System.out.println("IT 373A - Week 5 Exercises");
            System.out.println("Michael Angelo A. Ochengco");
            System.out.println("BS Information Technology - 3B");
            System.out.println("=================================");
            System.out.println("[1] Greeting Message");
            System.out.println("[2] Add Numbers");
            System.out.println("[3] Multiply Numbers");
            System.out.println("[4] Is Even");
            System.out.println("[5] Find Max");
            System.out.println("[0] Exit");
            System.out.println("=================================");
            System.out.print("Enter your choice: ");
            choice = scanner.nextInt();
            scanner.nextLine();
            System.out.println("=================================");

            if (choice == 0) {
                System.out.print("\nExiting...\n");
            } else if (choice == 1) {
                Greet();
            } else if (choice == 2) {
                System.out.print("Enter first integer: ");
                int x = scanner.nextInt();
                System.out.print("Enter second integer: ");
                int y = scanner.nextInt();

                System.out.printf("\nThe sum is: %d", AddNumbers(x, y));
            } else if (choice == 3) {
                System.out.println("[1] Multiply 2 numbers");
                System.out.println("[2] Multiply 3 numbers");
                System.out.println("=================================");

                int multiplyChoice;

                do {
                    System.out.print("Enter your choice: ");
                    multiplyChoice = scanner.nextInt();
                    System.out.println("=================================");

                    if (multiplyChoice == 1) {
                        System.out.print("Enter first integer: ");
                        int x = scanner.nextInt();
                        System.out.print("Enter second integer: ");
                        int y = scanner.nextInt();

                        System.out.printf("\nThe product is: %d", Multiply(x, y));
                    } else if (multiplyChoice == 2) {
                        System.out.print("Enter first integer: ");
                        int x = scanner.nextInt();
                        System.out.print("Enter second integer: ");
                        int y = scanner.nextInt();
                        System.out.print("Enter third integer: ");
                        int z = scanner.nextInt();

                        System.out.printf("\nThe product is: %d", Multiply(x, y, z));
                    } else {
                        System.out.print("\nInvalid choice. Please enter 1 or 2.\n");
                        System.out.println("\n=================================");
                    }
                } while (multiplyChoice != 1 && multiplyChoice != 2);

            } else if (choice == 4) {
                System.out.print("Enter an integer: ");
                int x = scanner.nextInt();

                System.out.printf("\nIs %d even? %b", x, isEven(x));
            } else if (choice == 5) {
                System.out.print("Enter first integer: ");
                int x = scanner.nextInt();
                System.out.print("Enter second integer: ");
                int y = scanner.nextInt();
                System.out.print("Enter third integer: ");
                int z = scanner.nextInt();

                System.out.printf("\nThe largest number is: %d", FindMax(x, y, z));
            } else {
                System.out.print("\nInvalid choice. Please enter 0-5.\n");
            }

            System.out.println("\n=================================");
            System.out.println("Press Enter to continue...");

            try {
                System.in.read();
            } catch (Exception e) {
                e.printStackTrace();
            }
        } while (choice != 0);
    }

    // Displays a greeting message
    public static void Greet() {
        System.out.print("\nHello, welcome to Java programming!\n");
    }

    // Adds two numbers
    public static int AddNumbers(int x, int y) {
        return x + y;
    }

    // Multiplies two numbers
    public static int Multiply(int x, int y) {
        return x * y;
    }

    // Multiplies three numbers
    public static int Multiply(int x, int y, int z) {
        return x * y * z;
    }

    // Checks if a number is even
    public static boolean isEven(int x) {
        return x % 2 == 0;
    }

    // Finds the maximum of three numbers
    public static int FindMax(int x, int y, int z) {
        return Math.max(Math.max(x, y), z);
    }
}