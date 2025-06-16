#include <stdio.h>

int main(){

  int lines;

  printf("Enter number of lines: ");
  scanf("%d", &lines);

  for (int triangles = 1; triangles <= lines; triangles++){
    for (int t1 = 1; t1 <= triangles; t1++){
      printf("* ");
    }

    for (int t2 = lines; t2 >= triangles; t2--){
      printf("  ");
    }

    for (int t3 = lines; t3 >= triangles; t3--){
      printf("* ");
    }

    for (int t4 = 1; t4 <= triangles; t4++){
      printf("  ");
    }

    for (int t5 = lines; t5 >= triangles; t5--){
      printf("  ");
    }

    for (int t6 = 1; t6 <= triangles; t6++){
      printf("* ");
    }

    for (int t7 = 1; t7 <= triangles; t7++){
      printf("  ");
    }

    for (int t8 = lines; t8 >= triangles; t8--){
      printf("* ");
    }

    printf("\n");
  }

  return 0;
}
