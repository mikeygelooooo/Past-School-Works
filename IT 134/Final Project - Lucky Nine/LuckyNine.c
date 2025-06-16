/*
Project in Computer Programming 1 (IT - 134)

BS Information Technology 1 - A

Created by: Michael Angelo A. Ochengco
*/

#include <stdio.h>
#include <stdlib.h>
#include <time.h>
#include <windows.h>
#include <unistd.h>

#define maxCards 2 // Player Cards Array Limit

// Main Screens
void loadingScreen();
void mainMenu();
void endingScreen();

// Loading Display
void dotsLoading();
void drawCardsLoading();

// Result Screens
void lucky9Screen();

void winScreen();
void lossScreen();
void drawScreen();

void playerAWin();
void playerBWin();

void balanceScreen();

// Game Mode Menu
void gameModes();

// Balance Function
void bank();
void betMenu();

// Card Randomizer
int randomCardGenerator();

// Result Check
int resultChecker(int result);
int lucky9Checker(int player1, int player2);

// Hirit Check
int hiritQuery();
int hiritChecker(int result);

// Play Mode
void playModeMachinery();

// Bet Mode
int betModeQuery();
void betModeMachinery();

// Guide Menu
void guideMenu();

void gameMechanics();
void playModeMechanics();
void betModeMechanics();

// Color FUnctions
void red();
void green();
void yellow();
void purple();
void cyan();
void resetColor();

// Choice Variables
int choiceFlag;
char choice;

// Balance Variables
double balance;
double deposit;
double bet;

// Bet Mode Variables
int betQueryFlag;
char betModeChoice;
int betModeGuess;
int betWinFlag;

// Result Variable
int resultFlag;

// String Variables
char drawLoading[] = "DRAWING CARDS";
char depositLoading[] = "DEPOSITING MONEY";
char hiritLoading[] = "DRAWING HIRIT CARDS";

void main(){
  srand(time(0));

  loadingScreen();

  mainMenu();
}

void loadingScreen(){
  system("cls");

  sleep(1);

  red();
  printf("\n .------..------..------..------..------.");
  printf("\n |L.--. ||U.--. ||C.--. ||K.--. ||Y.--. |");

  usleep(500000);

  printf("\n | :/\\: || (\\/) || :/\\: || :/\\: || (\\/) |");
  printf("\n | (__) || :\\/: || :\\/: || :\\/: || :\\/: |");

  usleep(500000);

  printf("\n | '--'L|| '--'U|| '--'C|| '--'K|| '--'Y|");
  printf("\n `------'`------'`------'`------'`------'");
  resetColor();

  sleep(1);

  cyan();
  printf("\n\n\n     .------..------..------..------.");
  printf("\n     |N.--. ||I.--. ||N.--. ||E.--. |");

  usleep(500000);

  printf("\n     | :(): || (\\/) || :(): || (\\/) |");
  printf("\n     | ()() || :\\/: || ()() || :\\/: |");

  usleep(500000);

  printf("\n     | '--'N|| '--'I|| '--'N|| '--'E|");
  printf("\n     `------'`------'`------'`------'\n\n\n");
  resetColor();

  sleep(2);
}

void mainMenu(){
  system("cls");

  printf("-----------------------------\n\n");
  purple();
  printf("       LUCKY - NINE\n\n");

  usleep(500000);

  printf("         MAIN MENU\n\n");
  resetColor();
  printf("-----------------------------\n\n");

  usleep(500000);

  green();
  printf(" Current Balance: %.2lf\n\n", balance);
  resetColor();
  printf("-----------------------------\n\n");

  usleep(500000);

  cyan();
  printf(" 1. PLAY\n");

  usleep(100000);

  printf(" 2. LUCKY BANK\n");

  usleep(100000);

  printf(" 3. HELP\n");
  resetColor();

  usleep(100000);
  
  red();
  printf(" 4. QUIT\n\n");
  resetColor();

  usleep(100000);

  printf("-----------------------------\n\n");

  do{
    usleep(500000);

    yellow();
    printf(" Choice Here: ");
    scanf(" %c", &choice);
    resetColor();

    if (choice == '1'){
      choiceFlag = 0;

      usleep(500000);

      gameModes();
    } else if (choice == '2'){
      choiceFlag = 0;

      usleep(500000);

      bank();
    } else if (choice == '3'){
      choiceFlag = 0;

      usleep(500000);

      guideMenu();
    } else if (choice == '4'){
      choiceFlag = 0;

      usleep(500000);

      endingScreen();
    } else {
      choiceFlag = 1;

      printf("\n-----------------------------\n\n");
      red();
      printf("       INVALID INPUT\n");
      resetColor();
      printf("\n-----------------------------\n\n");
    }
  } while (choiceFlag != 0);
}

