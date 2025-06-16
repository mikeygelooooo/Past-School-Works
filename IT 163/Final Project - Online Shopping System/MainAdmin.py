from os import system
from time import sleep
import AccountCenter as AC
from InputAdmin import prodName, prodPrice, prodStock, amountSold, readProductStorage, writeProductStorage
from InputCustomer import readInventoryReport
from ScreensStore import storeSignAdmin, mainScreenAdmin, productCenterScreen, editProductScreen, inventoryCenterScreen, productCreationGuidelines, logOutScreen, errorMessage



product_list = []
purchase_list = []



class Store():
    def __init__(self, prod_name, prod_price, prod_stock):
        self.prod_name = prod_name
        self.prod_price = prod_price
        self.prod_stock = prod_stock
        
    def addProduct(self):
        storeSignAdmin()
        print("\t     ADDING ShopSmart PRODUCTS\n")
        print("=" * 50, "\n")
        productCreationGuidelines()
        print('   *Type -1 at the prompt to cancel the process*\n')
        print("=" * 50, "\n\n")
            
        new_product = productInput()
        
        if new_product == None:
            return None
        
        storeSignAdmin()
        print("\t     ADDING ShopSmart PRODUCTS\n")
        print("=" * 50, "\n")
        print("\t     PRODUCT ADDITON OVERVIEW\n")
        print(f" Product Name:\t\t{new_product[0]}")
        print(f" Product Price:\t\tPHP {new_product[1]:.2f}")
        print(f" Amount in Stock:\t{new_product[2]}\n")
        print("=" * 50, "\n\n")
        
        while True:
            confirm_prompt = input("\033[1A\033[K\tConfirm Product Addition [Y/N]: ")

            if confirm_prompt.upper() in "YN" and len(confirm_prompt) == 1:
                break
            else:
                errorMessage()
        
        if confirm_prompt in "nN":
            return None
        
        product_list.append(new_product)
        
        storeSignAdmin()
        print("       SUCCESSFULLY ADDED ShopSmart PRODUCTS\n")
        print("=" * 50, "\n\n")
        
        while True:
            view_prompt = input("\033[1A\033[K\tView ShopSmart Product Database? [Y/N]: ")
            
            if view_prompt.upper() in "YN" and len(view_prompt) == 1:
                break
            else:
                errorMessage()
                
        if view_prompt in "Yy":
            admin.viewProduct()
            system("pause")
         
    def editProduct(self):
        self.viewProduct()
        
        if len(product_list) != 0:
            print("\t     EDITING ShopSmart PRODUCT\n")
            print("=" * 50, "\n")
            print('   *Type -1 at the prompt to cancel the process*\n')
            print("=" * 50, "\n\n")
            
            while True:
                try:
                    prod_id = int(input("\033[1A\033[K\tEnter product #: "))

                    if prod_id == -1:
                        return None
                    elif prod_id <= 0:
                        errorMessage()
                    elif prod_id > len(product_list):
                        sleep(0.5)
                        print("\033[1A\033[K\t      PRODUCT DOES NOT EXIST")
                        sleep(1.25)
                    else:
                        break
                except:
                    errorMessage()
            
            editProductScreen()
            print("\t     ShopSmart PRODUCT TO EDIT\n")
            print(f"Product Name:\t\t{product_list[prod_id - 1][0]}")
            print(f"Product Price:\t\tPHP {product_list[prod_id - 1][1]:.2f}")
            print(f"Amount in Stock:\t{product_list[prod_id - 1][2]}\n")
            print("=" * 50, "\n")
            print(" [P] - CHANGE ShopSmart PRODUCT PRICE")
            print(" [S] - ADD TO ShopSmart PRODUCT STOCK")
            print(" [X] - RETURN TO ShopSmart PRODUCT CENTER\n")
            print("=" * 50, "\n\n")
            
            while True:
                choice = input("\033[1A\033[K\tChoice: ")

                if choice.upper() in "PSX" and len(choice) == 1:
                    break
                else:
                    errorMessage()
                    
            editProductScreen()
            print("\t     ShopSmart PRODUCT TO EDIT\n")
            print(f" Product Name:\t\t{product_list[prod_id - 1][0]}")
            print(f" Product Price:\t\tPHP {product_list[prod_id - 1][1]:.2f}")
            print(f" Amount in Stock:\t{product_list[prod_id - 1][2]}\n")
            print("=" * 50, "\n")
            print('   *Type -1 at the prompt to cancel the process*\n')
            print("=" * 50, "\n")
                    
            if choice in "pP":
                new_detail = prodPrice()
                
                if new_detail == None:
                    return None
                
                edited_product = (product_list[prod_id - 1][0], new_detail, product_list[prod_id - 1][2])
            elif choice in "sS":
                new_detail = prodStock()
                
                if new_detail == None:
                    return None
                
                edited_product = (product_list[prod_id - 1][0], product_list[prod_id - 1][1], product_list[prod_id - 1][2] + new_detail)
            elif choice in "xX":
                return None
            
            editProductScreen()
            print("\t    ORIGINAL ShopSmart PRODUCT\n")
            print(f" Product Name:\t\t{product_list[prod_id - 1][0]}")
            print(f" Product Price:\t\tPHP {product_list[prod_id - 1][1]:.2f}")
            print(f" Amount in Stock:\t{product_list[prod_id - 1][2]}")
            print("\n" + "-" * 50)
            print("\n\t     EDITED ShopSmart PRODUCT\n")
            print(f" Product Name:\t\t{edited_product[0]}")
            print(f" Product Price:\t\tPHP {edited_product[1]:.2f}")
            print(f" Amount in Stock:\t{edited_product[2]}\n")
            print("=" * 50, "\n\n")
            
            while True:
                confirm_prompt = input("\033[1A\033[K\tConfirm Product Edit [Y/N]: ")

                if confirm_prompt.upper() in "YN" and len(confirm_prompt) == 1:
                    break
                else:
                    errorMessage()
            
            if confirm_prompt in "nN":
                return None
            
            product_list[prod_id - 1] = edited_product
            
            storeSignAdmin()
            print("      SUCCESSFULLY EDITED ShopSmart PRODUCT\n")
            print("=" * 50, "\n\n")
            
            while True:
                view_prompt = input("\033[1A\033[K\tView ShopSmart Product Database? [Y/N]: ")
                
                if view_prompt.upper() in "YN" and len(view_prompt) == 1:
                    break
                else:
                    errorMessage()
                    
            if view_prompt in "Yy":
                admin.viewProduct()
                system("pause")
        
        else:
            system("pause")
                
    def viewProduct(self):
        storeSignAdmin()
        print("\t    ShopSmart PRODUCT DATABASE\n")
        print("=" * 50)
        
        if len(product_list) == 0:
            print("\n\t\t  WOW SUCH EMPTY\n")
            print("=" * 50, "\n")
        elif len(product_list) != 0:
            for prod in product_list:
                print(f"\n\t\t    PRODUCT # {product_list.index(prod) + 1}\n")
                
                print(f" Product Name:\t\t{prod[0]}")
                print(f" Product Price:\t\tPHP {prod[1]:.2f}")
                print(f" Amount in Stock:\t{prod[2]}")
                
                if product_list.index(prod) != len(product_list) - 1:
                    print("\n" + "-" * 50)
                    
            print("\n" + "=" * 50, "\n")
    
    

