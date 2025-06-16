#include <stdio.h>

  int num;
  int seq1;
  int seq2;

int main(){

  printf("Enter a number: ");
  scanf("%d", &num);

  seq2 = num;

  printf("\nResult: ");

  for(seq1 = 1; seq1 <= num ; seq1++){

    printf("%d ", seq2);

    seq2--;

    printf("%d ", seq1);
    
  }

  return 0;
}