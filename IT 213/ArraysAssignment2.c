#include <stdio.h>
#include <stdlib.h>
#include <time.h>

#define numRow 3
#define numCol 4

int main(){

  int num1[numRow][numCol];
  int num2[numRow][numCol];

  int rr, rc, ar, ac;

  srand(time(0));

  printf("Array # 1:\n");

  for (int fr = 0; fr < numRow; fr++){
    for (int fc = 0; fc < numCol; fc++){
      num1[fr][fc] = rand();

      printf("%d\t", num1[fr][fc]);
    }
    printf("\n");
  }

  printf("\nArray # 2:\n");

  for (rr = numRow - 1, ar = 0; rr >= 0; rr--, ar++){
    for (rc = numCol - 1, ac = 0; rc >= 0; rc--, ac++){
      num2[ar][ac] = num1[rr][rc];

      printf("%d\t", num2[ar][ac]);
    }
    printf("\n");
  }
  
  return 0;
}