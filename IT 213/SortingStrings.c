#include <stdio.h>
#include <stdlib.h>
#include <string.h>



void InputArr();
void SortArr(char Arr1[][50], int N);
void DisplayArr(char Arr1[][50], int N);



int main()
{   
    system("cls");
    printf("------------------------------\n\n");
    printf("\tSTRING SORTER\n\n");
    printf("------------------------------\n\n");
    printf("\t  INPUT MODE\n\n");
    printf("------------------------------\n\n");

    InputArr();

    return 0;
}



void InputArr()
{
    int no_of_elements;
    char array_input[10000][50];

    do
    {
        printf(" Enter # of elements: ");
        scanf("%d", &no_of_elements);

        if (no_of_elements < 3)
        {
            printf("\n------------------------------\n\n");
            printf(" INPUT SHOULD BE MORE THAN 2!\n\n");
            printf("------------------------------\n\n");
        }
        
    } while (no_of_elements < 3);

    printf("\n------------------------------\n\n");

    for(int i = 0; i < no_of_elements; i++)
    {
        printf(" Element # %d: ", i + 1);
        scanf("%s", array_input[i]);
    }

    printf("\n------------------------------\n\n");
    system("pause");
    
    system("cls");
    printf("------------------------------\n\n");
    printf("\tSTRING SORTER\n\n");
    printf("------------------------------\n\n");
    printf("\t OUTPUT MODE\n\n");
    printf("------------------------------\n\n");
    printf("\tORIGINAL ARRAY\n\n");

    DisplayArr(array_input, no_of_elements);

    SortArr(array_input, no_of_elements);
}



void SortArr(char Arr1[][50], int N)
{
    int Ctr1;
    int Ctr2;
    char Temp[50];

    Ctr1 = 1;

    while (Ctr1 - 1 <= N - 1)
    {
        Ctr2 = Ctr1 + 1;

        while (Ctr2 <= N)
        {
            if (strcmp(Arr1[Ctr1 - 1], Arr1[Ctr2 - 1]) > 0)
            {
                strcpy(Temp, Arr1[Ctr1 - 1]);
                strcpy(Arr1[Ctr1 - 1], Arr1[Ctr2 - 1]);
                strcpy(Arr1[Ctr2 - 1], Temp);
            }
            
            Ctr2++;
        }
        
        Ctr1++;
    }

    printf("\n\tSORTED ARRAY\n\n");

    DisplayArr(Arr1, N);
}



void DisplayArr(char Arr1[][50], int N)
{
    for (int i = 0; i < N; i++)
    {
        printf("\t[%d] = %s\n", i + 1, Arr1[i]);
    }
    
    printf("\n------------------------------\n");
}