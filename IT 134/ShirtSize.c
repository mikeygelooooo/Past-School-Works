#include <stdio.h>
#include <stdlib.h>

int main(){

    char size;

    printf("Input shirt size here: ");
    scanf("%c", &size);

//If-else Statement

    if (size == 's' || size == 'S') {
        printf("Your shirt size is SMALL!");
    } else if (size == 'm' || size == 'M') {
        printf("Your shirt size is MEDIUM!");
    } else if (size == 'l' || size == 'L') {
        printf("Your shirt size is LARGE!");
    } else if (size == 'x' || size == 'X') {
        printf("Your shirt size is EXTRA-LARGE!");
    } else {
        printf("Invalid Input");
    }

//Switch-case Statement

    switch(size){
    case 's': case 'S':
        printf("Your shirt size is SMALL");
        break;

    case 'm': case 'M':
        printf("Your shirt size is MEDIUM");
        break;

    case 'l': case 'L':
        printf("Your shirt size is LARGE");
        break;

    case 'x': case 'X':
        printf("Your shirt size is EXTRA-LARGE");
        break;

    default:
        printf("Invalid Input");
        break;
    }
    return 0;
}