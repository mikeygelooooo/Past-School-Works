from os import system
import AccountCenter as AC
from InputAdmin import readProductStorage, writeProductStorage
from InputCustomer import productNumber, orderQuantity, paymentAmount, AddressInput, ContactNoInput, PasswordInput, readInventoryReport, writeInventoryReport
from ScreensStore import storeSign, mainScreenCustomer, logOutScreen, errorMessage



product_list = []
purchase_history = []
account_storage = []



def customerMode(username):
    global product_list
    global purchase_history
    global account_storage
    
    product_list = []
    product_list = readProductStorage(product_list)
        
    purchase_history = []
    purchase_history = readInventoryReport(purchase_history)
        
    account_storage = []
    account_storage = AC.readAccountStorage(account_storage)
    
    mainScreenCustomer(username)
    
    while True:
        choice = input("\033[1A\033[K\tChoice: ")

        if choice.upper() in "BVHEX" and len(choice) == 1:
            break
        else:
            errorMessage()
            
    if choice in "bB":
        buyProduct(username)
        writeProductStorage(product_list)
        writeInventoryReport(purchase_history)
    elif choice in "vV":
        viewProduct()
        system("pause")
    elif choice in "hH":
        purchaseHistory(username)
    elif choice in "eE":
        editAccount(username)
        AC.writeAccountStorage(account_storage)
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
    
    customerMode(username)
    
    
    
def buyProduct(un):
    account_index = [acc[0] for acc in account_storage].index(un)
    account_details = account_storage[account_index]
    
    viewProduct()
    print("\t     BUYING ShopSmart PRODUCTS\n")
    print("=" * 50, "\n")
    print('   *Type -1 at the prompt to cancel the process*\n')
    print("=" * 50, "\n\n")
        
    new_order = orderInput()
    
    if new_order == None:
        return None
    
    payment_details = paymentInput(new_order)
    
    if payment_details == None:
        return None
    
    new_receipt = receipt(un, new_order, payment_details)
    
    purchase_history.append(new_receipt)

    updated_stock = editStock(new_receipt)
    
    product_list[new_order[0] - 1] = updated_stock
    
    storeSign()
    print("\t    ShopSmart PURCHASE RECEIPT\n")
    print("=" * 50, "\n")
    print(f" Username:\t\t{new_receipt[0]}\n")
    print(f" Address:\t\t{account_details[2]}")
    print(f" Contact Number:\t{account_details[3]}\n")
    print(f" Product Name:\t\t{new_receipt[2]}")
    print(f" Product Price:\t\tPHP {product_list[new_receipt[1] - 1][1]:.2f}\n")
    print(f" Order Quantity:\t{new_receipt[3]}\n")
    print(f" Payment Total:\t\tPHP {new_receipt[4]:.2f}\n")
    print(f" Amount Paid:\t\tPHP {new_receipt[5]:.2f}")
    print(f" Change received:\tPHP {new_receipt[6]:.2f}\n")
    print("=" * 50, "\n")

    system("pause")
    
    
    
def viewProduct():
    storeSign()
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
    
    
    
def purchaseHistory(un):
    account_purchase = [order for order in purchase_history if order[0] == un]
    
    storeSign()
    print("\t    ShopSmart PURCHASE HISTORY\n")
    print("=" * 50)
    
    if len(account_purchase) == 0:
        print("\n\t\t  WOW SUCH EMPTY\n")
        print("=" * 50, "\n")
    elif len(product_list) != 0:
        count = 0
        for order in account_purchase:
            print(f"\n\t\t    PURCHASE # {count + 1}\n")

            print(f" Product Name:\t\t{order[2]}")
            print(f" Product Price:\t\tPHP {order[4] / order[3]:.2f}\n")
            print(f" Order Quantity:\t{order[3]}\n")
            print(f" Purchase Total:\tPHP {order[4]:.2f}\n")
            print(f" Amount Paid:\t\tPHP {order[5]:.2f}")
            print(f" Change Received:\tPHP {order[6]:.2f}")
            
            if count != len(account_purchase) - 1:
                print("\n" + "-" * 50)
                
            count += 1
                
        print("\n" + "=" * 50, "\n")
        
    system("pause")
    
    

