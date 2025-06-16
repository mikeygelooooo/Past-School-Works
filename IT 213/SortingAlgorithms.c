#include <stdio.h>

void PrintArray(int list[], int length) {
    for (int i = 0; i < length; i++) {
        printf("%d ", list[i]);
    }

    printf("\n");
}

void SelectionSort(int arr[], int size) {
	int min;
	int temp;

	for (int i = 0; i < size; i++) {
		min = i; // Set minimum to position i

        // Check the rest of the array to see if anything is smaller
		for (int j = i + 1; j < size; j++) {
			if (arr[j] < arr[min]) {
				min = j;
			}
		}
		
        // If the minimum isn't in the position, swap it
		if (i != min) {
			temp = arr[i];
            arr[i] = arr[min];
            arr[min] = temp;
		}

        PrintArray(arr, size);
	}
}

void InsertionSort(int arr[], int size) {
    int value; // The value currently being compared
    int i; // Index into unsorted section
    int j; // Index into sorted section

    for (i = 0; i < size; i++) {
        value = arr[i]; // Store the current value because it may shift later

        // Whenever the value in the sorted section is greater than the value in the unsorted section, shift all items in the sorted section over by one. This creates space in which to insert the value
        for (j = i - 1; j > -1 && arr[j] > value; j--) {
            arr[j + 1] = arr[j];
        }

        arr[j + 1] = value;

        PrintArray(arr, size);
    }
}

int main() {
    int given[] = {5, 4, 6, 3, 1, 2};
    int len = sizeof(given)/sizeof(given[0]);

    SelectionSort(given, len);
	return 0;
}