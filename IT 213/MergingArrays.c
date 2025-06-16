#include <stdio.h>
#include <stdlib.h>
#include <string.h>

void MergeArr(char Arr1[][50], char Arr2[][50], int N1, int N2);
void Arr1();
void Arr2();

int Count1;
int Count2;
int Count3;

char array1[][50] = {"Mango", "Orange", "Apple"};
char array2[][50] = {"Banana", "Grape"};
char array3[5][50];

int array1_size = 3;
int array2_size = 2;

int main()
{
    MergeArr(array1, array2, array1_size, array2_size);

    for (int i = 0; i < 5; i++)
    {
        printf("%s, ", array3[i]);
    }

    return 0;
}

void MergeArr(char arr1[][50], char arr2[][50], int a1n, int a2n)
{
    Count1 = 1;
    Count2 = 1;
    Count3 = 1;

    while (Count1 <= a1n || Count2 <= a2n)
    {
        if (Count1 > a1n)
        {
            Arr2();
        }
        else
        {
            if (Count2 > a2n)
            {
                Arr1();
            }
            else
            {
                if (strcmp(arr1[Count1 - 1], arr2[Count2 - 1]) < 0)
                {
                    Arr1();
                }

                else
                {
                    Arr2();
                }
            }
        }

        Count3++;
    }
}

void Arr1()
{
    strcpy(array3[Count3 - 1], array1[Count1 - 1]);

    Count1++;
}

void Arr2()
{
    strcpy(array3[Count3 - 1], array2[Count2 - 1]);

    Count2++;
}