#include <stdio.h>
#include <stdlib.h>
#include <time.h>

#define size 10

int main(){

  int numbers[size];
  int evenSum = 0;
  int oddSum = 0;

  srand(time(0));

  printf("Elements of the array:\n");

  for (int r = 0; r < size; r++){
    numbers[r] = rand();

    printf("%d ", numbers[r]);
  }

  printf("\n\nAll Even Numbers:\n");

  for (int e = 0; e < size; e++){
    if (numbers[e] % 2 == 0){
      printf("%d ", numbers[e]);

      evenSum += numbers[e];
    }
  }

  printf("\n\nSum of Even Numbers: %d", evenSum);

  printf("\n\nAll Odd Numbers:\n");

  for (int o = 0; o < size; o++){
    if (numbers[o] % 2 == 1){
      printf("%d ", numbers[o]);

      oddSum += numbers[o];
    }
  }
  
  printf("\n\nSum of Odd Numbers: %d", oddSum);
  
  return 0;
}