void endingScreen(){
  loadingScreen();

  system("cls");

  printf("-----------------------------\n\n");
  red();
  printf(" Thank you for playing LUCKY-NINE!\n");
  resetColor();
  printf("\n-----------------------------\n\n");

  usleep(500000);

  yellow();
  printf(" PROJECT IN COMPUTER PROGRAMMING 1 (IT 134)\n\n");
  resetColor();

  usleep(500000);

  green();
  printf(" Created by: Michael Angelo A. Ochengco\n\n");
  resetColor();

  usleep(500000);

  cyan();
  printf(" Year & Section: BSIT 1A\n\n");
  resetColor();

  usleep(500000);

  purple();
  printf(" - boofenshmirtz\n\n");
  resetColor();
  
  printf("-----------------------------\n\n");

  sleep(1);

  system("pause");
}

void dotsLoading(){
  for (int bd = 0; bd < 5; bd++){
    usleep(500000);

    printf(" .");
  }
}

void drawCardsLoading(){
  system("cls");

  yellow();
  printf("\n\n\t");

  for (int dl = 0; dl <= strlen(drawLoading); dl++){
    usleep(100000);
    
    printf("%c", drawLoading[dl]);
  }

  resetColor();

  usleep(500000);
}

void lucky9Screen(){
  system("cls");

  printf("-----------------------------\n\n");
  purple();
  printf("         LUCKY NINE!\n\n");
  resetColor();
  printf("-----------------------------\n\n");

  sleep(2);
}

void winScreen(){
  system("cls");

  printf("-----------------------------\n\n");
  green();
  printf("          YOU WIN!\n\n");
  resetColor();
  printf("-----------------------------\n\n");

  sleep(2);
}

void lossScreen(){
  system("cls");

  printf("-----------------------------\n\n");
  red();
  printf("          YOU LOST!\n\n");
  resetColor();
  printf("-----------------------------\n\n");

  sleep(2);
}

void drawScreen(){
  system("cls");

  printf("-----------------------------\n\n");
  cyan();
  printf("            DRAW!\n\n");
  resetColor();
  printf("-----------------------------\n\n");

  sleep(2);
}

void playerAWin(){
  system("cls");

  printf("-----------------------------\n\n");
  cyan();
  printf("        PLAYER A WIN!\n\n");
  resetColor();
  printf("-----------------------------\n\n");

  sleep(2);
}

void playerBWin(){
  system("cls");

  printf("-----------------------------\n\n");
  green();
  printf("        PLAYER B WIN!\n\n");
  resetColor();
  printf("-----------------------------\n\n");

  sleep(2);
}

void balanceScreen(){
  system("cls");

  printf("-----------------------------\n\n");
  purple();
  printf("      CURRENT BALANCE\n\n");
  resetColor();
  printf("-----------------------------\n\n");

  usleep(500000);

  cyan();
  printf(" Money from previous round: %.2lf\n\n", balance);
  resetColor();

  if (resultFlag == 1){
    green();
    balance += bet;
  } else if (resultFlag == 2){
    red();
    balance -= bet;
  } else if (resultFlag == 3){
    green();
    balance += (bet * 3);
  } else if (resultFlag == 4){
    red();
    balance -= (bet * 3);
  } else if (resultFlag == 5){
    green();
    balance += (bet * 5);
  } else if (resultFlag == 6){
    red();
    balance -= (bet * 5);
  } else {
    yellow();
  }

  usleep(500000);
  
  printf(" Money after current round: %.2lf\n\n", balance);
  resetColor();
  printf("-----------------------------\n\n");

  sleep(1);

  yellow();
  printf(" Proceeding to the Main Menu");

  dotsLoading();

  resetColor();

  mainMenu();
}

