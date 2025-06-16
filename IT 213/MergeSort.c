#include <stdio.h>
#include <stdlib.h>
#include <string.h>

void MergeSort(char Arr1[][100], char Arr2[][100], int Size1, int Size2){
    int Size_Merged = Size1 + Size2;
    char Array_Merged[100][100];

    char string_temp[100];

    for (int Count1 = 0, Count2 = 0, Count3 = 0; Count1 < Size1 || Count2 < Size2; Count3++) {
        if (Count1 < Size1) {
            strcpy(Array_Merged[Count3], Arr1[Count1]);
            Count1++;
        } else if (Count2 < Size2) {
            strcpy(Array_Merged[Count3], Arr2[Count2]);
            Count2++;
        }
    }

    for (int Ctr1 = 0; Ctr1 < Size_Merged; Ctr1++) {
        for (int Ctr2 = Ctr1 + 1; Ctr2 < Size_Merged; Ctr2++) {
            if (strcmp(Array_Merged[Ctr1], Array_Merged[Ctr2]) > 0) {
                strcpy(string_temp, Array_Merged[Ctr1]);
                strcpy(Array_Merged[Ctr1], Array_Merged[Ctr2]);
                strcpy(Array_Merged[Ctr2], string_temp);
            }
        }
    }

    printf("\n------------------------------\n\n");
    printf("     MERGE & SORT RESULTS\n\n");

    for (int Count = 0; Count < Size_Merged; Count++)
    {
        printf(" Merged Array [%d] = %s\n", Count + 1, Array_Merged[Count]);
    }

    printf("\n------------------------------\n\n");
}

int main(){
    int Length_A, Length_B;
    char Array_A[100][100];
    char Array_B[100][100];

    system("cls");

    printf("------------------------------\n\n");
    printf("         MERGE & SORT\n\n");
    printf("     by: Ochengco BSIT 2B\n\n");
    printf("------------------------------\n\n");
    printf("    LENGTH OF ARRAYS A & B\n\n");

    printf(" Array A Length: ");
    scanf("%d", &Length_A);

    printf(" Array B Length: ");
    scanf("%d", &Length_B);

    printf("\n------------------------------\n\n");
    printf("   ELEMENTS OF ARRAYS A & B\n\n");

    for (int Ctr_A = 0; Ctr_A < Length_A; Ctr_A++) {
        printf(" Array A [%d] = ", Ctr_A + 1);
        scanf("%s", Array_A[Ctr_A]);
    }

    printf("\n");

    for (int Ctr_B = 0; Ctr_B < Length_B; Ctr_B++) {
        printf(" Array B [%d] = ", Ctr_B + 1);
        scanf("%s", Array_B[Ctr_B]);
    }

    MergeSort(Array_A, Array_B, Length_A, Length_B);

    return 0;
}