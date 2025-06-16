#include <stdio.h>
#include <stdlib.h>
#include <conio.h>
#include <time.h>

int main(){

   int random;
   int remainder;

   srand(time(0));
   random = rand();

   remainder = random % 2;

   printf("Random Number: %d\n", random);

   switch (remainder)
   {
   case 0:
      random = random * 2;
      printf("\n%d", random); 
      break;
   
   default:
      random = (random * 3) + 1;
      printf("\n%d", random);
      break;
   }

   return 0;
}