void gameModes(){
  system("cls");

  printf("-----------------------------\n\n");
  purple();
  printf("         GAME MODES\n\n");
  resetColor();
  printf("-----------------------------\n\n");

  usleep(500000);

  cyan();
  printf(" 1. PLAY MODE\n");
  resetColor();

  usleep(500000);

  green();
  printf(" 2. BET MODE\n");
  resetColor();

  usleep(500000);

  red();
  printf(" 3. MAIN MENU\n\n");
  resetColor();

  usleep(500000);

  printf("-----------------------------\n\n");

  do{
    usleep(500000);

    yellow();
    printf(" Choice Here: ");
    scanf(" %c", &choice);
    resetColor();

    if (choice == '1'){
      choiceFlag = 0;

      usleep(500000);

      playModeMachinery();
    } else if (choice == '2'){
      choiceFlag = 0;

      usleep(500000);

      betModeMachinery();
    } else if (choice == '3'){
      choiceFlag = 0;

      usleep(500000);

      mainMenu();
    } else {
      choiceFlag = 1;

      printf("\n-----------------------------\n\n");
      red();
      printf("       INVALID INPUT\n");
      resetColor();
      printf("\n-----------------------------\n\n");
    }
  } while (choiceFlag != 0);
}

void bank(){
  system("cls");

  printf("-----------------------------\n\n");
  purple();
  printf("  Welcome to the LUCKY BANK!\n\n");

  usleep(500000);

  printf("    \"Ipusta mo na lahat\"\n\n");
  resetColor();
  printf("-----------------------------\n\n");
  
  do{
    usleep(500000);

    yellow();
    printf("       DEPOSIT CENTER\n\n");

    usleep(500000);

    printf(" Deposit money here: ");
    scanf("%lf", &deposit);
    resetColor();

    balance += deposit;

    if (deposit > 0){
      system("cls");

      usleep(500000);

      yellow();
      printf("\n\n\t");

      for (int dl = 0; dl <= strlen(depositLoading); dl++){
        usleep(100000);
    
        printf("%c", depositLoading[dl]);
      }

      resetColor();

      usleep(500000);

      system("cls");

      printf("-----------------------------\n\n");
      green();
      printf(" Current balance in bank: %.2lf\n", balance);

      usleep(500000);

      printf("\n Please enjoy wasting all this money!\n\n");
      resetColor();
      printf("-----------------------------\n\n");

      yellow();
      printf(" Proceeding to the Main Menu");

      dotsLoading();

      resetColor();

      usleep(500000);

      mainMenu();
    } else {
      printf("\n-----------------------------\n\n");
      red();
      printf("       INVALID INPUT\n");
      resetColor();
      printf("\n-----------------------------\n\n");
    }
  } while (balance < 0);
}

void betMenu(){
  system("cls");

  printf("-----------------------------\n\n");
  purple();
  printf("         BET MENU\n\n");
  resetColor();
  printf("-----------------------------\n\n");
  
  do{
    usleep(500000);

    yellow();
    printf(" How much do you want to bet?\n");

    usleep(100000);

    printf(" Enter amount: ");
    scanf("%lf", &bet);
    resetColor();

    usleep(500000);
    
    if (bet > balance){
      printf("\n-----------------------------\n\n");
      red();
      printf("     INSUFFICIENT BALANCE!\n");
      resetColor();
      printf("\n-----------------------------\n\n");

      usleep(500000);

      green();
      printf(" Current Balance: %.2lf\n", balance);
      resetColor();
      printf("\n-----------------------------\n\n");

      usleep(500000);

      yellow();
      printf(" Proceeding to the Bank");

      dotsLoading();

      resetColor();

      usleep(500000);

      bank();
    }
    
  } while (bet > balance);
  
}

int randomCardGenerator(){
  int randomCard = rand() % 9 + 1;

  return randomCard;
}

int resultChecker(int result){
  if (result >= 10 && result < 20){
    result -= 10;
  } else if (result >= 20 && result < 30){
    result -= 20;
  } else if (result >= 30){
    result -= 30;
  }
    
  return result;
}

int lucky9Checker(int player1, int player2){
  int lucky9Indicator;

  if (player1 == 9 || player2 == 9){
    lucky9Indicator = 1;
  } else {
    lucky9Indicator = 0;
  }
  
  return lucky9Indicator;
}

int hiritQuery(){
  int yesOrNo;

  system("cls");

  printf("-----------------------------\n\n");
  purple();
  printf("         HIRIT MODE\n\n");
  resetColor();
  printf("-----------------------------\n\n");
  
  do{
    usleep(500000);

    yellow();
    printf(" Hirit pa? [Y/N]: ");
    scanf(" %c", &choice);
    resetColor();

    if (choice == 'Y' || choice == 'y'){
      choiceFlag = 0;
      
      yesOrNo = 1;
    } else if (choice == 'N' || choice == 'n'){
      choiceFlag = 0;

      yesOrNo = 0;
    } else {
      choiceFlag = 1;

      printf("\n-----------------------------\n\n");
      red();
      printf("       INVALID INPUT\n");
      resetColor();
      printf("\n-----------------------------\n\n");
    }

  } while (choiceFlag != 0);

  return yesOrNo;
}

