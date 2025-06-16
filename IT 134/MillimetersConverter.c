#include <stdio.h>
#include <stdlib.h>

int main(){
    float mm;

    printf("Input Millimeters Here: ");
    scanf("%f", &mm);
    float feet;
    float miles;
    feet = mm / 304.8;
    miles = mm / 1609344;
    printf("Converted to Miles: %5f\n", miles);
    printf("Converted to Feet: %5f\n", feet);

    return 0;
}