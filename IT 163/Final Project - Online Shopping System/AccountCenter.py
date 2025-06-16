from os import system, getcwd
from time import sleep
from string import ascii_uppercase, digits, punctuation
from MainAdmin import adminMode
from MainCustomer import customerMode
from InputCustomer import readInventoryReport
from ScreensStore import storeSign, storeSignAdmin, errorMessage



class Account:
    def __init__(self, username, password, address, contact_no):
        self.username = username
        self.password = password
        self.address = address
        self.contact_no = contact_no



account_list = []
purchase_list = []



def readAccountStorage(acc_storage):
    acc_list = []
    
    get_file_path = getcwd()
    
    create_file_path = f"{get_file_path}\\Text Files"
    
    read_acc_list = open(f"{create_file_path}\\account_list.txt", "r")
    read_account = read_acc_list.readline()

    while read_account != "":
        account_details = read_account.split()
        
        acc_list.append((account_details[0], account_details[1], account_details[2], account_details[3]))
        
        read_account = read_acc_list.readline()
        
    read_acc_list.close()
    
    acc_storage = acc_list
    
    return acc_storage



def writeAccountStorage(acc_storage):
    get_file_path = getcwd()
        
    create_file_path = f"{get_file_path}\\Text Files"
    
    write_acc_list = open(f"{create_file_path}\\account_list.txt", "w")
    
    for account_details in acc_storage:
        write_to_file = f"{account_details[0]} {account_details[1]} {account_details[2]} {account_details[3]}\n"
        
        write_acc_list.write(write_to_file)
        
    write_acc_list.close()



def login():
    global account_list
    
    if len(account_list) == 0:
        account_list = readAccountStorage(account_list)
        
    storeSign()
    print("\tLOG-IN TO ShopSmart Online Shopping\n")
    print("=" * 50, "\n")
    print('   *Type -1 at the prompt to cancel the process*\n')
    print("=" * 50, "\n\n")
    
    while True:
        username_input = input("\033[1A\033[K\tEnter Username: ")
        
        if username_input == "-1":
            return None
        elif username_input == "adminSS" or [un for un in account_list if un[0] == username_input]:
            break
        else:
            sleep(0.5)
            print("\033[1A\033[K\t\tUSER DOES NOT EXIST")
            sleep(1.25)
    
    print()
    
    while True:
        password_input = input("\033[1A\033[K\tEnter Password: ")
        
        if password_input == "-1":
            return None
        elif username_input == "adminSS" and password_input == "ShopSmart123":
            adminMode()
            break
        elif [un for un in account_list if un[0] == username_input and un[1] == password_input]:
            customerMode(username_input)
            break
        else:
            sleep(0.5)
            print("\033[1A\033[K\t\tINCORRECT PASSWORD")
            sleep(1.25)