int hiritChecker(int result){
  int yesOrNo;

  if (result < 5){
    yesOrNo = 1;
  } else {
    yesOrNo = 0;
  }
  
  return yesOrNo;
}

void playModeMachinery(){
  betMenu();
  
  system("cls");

  printf("-----------------------------\n\n");
  purple();
  printf("        BET OVERVIEW\n\n");
  resetColor();
  printf("-----------------------------\n\n");

  usleep(500000);

  green();
  printf(" Current Balance: %.2lf\n\n", balance);

  usleep(100000);

  printf(" Bet Amount: %.2lf\n\n", bet);
  resetColor();
  printf("-----------------------------\n\n");

  usleep(500000);

  yellow();
  printf(" Proceeding to the Game");

  dotsLoading();

  resetColor();

  usleep(500000);

  drawCardsLoading();

  int playerCards[maxCards];
  int playerHirit = randomCardGenerator();
  int playerFlag;
  int playerResultTemp = 0;
  int playerResult;

  for (int pc = 0; pc < maxCards; pc++){
    playerCards[pc] = randomCardGenerator();

    playerResultTemp += playerCards[pc];
  }

  int bankerCards[maxCards];
  int bankerHirit = randomCardGenerator();
  int bankerResultTemp = 0;
  int bankerResult;

  for (int bc = 0; bc < maxCards; bc++){
    bankerCards[bc] = randomCardGenerator();

    bankerResultTemp += bankerCards[bc];
  }

  playerResult = resultChecker(playerResultTemp);
  bankerResult = resultChecker(bankerResultTemp);

  system("cls");

  if (lucky9Checker(bankerResult, playerResult) == 1){
    lucky9Screen();

    usleep(500000);

    red();
    printf("        Banker Cards\n\n");

    usleep(500000);

    printf(" Card 1: %d\n", bankerCards[0]);

    usleep(500000);

    printf(" Card 2: %d\n\n", bankerCards[1]);
    resetColor();
    printf("-----------------------------\n\n");

    usleep(500000);

    green();
    printf("        Player Cards\n\n");

    usleep(500000);

    printf(" Card 1: %d\n", playerCards[0]);

    usleep(500000);

    printf(" Card 2: %d\n\n", playerCards[1]);
    resetColor();
    printf("-----------------------------\n\n");

    sleep(1);

    yellow();
    printf(" Proceeding to the Results");

    dotsLoading();

    resetColor();

    if (playerResult == 9 && bankerResult == 9){
      resultFlag = 7;

      drawScreen();
    } else if (playerResult == 9){
      resultFlag = 3;

      winScreen();
    } else {
      resultFlag = 4;

      lossScreen();
    }
    
    balanceScreen();
  } else {
    printf("-----------------------------\n\n");
    red();
    printf("        Banker Cards\n\n");

    usleep(500000);

    printf(" Card 1: ???\n");

    usleep(500000);

    printf(" Card 2: ???\n\n");
    resetColor();
    printf("-----------------------------\n\n");

    usleep(500000);

    green();
    printf("        Player Cards\n\n");

    usleep(500000);

    printf(" Card 1: %d\n", playerCards[0]);

    usleep(500000);

    printf(" Card 2: %d\n\n", playerCards[1]);
    resetColor();
    printf("-----------------------------\n\n");

    sleep(1);

    yellow();
    printf(" Proceeding to the Next Round");

    dotsLoading();

    resetColor();

    playerFlag = hiritQuery();

    system("cls");

    usleep(500000);

    yellow();
    printf("\n\n\t");

    for (int hl = 0; hl <= strlen(hiritLoading); hl++){
      usleep(100000);
    
      printf("%c", hiritLoading[hl]);
    }

    resetColor();

    usleep(500000);

    system("cls");

    printf("-----------------------------\n\n");
    purple();
    printf("        FINAL RESULTS\n\n");
    resetColor();
    printf("-----------------------------\n\n");

    usleep(500000);

    red();
    printf("        Banker Cards\n\n");

    usleep(500000);

    printf(" Card 1: %d\n", bankerCards[0]);

    usleep(500000);

    printf(" Card 2: %d\n", bankerCards[1]);

    usleep(500000);

    if (hiritChecker(bankerResult) == 1){
      bankerResultTemp += bankerHirit;

      printf(" Hirit: %d\n\n", bankerHirit);
    } else {
      printf(" Hirit: None\n\n");
    }

    usleep(500000);

    bankerResult = resultChecker(bankerResultTemp);

    printf(" Banker Result: %d\n\n", bankerResult);
    resetColor();
    printf("-----------------------------\n\n");

    usleep(500000);

    green();
    printf("        Player Cards\n\n");

    usleep(500000);

    printf(" Card 1: %d\n", playerCards[0]);

    usleep(500000);

    printf(" Card 2: %d\n", playerCards[1]);

    usleep(500000);

    if (playerFlag == 1){
      playerResultTemp += playerHirit;

      printf(" Hirit: %d\n\n", playerHirit);
    } else {
      printf(" Hirit: None\n\n");
    }

    usleep(500000);
  
    playerResult = resultChecker(playerResultTemp);

    printf(" Player Result: %d\n\n", playerResult);
    resetColor();
    printf("-----------------------------\n\n");

    sleep(1);

    yellow();
    printf(" Proceeding to the Results");

    dotsLoading();

    resetColor();

    if (playerResult == bankerResult){
      resultFlag = 7;

      drawScreen();
    } else if (playerResult > bankerResult){
      resultFlag = 1;

      winScreen();
    } else {
      resultFlag = 2;

      lossScreen();
    }

    balanceScreen();
  }
}

