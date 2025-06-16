record_list = []



def main():
    print("\nSystem Menu")
    print("[ A ] - Add Record")
    print("[ E ] - Edit Record")
    print("[ V ] - View Record")
    print("[ D ] - Delete Record")
    print("[ X ] - Exit")

    while True:
        choice = input("Choice: ")

        if choice.upper() in "AEVDX" and len(choice) == 1:
            break
        else:
            errorMessage()

    if choice in "aA":
        addRecord()
    elif choice in "eE":
        editRecord()
    elif choice in "vV":
        viewRecord()
    elif choice in "dD":
        deleteRecord()
    elif choice in "xX":
        exitProgram()

    main()



def addRecord():
    print("\nAdding Record")
    name_input = input("Name: ")
    address_input = input("Address: ")

    record = name_input + "-" + address_input
    record_list.append(record)

    print("\nSuccessfully Added")



def editRecord():
    viewRecord()
    
    print("\nEditing Record")

    while True:
        try:
            rec_num = int(input("Enter record number: "))

            if rec_num > len(record_list) or rec_num <= 0:
                errorMessage()
            else:
                break
            
        except:
            errorMessage()

    name_input = input("\nName: ")
    address_input = input("Address: ")

    record = name_input.title() + "-" + address_input.title()
    record_list[rec_num - 1] = record

    print("\nSuccessfully Edited\n")

    viewRecord()



def viewRecord():
    print("\nViewing Record")

    if len(record_list) == 0:
        print("\nWow such empty")
    else:
        count = 1
        
        for rec in record_list:
            print(f"{count}. {rec}")
            count += 1



def deleteRecord():
    viewRecord()
    
    print("\nDeleting Record")

    while True:
        try:
            rec_num = int(input("Enter record number: "))

            if rec_num > len(record_list) or rec_num <= 0:
                errorMessage()
            else:
                break
            
        except:
            errorMessage()

    del record_list[rec_num - 1]

    viewRecord()



def exitProgram():
    while True:
        exit_prompt = input("\nAre you sure? [Y/N]: ")

        if exit_prompt.upper() in "YN" and len(exit_prompt) == 1:
            break
        else:
            errorMessage()

    if exit_prompt in "yY":
        quit()
    elif exit_prompt in "nN":
        pass



def errorMessage():
    print("\nINVALID INPUT\n")

main()