admin = Store(None, None, None)



def adminMode():
    global product_list
    global purchase_list
    
    product_list = []
    product_list = readProductStorage(product_list)
        
    purchase_list = []
    purchase_list = readInventoryReport(purchase_list)
    
    mainScreenAdmin()
    
    while True:
        choice = input("\033[1A\033[K\tChoice: ")

        if choice.upper() in "PCIX" and len(choice) == 1:
            break
        else:
            errorMessage()
            
    if choice in "pP":
        productCenter()
    elif choice in "cC":
        AC.customerList()
    elif choice in "iI":
        inventoryCenter()
    elif choice in "xX":
        logOutScreen()
        
        while True:
            exit_prompt = input("\033[1A\033[K\tAre you sure? [Y/N]: ")

            if exit_prompt.upper() in "YN" and len(exit_prompt) == 1:
                break
            else:
                errorMessage()

        if exit_prompt in "yY":
            return None
        elif exit_prompt in "nN":
            pass
            
    adminMode()
    
    

def productCenter():
    productCenterScreen()
    
    while True:
        choice = input("\033[1A\033[K\tChoice: ")

        if choice.upper() in "AEVM" and len(choice) == 1:
            break
        else:
            errorMessage()
            
    if choice in "aA":
        admin.addProduct()
        writeProductStorage(product_list)
    elif choice in "eE":
        admin.editProduct()
        writeProductStorage(product_list)
    elif choice in "vV":
        admin.viewProduct()
        system("pause")
    elif choice in "mM":
        return None
    
    productCenter()