int betModeQuery(){
  system("cls");

  printf("-----------------------------\n\n");
  purple();
  printf("      BETTING OPTIONS\n\n");
  resetColor();
  printf("-----------------------------\n\n");

  usleep(500000);

  cyan();
  printf(" 1. Player A\n");
  resetColor();

  usleep(100000);

  green();
  printf(" 2. Player B\n");
  resetColor();

  usleep(100000);

  yellow();
  printf(" 3. Draw\n\n");
  resetColor();
  printf("-----------------------------\n\n");
  
  do {
    usleep(500000);

    yellow();
    printf(" Choice Here: ");
    scanf(" %c", &betModeChoice);
    resetColor();

    if (betModeChoice == '1'){
      betQueryFlag = 1;

      choiceFlag = 0;
    } else if (betModeChoice == '2'){
      betQueryFlag = 2;

      choiceFlag = 0;
    } else if (betModeChoice == '3'){
      betQueryFlag = 3;

      choiceFlag = 0;
    } else {
      choiceFlag = 1;

      printf("\n-----------------------------\n\n");
      red();
      printf("       INVALID INPUT\n");
      resetColor();
      printf("\n-----------------------------\n\n");
    }
  } while (choiceFlag != 0);
  
  do {
    usleep(500000);

    printf("\n-----------------------------\n\n");
    yellow();
    printf(" LUCKY NINE? [Y/N]: ");
    scanf(" %c", &choice);
    resetColor();

    if (choice == 'Y' || choice == 'y'){
      betQueryFlag += 3;
      choiceFlag = 0;
    } else if (choice == 'N' || choice == 'n'){
      choiceFlag = 0;
    } else {
      choiceFlag = 1;

      printf("\n-----------------------------\n\n");
      red();
      printf("       INVALID INPUT\n");
      resetColor();
    }
  } while (choiceFlag != 0);

  system("cls");

  printf("-----------------------------\n\n");
  purple();
  printf("        BET OVERVIEW\n\n");
  resetColor();
  printf("-----------------------------\n\n");

  usleep(500000);

  green();
  printf(" Current Balance: %.2lf\n\n", balance);

  usleep(100000);

  if (betModeChoice == '1'){
    printf(" Current Guess: Player A\n\n");
  } else if (betModeChoice == '2'){
    printf(" Current Guess: Player B\n\n");
  } else if (betModeChoice == '3'){
    printf(" Current Guess: Draw\n\n");  
  }

  usleep(100000);

  printf(" Lucky Nine: %c\n\n", choice);

  usleep(100000);
  
  printf(" Bet Amount: %.2lf\n\n", bet);
  resetColor();
  printf("-----------------------------\n\n");

  usleep(500000);

  yellow();
  printf(" Proceeding to the Game");

  dotsLoading();

  resetColor();

  usleep(500000);

  return betQueryFlag;
}

