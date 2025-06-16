#include <stdio.h>
#include <conio.h>
#include <stdlib.h>
#include <time.h>

int main(){

    int randomNumber;
    int guess;
    int balance;
    int bet;
    int answer;

    srand(time(0));
    randomNumber = rand() %2;

    printf("WELCOME TO GAMBURU!!!\n\n");

    printf("Deposit coins here: ");
    scanf("%d", &balance);

    printf("Your balance is: %d", balance);

    if(balance > 0){
         
      printf("\nPlace your bet here: ");
      scanf("%d", &bet);

      if(bet > balance){
         printf("Insufficient Balance!!!");
      } else {
         printf("\nHeads of Tails??[0 = Heads, 1 = Tails]\n");
         printf("Enter your guess here: ");
         scanf("%d", &guess);

         if(guess == randomNumber){
            printf("\nCONGRATULATIONS!!! YOU GUESSED CORRECTLY!!!\n");
            balance = balance + bet;

            printf("Your current balance is %d", balance);

         } else {
            printf("\nOOPS!!! YOU LOST!!!\n");
            printf("The correct answer is: %d\n", randomNumber);
            balance = balance - bet;

            printf("Your current balance is %d", balance);
         }
      }
    } else {
         printf("\nERROR!!! TRY AGAIN!!!");
    }
        
    return 0;
}