def inventoryCenter():
    inventoryCenterScreen()
    
    while True:
        choice = input("\033[1A\033[K\tChoice: ")

        if choice.upper() in "IPM" and len(choice) == 1:
            break
        else:
            errorMessage()
            
    if choice in "iI":
        viewInventory()
    elif choice in "pP":
        purchaseHistory()
    elif choice in "mM":
        return None
    
    inventoryCenter()



def viewInventory():
    storeSignAdmin()
    print("\t    ShopSmart INVENTORY REPORT\n")
    print("=" * 50)
    
    if len(product_list) == 0:
        print("\n\t\t  WOW SUCH EMPTY\n")
        print("=" * 50, "\n")
    elif len(product_list) != 0:
        for prod in product_list:
            amount_sold = amountSold(product_list.index(prod), purchase_list)
            
            print(f"\n\t\t    PRODUCT # {product_list.index(prod) + 1}\n")
            
            print(f" Product Name:\t\t{prod[0]}\n")
            print(f" Original Stock:\t{amount_sold + prod[2]}")
            print(f" Amount Sold:\t\t{amount_sold}")
            print(f" Current Stock:\t\t{prod[2]}")
            
            if product_list.index(prod) != len(product_list) - 1:
                print("\n" + "-" * 50)
                
        print("\n" + "=" * 50, "\n")
        
    system("pause")



def purchaseHistory():
    storeSignAdmin()
    print("\t    ShopSmart PURCHASE HISTORY\n")
    print("=" * 50)
    
    if len(purchase_list) == 0:
        print("\n\t\t  WOW SUCH EMPTY\n")
        print("=" * 50, "\n")
    elif len(product_list) != 0:
        count = 0
        
        for order in purchase_list:
            print(f"\n\t\t    PURCHASE # {count + 1}\n")
            
            print(f" Username:\t\t{order[0]}\n")
            print(f" Product Name:\t\t{order[2]}")
            print(f" Product Price:\t\tPHP {order[4] / order[3]:.2f}\n")
            print(f" Order Quantity:\t{order[3]}\n")
            print(f" Purchase Total:\tPHP {order[4]:.2f}\n")
            print(f" Amount Paid:\t\tPHP {order[5]:.2f}")
            print(f" Change Received:\tPHP {order[6]:.2f}")
            
            if count != len(purchase_list) - 1:
                print("\n" + "-" * 50)
                
            count += 1
                
        print("\n" + "=" * 50, "\n")
        
    system("pause")



def productInput():
    prod_name_input = prodName(product_list)
    
    if prod_name_input == None:
            return None
        
    prod_price_input = prodPrice()
    
    if prod_price_input == None:
            return None
        
    prod_stock_input = prodStock()
    
    if prod_stock_input == None:
            return None
    
    new_product_input = Store(prod_name_input, prod_price_input, prod_stock_input)
    
    new_record_input = (new_product_input.prod_name, new_product_input.prod_price, new_product_input.prod_stock)
    
    return new_record_input