void betModeMachinery(){
  betMenu();

  betModeGuess = betModeQuery();

  drawCardsLoading();

  int player1Cards[maxCards];
  int player1Hirit = randomCardGenerator();
  int player1ResultTemp = 0;
  int player1Result;

  for (int ac = 0; ac < maxCards; ac++){
    player1Cards[ac] = randomCardGenerator();

    player1ResultTemp += player1Cards[ac];
  }

  int player2Cards[maxCards];
  int player2Hirit = randomCardGenerator();
  int player2ResultTemp = 0;
  int player2Result;

  for (int bc = 0; bc < maxCards; bc++){
    player2Cards[bc] = randomCardGenerator();

    player2ResultTemp += player2Cards[bc];
  }

  player1Result = resultChecker(player1ResultTemp);
  player2Result = resultChecker(player2ResultTemp);

  system("cls");

  if (lucky9Checker(player1Result, player2Result) == 1){
    lucky9Screen();

    usleep(500000);

    cyan();
    printf("        Player A Cards\n\n");

    usleep(500000);

    printf(" Card 1: %d\n", player1Cards[0]);

    usleep(500000);

    printf(" Card 2: %d\n\n", player1Cards[1]);
    resetColor();
    printf("-----------------------------\n\n");

    usleep(500000);

    green();
    printf("        Player B Cards\n\n");

    usleep(500000);

    printf(" Card 1: %d\n", player2Cards[0]);

    usleep(500000);

    printf(" Card 2: %d\n\n", player2Cards[1]);
    resetColor();
    printf("-----------------------------\n\n");

    sleep(1);

    yellow();
    printf(" Proceeding to the Results");

    dotsLoading();

    resetColor();

    if (player1Result == 9 && player2Result == 9){
      betWinFlag = 6;

      drawScreen;
    } else if (player1Result == 9){
      betWinFlag = 4;

      playerAWin();
    } else {
      betWinFlag = 5;

      playerBWin();
    }

    if (betModeGuess > 3 && betModeGuess < 7){
      if(betModeGuess == betWinFlag){
        if (betModeGuess == 6){
          resultFlag = 5;

          winScreen();
        } else {
          resultFlag = 3;

          winScreen();
        }
      } else {
        if (betModeGuess == 6){
          resultFlag = 4;

          lossScreen();
        } else {
          resultFlag = 2;

          lossScreen();
        }
      }
    } else {
      if(betModeGuess == betWinFlag - 3){
        if (betModeGuess == 3){
          resultFlag = 3;

          winScreen();
        } else {
          resultFlag = 1;

          winScreen();
        }
      } else {
        if (betModeGuess == 3){
          resultFlag = 6;

          lossScreen();
        } else {
          resultFlag = 4;

          lossScreen();
        }
      }
    }
  } else {
    usleep(500000);

    printf("-----------------------------\n\n");
    cyan();
    printf("        Player A Cards\n\n");

    usleep(500000);

    printf(" Card 1: ???\n");

    usleep(500000);

    printf(" Card 2: ???\n\n");
    resetColor();
    printf("-----------------------------\n\n");

    usleep(500000);

    green();
    printf("        Player B Cards\n\n");

    usleep(500000);

    printf(" Card 1: ???\n");

    usleep(500000);

    printf(" Card 2: ???\n\n");
    resetColor();
    printf("-----------------------------\n\n");

    sleep(1);

    yellow();
    printf(" Proceeding to the Next Round");

    dotsLoading();

    resetColor();

    system("cls");

    usleep(500000);

    yellow();
    printf("\n\n\t");

    for (int hl = 0; hl <= strlen(hiritLoading); hl++){
      usleep(100000);
    
      printf("%c", hiritLoading[hl]);
    }

    resetColor();

    usleep(500000);

    system("cls");

    printf("-----------------------------\n\n");
    purple();
    printf("        FINAL RESULTS\n\n");
    resetColor();
    printf("-----------------------------\n\n");

    usleep(500000);

    cyan();
    printf("        Player A Cards\n\n");

    usleep(500000);

    printf(" Card 1: %d\n", player1Cards[0]);

    usleep(500000);

    printf(" Card 2: %d\n", player1Cards[1]);

    usleep(500000);

    if (hiritChecker(player1Result) == 1){
      player1ResultTemp += player1Hirit;

      printf(" Hirit: %d\n\n", player1Hirit);
    } else {
      printf(" Hirit: None\n\n");
    }

    player1Result = resultChecker(player1ResultTemp);

    printf(" Player A Result: %d\n\n", player1Result);
    resetColor();
    printf("-----------------------------\n\n");

    usleep(500000);

    cyan();
    printf("        Player B Cards\n\n");

    usleep(500000);

    printf(" Card 1: %d\n", player2Cards[0]);

    usleep(500000);

    printf(" Card 2: %d\n", player2Cards[1]);

    usleep(500000);

    if (hiritChecker(player2Result) == 1){
      player2ResultTemp += player2Hirit;

      printf(" Hirit: %d\n\n", player2Hirit);
    } else {
      printf(" Hirit: None\n\n");
    }

    player2Result = resultChecker(player2ResultTemp);

    printf(" Player B Result: %d\n\n", player2Result);
    resetColor();
    printf("-----------------------------\n\n");

    sleep(1);

    yellow();
    printf(" Proceeding to the Results");

    dotsLoading();

    resetColor();

    if (player1Result == player2Result){
      betWinFlag = 3;

      drawScreen();
    } else if (player1Result > player2Result){
      betWinFlag = 1;

      playerAWin();
    } else {
      betWinFlag = 2;

      playerBWin();
    }

    if (betModeGuess > 0 && betModeGuess < 4){
      if(betModeGuess == betWinFlag){
        if (betModeGuess == 3){
          resultFlag = 5;

          winScreen();
        } else {
          resultFlag = 3;

          winScreen();
        }
      } else {
        if (betModeGuess == 3){
          resultFlag = 4;

          lossScreen();
        } else {
          resultFlag = 2;

          lossScreen();
        }
      }
    } else {
      if(betModeGuess - 3 == betWinFlag){
        if (betModeGuess == 6){
          resultFlag = 3;

          winScreen();
        } else {
          resultFlag = 1;

          winScreen();
        }
      } else {
        if (betModeGuess == 6){
          resultFlag = 6;

          lossScreen();
        } else {
          resultFlag = 4;

          lossScreen();
        }
      }
    }
  }
  balanceScreen();
}

