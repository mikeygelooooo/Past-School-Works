#include <stdio.h>

int main(){

  int number;

  printf("Enter a number: ");
  scanf("%d", &number);

  printf("\nResult 1: ");

  for (int s1 = 1; s1 <= number; s1++) {
    printf("%d\t", s1);
  }

  printf("\nResult 2: ");

  for (int s2 = number; s2 >= 1; s2--) {
    printf("%d\t", s2);
  }
  
  return 0;
}