def signup():
    global account_list
    
    account_list = []
    account_list = readAccountStorage(account_list)
        
    storeSign()
    print("\tCREATE YOUR OWN ShopSmart ACCOUNT\n")
    print("=" * 50, "\n")
    print(" \t    Account Creation Guidelines\n")
    print("- Usernames are permanent and cannot be changed")
    print("- Usernames must not have spaces or symbols")
    print("- Usernames must be at least 3 characters long")
    print("- Addresses must not have spaces or symbols")
    print("- Addresses must be at least 3 characters long")
    print("- Replace spaces with a dash")
    print("- Contact Numbers must be 11 digits long")
    print("- Passwords must be at least 8 characters long")
    print("- Passwords must have at least 1 uppercase letter")
    print("- Passwords must have at least 1 number\n")
    print("=" * 50, "\n")
    print('   *Type -1 at the prompt to cancel the process*\n')
    print("=" * 50, "\n\n")
    
    while True:
        invalid_username = 0
        
        new_username = input("\033[1A\033[K\tEnter Username: ")
        
        if new_username == "-1":
            return None
        
        for i in new_username:
            if i in punctuation or i == " ":
                invalid_username += 1
                
        if invalid_username != 0 or len(new_username) < 3:
            sleep(0.5)
            print("\033[1A\033[K\t\t INVALID USERNAME")
            sleep(1.25)
        elif new_username == "adminSS" or [un for un in account_list if un[0] == new_username]:
            sleep(0.5)
            print("\033[1A\033[K\t        USER ALREADY EXISTS")
            sleep(1.25)
        else:
            break
        
    print("\n")
    
    while True:
        invalid_address = 0
        
        new_address = input("\033[1A\033[K\tEnter Address: ")
        
        if new_address == "-1":
            return None
        
        for i in new_address:
            if i in [punc for punc in punctuation if punc != "-"] or i == " ":
                invalid_address += 1
                
        if invalid_address != 0 or len(new_address) < 3:
            sleep(0.5)
            print("\033[1A\033[K\t\t INVALID ADDRESS")
            sleep(1.25)
        else:
            break
        
    print()
    
    while True:
        invalid_conact_no = 0
        
        new_contact_no = input("\033[1A\033[K\tEnter Contact Number: ")
        
        if new_contact_no == "-1":
            return None
        
        for i in new_contact_no:
            if i not in digits:
                invalid_conact_no += 1
                
        if invalid_conact_no != 0 or len(new_contact_no) != 11:
            sleep(0.5)
            print("\033[1A\033[K\t       INVALID CONTACT NUMBER")
            sleep(1.25)
        elif [un for un in account_list if un[3] == new_contact_no]:
            sleep(0.5)
            print("\033[1A\033[K\t    CONTACT NUMBER ALREADY USED")
            sleep(1.25)
        else:
            break
    
    print("\n")
    
    while True:
        uppercase_true = 0
        numbers_true = 0
        
        new_password = input("\033[1A\033[K\tEnter Password: ")
        
        if new_password == "-1":
            return None
        
        for i in new_password:
            if i in ascii_uppercase:
                uppercase_true += 1
        
        for i in new_password:
            if i in digits:
                numbers_true += 1
                
        if uppercase_true != 0 and numbers_true != 0 and len(new_password) >= 8:
            break
        else:
            sleep(0.5)
            print("\033[1A\033[K\t\t INVALID PASSWORD")
            sleep(1.25)
            
    print()
    
    while True:
        confirm_password = input("\033[1A\033[K\tConfirm Password: ")
            
        if confirm_password == "-1":
            return None
        
        if confirm_password == new_password:
            break
        else:
            sleep(0.5)
            print("\033[1A\033[K\t      PASSWORDS DON'T MATCH")
            sleep(1.25)
            
    storeSign()
    print("\t       NEW ACCOUNT OVERVIEW\n")
    print("=" * 50, "\n")
    print(f" Username:\t\t{new_username}\n")
    print(f" Address:\t\t{new_address.title()}")
    print(f" Contact Number:\t{new_contact_no}\n")
    print(f" Password:\t\t{new_password}\n")
    print("=" * 50, "\n\n")
    
    while True:
        confirm_prompt = input("\033[1A\033[K\tCreate Account? [Y/N]: ")

        if confirm_prompt.upper() in "YN" and len(confirm_prompt) == 1:
            break
        else:
            errorMessage()
            
    if confirm_prompt in "nN":
        return None
    
    storeSign()
    print("      SUCCESSFULLY CREATED ShopSmart ACCOUNT\n")
    print("=" * 50, "\n\n")
    
    new_account = Account(new_username, new_password, new_address.title(), new_contact_no)
    
    account_list.append((new_account.username, new_account.password, new_account.address.title(), new_account.contact_no))
    
    writeAccountStorage(account_list)
    
    while True:
        login_prompt = input("\033[1A\033[K\tProceed to Log-In Center? [Y/N]: ")

        if login_prompt.upper() in "YN" and len(login_prompt) == 1:
            break
        else:
            errorMessage()
        
    if login_prompt in "yY":
        login()
    


def customerList():
    global purchase_list
    global account_list
    
    purchase_list = []
    purchase_list = readInventoryReport(purchase_list)
    
    account_list = []
    account_list = readAccountStorage(account_list)
        
    storeSignAdmin()
    print("\t    ShopSmart CUSTOMER DATABASE\n")
    print("=" * 50)
    
    if len(account_list) == 0:
        print("\n\t\t  WOW SUCH EMPTY\n")
        print("=" * 50, "\n")
    else:
        for acc in account_list:
            products_purchased = 0
            total_paid = 0
            
            for purchase in purchase_list:
                if purchase[0] == acc[0]:
                    products_purchased += purchase[3]
                    total_paid += purchase[4]
                    
            print(f"\n\t     ShopSmart CUSTOMER # {account_list.index(acc) + 7001}\n")
            
            print(f" Userame:\t\t\t{acc[0]}")
            print(f" Address:\t\t\t{acc[2]}")
            print(f" Contact Number:\t\t{acc[3]}\n")
            print(f" Total Products Purchased:\t{products_purchased}")
            print(f" Total Amount Paid:\t\tPHP {total_paid:.2f}")
            
            if account_list.index(acc) != len(account_list) - 1:
                print("\n" + "-" * 50)
                
        print("\n" + "=" * 50, "\n")
        
    system("pause")