#include <stdio.h>

// TYPES OF LOOPS

void counter(); // Counter-Controlled Loop
void sentinel(); // Sentinel-Controlled Loop
void flag(); // Flag-COntrolled Loop

int main(){

  char choice;
  int temp = 0;

  printf("TYPES OF LOOPS\n\n");
  printf("1. Counter-Controlled Loops (C)\n");
  printf("2. Sentinel-Controlled Loops (S)\n");
  printf("3. Flag-Controlled Loops (F)\n");

  do {
    printf("\nEnter choice here: ");
    scanf(" %c", &choice);

    if (choice == '1' || choice == 'C' || choice == 'c'){
      counter();
    } else if (choice == '2' || choice == 'S' || choice == 's'){
      sentinel();
    } else if (choice == '3' || choice == 'F' || choice == 'f'){
      flag();
    } else {
      temp = 1;

      printf("\nINVALID INPUT!\n");
    }
  
  } while (temp == 1);

  return 0;
}

// COUNTER-CONTROLLED FOR LOOP
void counter(){

  int limit;
  int number;

  printf("\nCOUNTER-CONTROLLED LOOP\n\n");

  printf("Enter a limit: ");
  scanf("%d", &limit);

  printf("\nEnter %d numbers\n\n", limit);

  for (int c = 1; c <= limit; c++){
    printf("Enter a number: ");
    scanf("%d", &number);
  }
  
}

// SENTINEL-CONTROLLED DO-WHILE LOOP
void sentinel(){

  int number;

  printf("\nSENTINEL-CONTROLLED LOOPS\n\n");

  printf("Guess the secret number to get out of the loop!\n\n");

  do{
    printf("Enter a number: ");
    scanf("%d", &number);

  } while (number != 0);
  

}

// FLAG-CONTROLLED WHILE LOOP
void flag(){

  int flag = 1;
  int number;

  printf("\nFLAG-CONTROLLED LOOPS\n\n");

  while (flag != 0){
    printf("Enter a number: ");
    scanf("%d", &number);

    if (number % 2 == 0){
      flag = 0;
      printf("\nCongratulations! You've made it out of the loop!");

    } else {
      printf("\nOpps! Try Again!\n\n");
    }
    
  }
  
}