def editAccount(un):
    account_index = [acc[0] for acc in account_storage].index(un)
    account_details = account_storage[account_index]
    storeSign()
    
    print("\t     ShopSmart ACCOUNT CENTER\n")
    print("=" * 50, "\n")
    print(f" Username:\t\t{account_details[0]}\n")
    print(f" Address:\t\t{account_details[2]}")
    print(f" Contact Number:\t{account_details[3]}\n")
    print(f" Password:\t\t{account_details[1]}\n")
    print("=" * 50, "\n")
    print(" [A] - EDIT ADDRESS")
    print(" [N] - EDIT CONTACT NUMBER")
    print(" [P] - EDIT PASSWORD")
    print(" [M] - RETURN TO ShopSmart MENU\n")
    print("=" * 50 + "\n\n")
    
    while True:
        choice = input("\033[1A\033[K\tChoice: ")

        if choice.upper() in "ANPM" and len(choice) == 1:
            break
        else:
            errorMessage()
            
    storeSign()
    
    print("\t     ShopSmart ACCOUNT CENTER\n")
    print("=" * 50, "\n")
    print(f" Username:\t\t{account_details[0]}\n")
    print(f" Address:\t\t{account_details[2]}")
    print(f" Contact Number:\t{account_details[3]}\n")
    print(f" Password:\t\t{account_details[1]}\n")
    print("=" * 50, "\n")
    
    if choice in "aA":
        print("- Addresses must not have spaces or symbols")
        print("- Addresses must be at least 3 characters long")
        print("- Replace spaces with a dash\n")
        print("=" * 50, "\n")
        print('   *Type -1 at the prompt to cancel the process*\n')
        print("=" * 50, "\n\n")
        
        new_detail = AddressInput()
        
        if new_detail == None:
            return None
        
        edited_account = (account_details[0], account_details[1], new_detail, account_details[3])
    elif choice in "nN":
        print("- Contact Numbers must be 11 digits long\n")
        print("=" * 50, "\n")
        print('   *Type -1 at the prompt to cancel the process*\n')
        print("=" * 50, "\n\n")
        
        new_detail = ContactNoInput(account_storage)
        
        if new_detail == None:
            return None
        
        edited_account = (account_details[0], account_details[1], account_details[2], new_detail)
    elif choice in "pP":
        print("- Passwords must be at least 8 characters long")
        print("- Passwords must have at least 1 uppercase letter")
        print("- Passwords must have at least 1 number")
        print("- New password must differ from the previous one\n")
        print("=" * 50, "\n")
        print('   *Type -1 at the prompt to cancel the process*\n')
        print("=" * 50, "\n\n")
        
        new_detail = PasswordInput(account_details[1])
        
        if new_detail == None:
            return None
        
        edited_account = (account_details[0], new_detail, account_details[2], account_details[3])
    elif choice in "mM":
        return None
    
    storeSign()
    
    print("\t     ShopSmart ACCOUNT CENTER\n")
    print("=" * 50, "\n")
    print("\tORIGINAL ShopSmart ACCOUNT DETAILS\n")
    print(f" Username:\t\t{account_details[0]}\n")
    print(f" Address:\t\t{account_details[2]}")
    print(f" Contact Number:\t{account_details[3]}\n")
    print(f" Password:\t\t{account_details[1]}\n")
    print("=" * 50, "\n")
    print("\t EDITED ShopSmart ACCOUNT DETAILS\n")
    print(f" Username:\t\t{edited_account[0]}\n")
    print(f" Address:\t\t{edited_account[2]}")
    print(f" Contact Number:\t{edited_account[3]}\n")
    print(f" Password:\t\t{edited_account[1]}\n")
    print("=" * 50, "\n\n")
    
    while True:
        confirm_prompt = input("\033[1A\033[K\tConfirm Edit [Y/N]: ")

        if confirm_prompt.upper() in "YN" and len(confirm_prompt) == 1:
            break
        else:
            errorMessage()
    
    if confirm_prompt in "nN":
        return None
    
    account_storage[account_index] = edited_account
    
    storeSign()
    print("\t     ShopSmart ACCOUNT CENTER\n")
    print("=" * 50, "\n")
    print("      SUCCESSFULLY EDITED ShopSmart ACCOUNT\n")
    print("=" * 50, "\n")
    
    system("pause")


def orderInput():
    product_no_input = productNumber(product_list)
    
    if product_no_input == None:
        return None
    
    order_quantity_input = orderQuantity(product_no_input, product_list)
    
    if order_quantity_input == None:
        return None
    
    new_order_input = (product_no_input, order_quantity_input)
    
    return new_order_input
    


def paymentInput(order_list):
    order_details = order_list
    
    prod_details = product_list[order_details[0] - 1]
    
    payment_total = prod_details[1] * order_list[1]
    
    storeSign()
    print("\t    ShopSmart PAYMENT SECTION\n")
    print("=" * 50, "\n")
    print("\t\t Purchase Details\n")
    print(f" Product Name:\t\t{prod_details[0]}")
    print(f" Product Price:\t\tPHP {prod_details[1]:.2f}\n")
    print(f" Order Quantity:\t{order_list[1]}\n")
    print(f" Purchase Total:\tPHP {payment_total:.2f}\n")
    print("=" * 50, "\n")
    print('   *Type -1 at the prompt to cancel the process*\n')
    print("=" * 50, "\n\n")
    
    payment_amount = paymentAmount(payment_total)
    
    if payment_amount == None:
        return None
    
    change_amount = payment_amount - payment_total
    
    payment_details = (payment_amount, change_amount)

    return payment_details



def receipt(username, order_list, payment_info):
    un = username
    
    prod_no = order_list[0]
    
    prod_details = product_list[prod_no - 1]
    prod_name = prod_details[0]
    prod_price = prod_details[1]
    
    ord_quantity = order_list[1]
    
    payment_total = prod_price * ord_quantity
    
    amount_paid = payment_info[0]
    change_received = payment_info[1]
    
    purchase = (un, prod_no, prod_name, ord_quantity, payment_total, amount_paid, change_received)
    
    return purchase



def editStock(receipt):
    purchase_info = receipt
    
    prod_no = purchase_info[1]
    ord_quantity = purchase_info[3]
    
    prod_to_edit = product_list[prod_no - 1]
    
    old_stock = prod_to_edit[2]
    
    new_stock = old_stock - ord_quantity
    
    new_info = (prod_to_edit[0], prod_to_edit[1], new_stock)
    
    return new_info