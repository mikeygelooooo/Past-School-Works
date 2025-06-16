import java.util.Scanner;

public class Exercise4 {
    // Create Scanner Object
    private static Scanner scanner = new Scanner(System.in);

    public static void main(String[] args) {
        int choice;
        do {
            System.out.print("\033[H\033[2J");
            System.out.flush();
            System.out.println("=================================");
            System.out.println("IT 373A - Week 4 Exercises");
            System.out.println("Michael Angelo A. Ochengco");
            System.out.println("BS Information Technology - 3B");
            System.out.println("=================================");
            System.out.println("[1] Maximum and Minimum");
            System.out.println("[2] Palindrome");
            System.out.println("[3] Student Grade");
            System.out.println("[4] Matrix Addition");
            System.out.println("[5] Bubble Sort");
            System.out.println("[0] Exit");
            System.out.println("=================================");
            System.out.print("Enter your choice: ");
            choice = scanner.nextInt();
            scanner.nextLine();
            System.out.println("=================================");
            if (choice == 0) {
                System.out.println("Exiting...");
            } else if (choice == 1) {
                Problem1();
            } else if (choice == 2) {
                Problem2();
            } else if (choice == 3) {
                Problem3();
            } else if (choice == 4) {
                Problem4();
            } else if (choice == 5) {
                Problem5();
            } else {
                System.out.println("Invalid choice. Please enter 0-5.");
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

    public static void Problem1() {
        // Declare Array
        int[] numbers = new int[10];

        // User Input
        System.out.println("Enter 10 integers:");
        for (int i = 0; i < 10; i++) {
            numbers[i] = scanner.nextInt();
        }

        // Find Maximum and Minimum
        int max = numbers[0];
        int min = numbers[0];

        for (int i = 1; i < numbers.length; i++) {
            max = Math.max(max, numbers[i]);
            min = Math.min(min, numbers[i]);
        }

        // Output Results
        System.out.printf("\nMaximum value: %d\n", max);
        System.out.printf("Minimum value: %d", min);
    }

    public static void Problem2() {
        // User Input
        System.out.print("Enter a string: ");
        String input = scanner.nextLine();

        // Palindrome Checker
        boolean isPalindrome = true;
        String str = input.toLowerCase().replaceAll("[^a-z]", "");
        int length = str.length();

        for (int i = 0; i < (length / 2); i++) {
            if (str.charAt(i) != str.charAt(length - 1 - i)) {
                isPalindrome = false;

                break;
            }
        }

        // Output Result
        if (isPalindrome) {
            System.out.printf("\n%s is a palindrome.", input);
        } else {
            System.out.printf("\n%s is not a palindrome.", input);
        }
    }

    public static void Problem3() {
        // Create Student Class
        class Student {
            private String name;
            private int age;
            private double[] testScores = new double[3];

            // Constructor
            public Student(String name, int age, double score1, double score2, double score3) {
                this.name = name;
                this.age = age;
                this.testScores[0] = score1;
                this.testScores[1] = score2;
                this.testScores[2] = score3;
            }

            // Calculate Average
            public double calculateAverage() {
                double sum = 0;

                for (double score : testScores) {
                    sum += score;
                }

                return sum / testScores.length;
            }

            // Determine Grade
            public char determineGrade() {
                double average = calculateAverage();

                if (average >= 95)
                    return 'A';
                else if (average >= 90)
                    return 'B';
                else if (average >= 85)
                    return 'C';
                else if (average >= 80)
                    return 'D';
                else if (average >= 75)
                    return 'E';
                else
                    return 'F';
            }
        }

        // User Input
        System.out.print("Enter Name: ");
        String name = scanner.nextLine();
        System.out.print("Enter Age: ");
        int age = scanner.nextInt();
        System.out.println("Enter Test Scores:");
        double score1 = scanner.nextDouble();
        double score2 = scanner.nextDouble();
        double score3 = scanner.nextDouble();

        // Create Student Object
        Student student = new Student(name, age, score1, score2, score3);

        // Calculate Grade
        double average = student.calculateAverage();
        char grade = student.determineGrade();

        // Output Results
        System.out.printf("\nName: %s\n", name);
        System.out.printf("Age: %d\n", age);
        System.out.printf("Average Score: %.2f\n", average);
        System.out.printf("Grade: %c", grade);
    }

    public static void Problem4() {
        // Declare Matrices
        int[][] matrix1 = new int[3][3];
        int[][] matrix2 = new int[3][3];
        int[][] resultMatrix = new int[3][3];

        // Input Matrix 1
        System.out.println("Matrix 1:");
        for (int i = 0; i < 3; i++) {
            for (int j = 0; j < 3; j++) {
                matrix1[i][j] = scanner.nextInt();
            }
        }

        // Input Matrix 2
        System.out.println("\nMatrix 2:");
        for (int i = 0; i < 3; i++) {
            for (int j = 0; j < 3; j++) {
                matrix2[i][j] = scanner.nextInt();
            }
        }

        // Matrix Addition
        for (int i = 0; i < 3; i++) {
            for (int j = 0; j < 3; j++) {
                resultMatrix[i][j] = matrix1[i][j] + matrix2[i][j];
            }
        }

        // Output Result
        System.out.println("\nResulting Matrix:");
        for (int i = 0; i < 3; i++) {
            for (int j = 0; j < 3; j++) {
                System.out.print(resultMatrix[i][j] + " ");
            }
            System.out.println();
        }
    }

    public static void Problem5() {
        // Declare Array
        int[] numbers = new int[5];

        // User Input
        System.out.println("Enter 5 Numbers:");
        for (int i = 0; i < 5; i++) {
            numbers[i] = scanner.nextInt();
        }

        // Bubble Sort
        int len = numbers.length;
        for (int i = 0; i < len - 1; i++) {
            for (int j = 0; j < len - i - 1; j++) {
                if (numbers[j] > numbers[j + 1]) {
                    int temp = numbers[j];
                    numbers[j] = numbers[j + 1];
                    numbers[j + 1] = temp;
                }
            }
        }

        // Output Results
        System.out.println("\nSorted Array:");
        for (int num : numbers) {
            System.out.print(num + " ");
        }
    }
}