void guideMenu(){
  system("cls");

  printf("-----------------------------\n\n");
  purple();
  printf("          GUIDE MENU\n\n");
  resetColor();
  printf("-----------------------------\n\n");

  usleep(500000);

  cyan();
  printf(" 1. GAME MECHANICS\n");

  usleep(100000);

  printf(" 2. PLAY MODE MECHANICS\n");

  usleep(100000);

  printf(" 3. BET MODE MECHANICS\n");
  resetColor();

  usleep(100000);

  red();
  printf(" 4. MAIN MENU\n\n");
  resetColor();

  usleep(100000);

  printf("-----------------------------\n\n");

  do{
    usleep(500000);

    yellow();
    printf(" Choice Here: ");
    scanf(" %c", &choice);
    resetColor();

    if (choice == '1'){
      choiceFlag = 0;

      usleep(500000);

      gameMechanics();
    } else if (choice == '2'){
      choiceFlag = 0;

      usleep(500000);

      playModeMechanics();
    } else if (choice == '3'){
      choiceFlag = 0;

      usleep(500000);

      betModeMechanics();
    } else if (choice == '4'){
      choiceFlag = 0;

      usleep(500000);

      mainMenu();
    } else {
      choiceFlag = 1;

      printf("\n-----------------------------\n\n");
      red();
      printf("       INVALID INPUT\n");
      resetColor();
      printf("\n-----------------------------\n\n");
    }
  } while (choiceFlag != 0);
}

void gameMechanics(){
  system("cls");

  printf("-----------------------------\n\n");
  purple();
  printf("        GAME MECHANICS\n\n");
  resetColor();
  printf("-----------------------------\n\n");

  usleep(500000);

  cyan();
  printf(" - The primary goal of LUCKY-NINE is to get as close to the number 9 as possible\n");

  usleep(100000);

  printf(" - The secondary goal of the game is to have a bigger number than the opponent/s\n");

  usleep(100000);

  printf(" - The last digit of the sum of your cards is the number that is checked\n");

  usleep(100000);

  printf(" - Each player gets 2 cards at the first draw\n");

  usleep(100000);

  printf(" - If a player gets a result of 9 at the first draw, they win automatically\n");

  usleep(100000);

  printf(" - Each player has a chance to get an extra card or HIRIT if they need a bigger number\n");

  usleep(100000);

  printf(" - At the final reveal, the resulting numbers of the players get checked\n");

  usleep(100000);

  printf(" - If the player has a bigger number or 9, they win\n");

  usleep(100000);

  printf(" - If the player has a smaller number or 0, they lose\n");

  usleep(100000);

  printf(" - If both players have the same number, then it's a draw\n\n");
  resetColor();

  usleep(100000);

  printf("-----------------------------\n\n ");

  system("pause");

  guideMenu();
}

