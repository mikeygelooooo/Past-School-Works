from os import system
from time import sleep



def storeSign():
    system("cls")
    
    print("=" * 50)
    print("\n       - - - ShopSmart Online Shopping - - -\n")
    print("=" * 50, "\n")
    
    

def storeSignAdmin():
    system("cls")
    
    print("=" * 50)
    print("\n       - - - ShopSmart Online Shopping - - -\n")
    print("\t        (ADMINISTRATOR MODE)\n")
    print("=" * 50, "\n")
    
    
    
def mainScreen():
    storeSign()
    
    print('\t  "Clever Shopping Made Simple"\n')
    print("=" * 50, "\n")
    print(" [L] - LOG-IN to ShopSmart Online Shopping")
    print(" [S] - SIGN-UP for a ShopSmart Account")
    print(" [X] - EXIT ShopSmart OnlineShopping\n")
    print("=" * 50 + "\n\n")
    
    
    
def mainScreenAdmin():
    storeSignAdmin()
    
    print(" [P] - ShopSmart PRODUCT CENTER")
    print(" [C] - ShopSmart CUSTOMER DATABASE")
    print(" [I] - ShopSmart INVENTORY CENTER")
    print(" [X] - RETURN TO ShopSmart LOG-IN MENU\n")
    print("=" * 50 + "\n\n")
    
    
    
def productCenterScreen():
    system("cls")
    
    print("=" * 50)
    print("\n       - - - ShopSmart Online Shopping - - -\n")
    print("\t\t  (PRODUCT CENTER)\n")
    print("=" * 50, "\n")
    
    print(" [A] - ADD ShopSmart PRODUCTS")
    print(" [E] - EDIT ShopSmart PRODUCTS")
    print(" [V] - VIEW ShopSmart PRODUCTS")
    print(" [M] - RETURN TO ShopSmart ADMINISTRATION MENU\n")
    print("=" * 50 + "\n\n")
    
    
    
def editProductScreen():
    system("cls")
    
    print("=" * 50)
    print("\n       - - - ShopSmart Online Shopping - - -\n")
    print("\t\t  (PRODUCT CENTER)\n")
    print("=" * 50, "\n")
    print("\t    EDITING ShopSmart PRODUCTS\n")
    print("=" * 50, "\n")
    
    
    
def inventoryCenterScreen():
    system("cls")
    
    print("=" * 50)
    print("\n       - - - ShopSmart Online Shopping - - -\n")
    print("\t\t (INVENTORY CENTER)\n")
    print("=" * 50, "\n")
    
    print(" [I] - VIEW ShopSmart INVENTORY")
    print(" [P] - VIEW ShopSmart PURCHASE HISTORY")
    print(" [M] - RETURN TO ShopSmart ADMINISTRATION MENU\n")
    print("=" * 50 + "\n\n")
    
    
    
def productCreationGuidelines():
    print("       ShopSmart Product Creation Guidelines\n")
    print("- Product names are permanent")
    print("- Product names must not have spaces or symbols")
    print("- Product names must be at least 3 characters long")
    print("- Replace spaces with a dash\n")
    print("=" * 50, "\n")
    
    
    
def mainScreenCustomer(un):
    storeSign()
    
    print(f" Shop Cleverly & Shop Smartly [{un}]!\n")
    print("=" * 50, "\n")
    print(" [B] - BUY ShopSmart PRODUCTS")
    print(" [V] - VIEW ShopSmart PRODUCTS")
    print(f" [H] - [{un}] PURCHASE HISTORY")
    print(" [E] - ShopSmart ACCOUNT CENTER")
    print(" [X] - LOG-OUT of ShopSmart Online Shopping\n")
    print("=" * 50 + "\n\n")
    
    
    
def logOutScreen():
    storeSign()
    
    print("     LOGGING OUT of ShopSmart Online Shopping\n")
    print("=" * 50, "\n\n")



def errorMessage():
    sleep(0.5)
    print("\033[1A\033[K\t\t  INVALID INPUT")
    sleep(1.25)