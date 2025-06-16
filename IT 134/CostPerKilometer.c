#include <stdio.h>
#include <stdlib.h>

int main(){
    float km;
    float cost;
    printf("Input Distance Traveled in Kilometers: ");
    scanf("%f", &km);
    if (km >= 0.0 && km <= 10.0) {
        cost = km * 5.0;
        printf("The cost for %.2f kilometers traveled will be: %.2f", km, cost);
    } else if (km >= 10.1 && km <= 50.0) {
        cost = km * 8.0;
        printf("The cost for %.2f kilometers traveled will be: %.2f", km, cost);
    } else if (km >= 50.1 && km <= 99.99) {
        cost = km * 10.0;
        printf("The cost for %.2f kilometers traveled will be: %.2f", km, cost);
    } else if (km >= 100.0) {
        cost = km * 12.0;
        printf("The cost for %.2f kilometers traveled will be: %.2f", km, cost);
    } else {
        printf("Invalid Input");
    }


    return 0;
}