from os import getcwd
from time import sleep
from string import punctuation, digits, ascii_uppercase
from ScreensStore import errorMessage



def productNumber(prod_storage):
    while True:
        try:
            prod_id = int(input("\033[1A\033[K\tEnter Product Number: "))

            if prod_id == -1:
                return None
            elif prod_id <= 0:
                errorMessage()
            elif prod_id > len(prod_storage):
                sleep(0.5)
                print("\033[1A\033[K\t       PRODUCT DOES NOT EXIST")
                sleep(1.25)
            elif prod_storage[prod_id - 1][2] == 0:
                sleep(0.5)
                print("\033[1A\033[K\t\tPRODUCT IS SOLD OUT")
                sleep(1.25)
            else:
                break
        except:
            errorMessage()
            
    return prod_id
            
            
    
def orderQuantity(prod_id, prod_storage):
    print()
    
    while True:
        try:
            ord_quantity = int(input("\033[1A\033[K\tEnter Order Amount: "))

            if ord_quantity == -1:
                return None
            elif ord_quantity <= 0:
                errorMessage()
            elif ord_quantity > prod_storage[prod_id - 1][2]:
                sleep(0.5)
                print("\033[1A\033[K\t     NOT ENOUGH PRODUCT STOCK")
                sleep(1.25)
            else:
                break
        except:
            errorMessage()
            
    return ord_quantity



def paymentAmount(total):
    while True:
        try:
            payment_input = float(input("\033[1A\033[K\tEnter Payment Amount: "))
            
            if payment_input == -1:
                return None
            
            if payment_input < 0 or payment_input < total:
                errorMessage()
            else:
                break
            
        except:
            errorMessage()
            
    return payment_input
    
    

def AddressInput():
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
        
    return new_address



def ContactNoInput(acc_storage):
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
        elif [un for un in acc_storage if un[3] == new_contact_no]:
            sleep(0.5)
            print("\033[1A\033[K\t    CONTACT NUMBER ALREADY USED")
            sleep(1.25)
        else:
            break
        
    return new_contact_no



def PasswordInput(current_pass):
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
            if new_password == current_pass:
                sleep(0.5)
                print("\033[1A\033[K\t      SIMILAR TO OLD PASSWORD")
                sleep(1.25)
            else:
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
            
    return new_password



def readInventoryReport(inv_storage):
    purchase_list = []
    
    get_file_path = getcwd()
    
    create_file_path = f"{get_file_path}\\Text Files"
    
    read_inv_list = open(f"{create_file_path}\\purchase_history.txt", "r")
    read_history = read_inv_list.readline()

    while read_history != "":
        purchase_details = read_history.split()
        
        purchase_list.append(((purchase_details[0]), int(purchase_details[1]), purchase_details[2], int(purchase_details[3]), float(purchase_details[4]), float(purchase_details[5]), float(purchase_details[6])))
        
        read_history = read_inv_list.readline()
        
    read_inv_list.close()
    
    inv_storage = purchase_list
    
    return inv_storage



def writeInventoryReport(inv_storage):
    get_file_path = getcwd()
    
    create_file_path = f"{get_file_path}\\Text Files"
    
    write_inv_list = open(f"{create_file_path}\\purchase_history.txt", "w")
    
    for purchase_details in inv_storage:
        write_to_file = f"{purchase_details[0]} {purchase_details[1]} {purchase_details[2]} {purchase_details[3]} {purchase_details[4]} {purchase_details[5]} {purchase_details[6]}\n"
        
        write_inv_list.write(write_to_file)
        
    write_inv_list.close()