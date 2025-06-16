#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#define MAX 100

int stack_size;
int stack[MAX];

int history_size;
int method_history[MAX][MAX];
int stack_history[MAX][MAX];

void printStack(int print_stack[MAX], int size) {
    int print_stack_space = 51;
    int reduce_space;
    int temp;

    if (size == 0){
        printf(" ------------------------------------------------- ║\n");
    } else {
        for (int i = 0; i < size; i++) {
            printf(" %d", print_stack[i]);

            reduce_space = 1;
            temp = print_stack[i];

            do {
                temp /= 10;
                
                ++reduce_space;
            } while (temp != 0);

            print_stack_space -= reduce_space;
        }

        for (int j = 0; j < print_stack_space; j++) {
            printf(" ");
        }

        printf("║\n");
    }
}

void printMethod(int method_used, int space_used, int null_check, int print_stack[MAX], int size, int element) {
    char push_print[MAX];
    snprintf(push_print, MAX, "push(%d)", print_stack[size-1]);

    char no_value[] = " ----------------------- ";

    if (method_used == 0) {
        printf("║%s║%s║", no_value, no_value);
    } else if (method_used == 1) {
        printf("║ %*-s║%s║", space_used, push_print, no_value);
    } else if (method_used == 2) {
        if (null_check == 0) {
            printf("║ pop()                   ║ %*-d║", space_used, element);
        } else if (null_check == 1) {
            printf("║ pop()                   ║ NULL                    ║");
        }
    }
}

void realTimeTable(int method, int null) {
    int space = 24;

    char is_empty[] = "FALSE";
    if (stack_size == 0) {
        strcpy(is_empty, "TRUE"); 
    }

    char no_value[] = " ----------------------- ";

    system("chcp 65001");

    system("cls");

    printf("╔═══════════════════════════════════════════════════╗\n");
    printf("║                 STACK  OPERATIONS                 ║\n");
    printf("║               by: Ochengco  BSIT 2B               ║\n");
    printf("║                 RECENT OPERATIONS                 ║\n");
    printf("╠═════════════════════════╦═════════════════════════╣\n");
    printf("║       METHOD USED       ║      RETURN  VALUE      ║\n");
    printf("╠═════════════════════════╬═════════════════════════╣\n");

    printMethod(method, space, null, stack, stack_size, stack[stack_size]);

    printf("\n╠═════════════════════════╬═════════════════════════╣\n");
    printf("║ isEmpty()               ║ %*-s║\n", space, is_empty);
    printf("╠═════════════════════════╬═════════════════════════╣\n");
    printf("║ size()                  ║ %*-d║\n", space, stack_size);
    printf("╠═════════════════════════╬═════════════════════════╣\n");

    if (stack_size == 0) {
        printf("║ top()                   ║ NULL                    ║\n");
    } else {
        printf("║ top()                   ║ %*-d║\n", space, stack[stack_size - 1]);
    }

    printf("╠═════════════════════════╩═════════════════════════╣\n");
    printf("║                  STACK  CONTENTS                  ║\n");
    printf("╠═══════════════════════════════════════════════════╣\n║");

    printStack(stack, stack_size);

    printf("╚═══════════════════════════════════════════════════╝\n");
}

void finalTable() {
    int method_print_space = 24;

    char no_value[] = " ----------------------- ";

    system("chcp 65001");

    system("cls");

    printf("╔═══════════════════════════════════════════════════════════════════════════════════════════════════════╗\n");
    printf("║                                           STACK  OPERATIONS                                           ║\n");
    printf("║                                         by: Ochengco  BSIT 2B                                         ║\n");
    printf("║                                          STACK EDIT  HISTORY                                          ║\n");
    printf("╠═════════════════════════╦═════════════════════════╦═══════════════════════════════════════════════════╣\n");
    printf("║       METHOD USED       ║      RETURN  VALUE      ║                  STACK  CONTENTS                  ║\n");
    printf("╠═════════════════════════╬═════════════════════════╬═══════════════════════════════════════════════════╣\n");

    for (int i = 0; i < history_size; i++) {
        printMethod(method_history[i][0], method_print_space, method_history[i][2], stack_history[i], method_history[i][3], method_history[i][1]);

        printStack(stack_history[i], method_history[i][3]);

        if (i == history_size - 1) {
            printf("╚═════════════════════════╩═════════════════════════╩═══════════════════════════════════════════════════╝\n");
        } else {
            printf("╠═════════════════════════╬═════════════════════════╬═══════════════════════════════════════════════════╣\n");
        }
    }
}

void addToStack(int method, int element, int null, int size) {
    int current_history[4] = {method, element, null, size};

    for (int i = 0; i < 4; i++) {
        method_history[history_size][i] = current_history[i];
    }

    for (int i = 0; i < stack_size; i++) {
        stack_history[history_size][i] = stack[i];
    }

    history_size++;
}

void pushElement() {
    int push_element;

    printf("\n ENTER INTEGER TO PUSH ONTO STACK: ");
    scanf("%d", &push_element);

    stack[stack_size] = push_element;

    stack_size++;

    addToStack(1, push_element, 0, stack_size);
}

void popElement() {
    int pop_element;

    stack_size--;
    
    pop_element = stack[stack_size];

    addToStack(2, pop_element, 0, stack_size);
}

int main() {
    int method_input = 0;
    int null_flag = 0;

    stack_size = 0;
    history_size = 0;

    do {
        realTimeTable(method_input, null_flag);

        printf("\n STACK EDITOR OPERATIONS\n");
        printf("   [1] PUSH AN ELEMENT\n");
        printf("   [2] POP AN ELEMENT\n");
        printf("   [3] EXIT STACK EDITOR\n");
        printf("\n CHOOSE OPERATION: ");
        scanf("%d", &method_input);

        if (method_input == 1){
            pushElement();
        }
        else if (method_input == 2) {
            if (stack_size == 0) {
                null_flag = 1;

                addToStack(2, 0, 1, 0);

                continue;
            } else {
                null_flag = 0;
                
                popElement();
            }
        }
    } while (method_input != 3);

    finalTable();

    return 0;
}