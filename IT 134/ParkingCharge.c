#include <stdio.h>
#include <stdlib.h>

int main(){

    float hours;
    float charge;

    printf("Input the number of parking hours: ");
    scanf("%f", &hours);

    if(hours > 0.0 && hours <= 3.0){
        charge = hours * 50.0;
        printf("Parking Fee: Php %.2f", charge);
    } else if(hours > 3.0 && hours <= 6.0){
        charge = hours * 35.0;
        printf("Parking Fee: Php %.2f", charge);
    } else if(hours > 6.0 && hours <= 12.0){
        charge = hours * 20.0;
        printf("Parking Fee: Php %.2f", charge);
    } else if(hours > 12.0){
        charge = hours * 10.0;
        printf("Parking Fee: Php %.2f", charge);
    } else
        printf("Invalid Input!\n\n");

    return 0;
}