#include <stdio.h>

int main(){

  int lines;

  printf("Enter number of lines: ");
  scanf("%d", &lines);

  for (int triangle1 = 1; triangle1 <= lines; triangle1++){
    for (int t1 = 1; t1 <= triangle1; t1++){
      printf("* ");
    }

    printf("\n");
  }

  printf("\n");

  for (int triangle2 = 1; triangle2 <= lines; triangle2++){
    for (int t2 = lines; t2 >= triangle2; t2--){
      printf("* ");
    }

    printf("\n");
  }

  printf("\n");

  for (int triangle3 = 1; triangle3 <= lines; triangle3++){
    for (int t3 = lines; t3 > triangle3; t3--){
      printf("  ");
    }

    for (int t4 = 1; t4 <= triangle3; t4++){
      printf("* ");
    }

    printf("\n");
  }

  printf("\n");

  for (int triangle4 = 1; triangle4 <= lines; triangle4++){
    for (int t5 = 1; t5 < triangle4; t5++){
      printf("  ");
    }

    for (int t6 = lines; t6 >= triangle4; t6--){
      printf("* ");
    }

    printf("\n");
  }

  return 0;
}