void playModeMechanics(){
  system("cls");

  printf("-----------------------------\n\n");
  purple();
  printf("     PLAY MODE MECHANICS\n\n");
  resetColor();
  printf("-----------------------------\n\n");

  usleep(500000);

  cyan();
  printf(" - First, you need to put in a bet for the round you will be playing in\n");

  usleep(100000);

  printf(" - You are up against an automated player or the BANKER\n");

  usleep(100000);

  printf(" - At the first draw, you are given 2 cards\n");

  usleep(100000);

  printf(" - The Banker's cards are hidden until the final reveal\n");

  usleep(100000);

  printf(" - At the hirit round, you get the choice to ask for another card\n");

  usleep(100000);

  printf(" - The Hirit for the Banker is automated\n");

  usleep(100000);

  printf(" - The cards of both players are shown at the final reveal\n");

  usleep(100000);

  printf(" - Then, you will be shown the result of your bet\n\n");
  resetColor();

  usleep(500000);

  printf("-----------------------------\n\n");
  green();
  printf("       WINNINGS SYSTEM\n\n");

  usleep(100000);

  printf(" NORMAL WIN: BET amount will be added to your BALANCE\n");

  usleep(100000);

  printf(" NORMAL LOSS: BET amount will be deducted from your BALANCE\n\n");

  usleep(100000);

  printf(" LUCKY-NINE WIN/LOSS: BET amount will be multiplied by 3\n\n");

  usleep(100000);

  printf(" DRAW: Nothing changes\n\n");
  resetColor();

  usleep(100000);

  printf("-----------------------------\n\n ");

  system("pause");

  guideMenu();
}

void betModeMechanics(){
  system("cls");

  printf("-----------------------------\n\n");
  purple();
  printf("     BET MODE MECHANICS\n\n");
  resetColor();
  printf("-----------------------------\n\n");

  usleep(500000);

  cyan();
  printf(" - In Bet Mode, you are only a spectator on a game by 2 automated players\n");

  usleep(100000);

  printf(" - You will place a bet on your guess on the result of the game\n");

  usleep(100000);

  printf(" - You will guess the winner of the game, and if it is a Normal of a Lucky-Nine win\n");

  usleep(100000);

  printf(" - Guessing a Draw Result yields a higher risk and reward\n");

  usleep(100000);

  printf(" - Everything happens automatically, you only need to watch\n");

  usleep(100000);

  printf(" - If there is a Lucky-Nine result, the results will be shown automatically\n");

  usleep(100000);

  printf(" - At the first draw, both the players cards are hidden\n");

  usleep(100000);

  printf(" - The Hirit for both players is automated\n");

  usleep(100000);

  printf(" - The cards of both players are shown at the final reveal\n");

  usleep(100000);

  printf(" - Then, you will be shown the result of your bet\n\n");
  resetColor();

  usleep(500000);

  printf("-----------------------------\n\n");
  green();
  printf("       WINNINGS SYSTEM\n\n");

  usleep(100000);

  printf(" PLAYER CHOICE / RESULT CORRECT GUESS: BET amount will be added to your BALANCE\n");

  usleep(100000);

  printf(" PLAYER CHOICE & RESULT CORRECT / INCORRECT GUESS: BET amount will be multiplied by 3\n\n");

  usleep(100000);

  printf(" DRAW CHOICE / RESULT CORRECT / INCORRECT GUESS: BET amount will be multiplied by 3\n");

  usleep(100000);

  printf(" DRAW CHOICE & RESULT CORRECT / INCORRECT GUESS: BET amount will be multiplied by 5\n\n");
  resetColor();

  usleep(100000);

  printf("-----------------------------\n\n ");

  system("pause");

  guideMenu();
}

void red(){
  printf("\033[1;31m");
}

void green(){
  printf("\033[0;32m");
}

void yellow(){
  printf("\033[1;33m");
}

void purple(){
  printf("\033[0;35m");
}

void cyan(){
  printf("\033[0;36m");
}

void resetColor(){             

  printf("\033[0m");
}