from os import getcwd
from time import sleep
from string import punctuation
from ScreensStore import errorMessage



def prodName(prod_storage):
    prod_list = prod_storage
    
    while True:
        invalid_name = 0
        
        prod_name_input = input("\033[1A\033[K\tEnter Product Name: ")
        
        if prod_name_input == "-1":
            return None
        
        for i in prod_name_input:
            if i in [punc for punc in punctuation if punc != "-"] or i == " ":
                invalid_name += 1
                
        if invalid_name != 0 or len(prod_name_input) < 3:
            sleep(0.5)
            print("\033[1A\033[K\t\tINVALID PRODUCT NAME")
            sleep(1.25)
        elif [pn for pn in prod_list if pn[0] == prod_name_input]:
            sleep(0.5)
            print("\033[1A\033[K\t       PRODUCT ALREADY EXISTS")
            sleep(1.25)
        else:
            break
    
    return prod_name_input.title()



def prodPrice():
    print()
    
    while True:
        try:
            prod_price_input = float(input("\033[1A\033[K\tEnter Product Price: "))
            
            if prod_price_input == -1:
                return None
            elif prod_price_input < 0:
                errorMessage()
            else:
                break
            
        except:
            errorMessage()
            
    return prod_price_input



def prodStock():
    print()
    
    while True:
        try:
            prod_stock_input = int(input("\033[1A\033[K\tAdd Product Stock: "))
            
            if prod_stock_input == -1:
                return None
            elif prod_stock_input < 0:
                errorMessage()
            else:
                break
            
        except:
            errorMessage()
            
    return prod_stock_input



def amountSold(prod_id, purchase_history):
    amt_sold = 0
    
    for prod in purchase_history:
        if (prod[1] - 1) == prod_id:
            amt_sold += prod[3]
            
    return amt_sold
    
    
    
def readProductStorage(prod_storage):
    prod_list = []
    
    get_file_path = getcwd()
    
    create_file_path = f"{get_file_path}\\Text Files"
    
    read_prod_list = open(f"{create_file_path}\\product_list.txt", "r")
    read_product = read_prod_list.readline()

    while read_product != "":
        product_details = read_product.split()
        
        prod_list.append((product_details[0], float(product_details[1]), int(product_details[2])))
        
        read_product = read_prod_list.readline()
        
    read_prod_list.close()
    
    prod_storage = prod_list
    
    return prod_storage
    
    
    
def writeProductStorage(prod_storage):
    get_file_path = getcwd()
    
    create_file_path = f"{get_file_path}\\Text Files"
    
    write_prod_list = open(f"{create_file_path}\\product_list.txt", "w")
    
    for product_details in prod_storage:
        write_to_file = f"{product_details[0]} {product_details[1]} {product_details[2]}\n"
        
        write_prod_list.write(write_to_file)
        
    write_prod_list.close()