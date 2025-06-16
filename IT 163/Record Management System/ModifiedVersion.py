from os import system
from time import sleep



class Person:
    def __init__(self, name, age, gender, address):
        self.name = {'Name': name}
        self.age = {'Age': age}
        self.gender = {'Gender': gender}
        self.address = {'Address': address}
        


record_list = []



def main():
    system("cls")
    
    print("=" * 30)
    print("\n   RECORD MANAGEMENT SYSTEM\n")
    print("=" * 30)
    print("\n [ A ] - Add Record")
    print(" [ E ] - Edit Record")
    print(" [ V ] - View Record")
    print(" [ D ] - Delete Record")
    print(" [ X ] - Exit\n")
    print("=" * 30 + "\n\n")

    while True:
        choice = input("\033[1A\033[K Choice: ")

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
    system("cls")
    
    print("=" * 30)
    print("\n       ADDING RECORD/S\n")
    print("=" * 30, "\n\n")
    
    while True:
        try:
            no_of_inputs = int(input("\033[1A\033[K Enter input amount: "))

            if no_of_inputs <= 0:
                errorMessage()
            else:
                break
        except:
            errorMessage()

    for i in range(1, no_of_inputs + 1):
        system("cls")
        
        print("=" * 30)
        print("\n       ADDING RECORD/S\n")
        print("=" * 30)
        print(f"\n         INPUT {i} of {no_of_inputs}\n")
        print("=" * 30, "\n")
        
        name_input = nameInput()
        age_input = ageInput()
        gender_input = genderInput()
        address_input = addressInput()
        
        new_person = Person(name_input, age_input, gender_input, address_input)
        new_record = new_person.name | new_person.age | new_person.gender | new_person.address
        
        record_list.append(new_record)
    
    system("cls")
    
    print("=" * 30)
    print("\n  SUCCESSFULLY ADDED RECORD\n")
    print("=" * 30, "\n\n")
    
    while True:
        view_prompt = input("\033[1A\033[K View the records? [Y/N]: ")
        
        if view_prompt.upper() in "YN" and len(view_prompt) == 1:
            break
        else:
            errorMessage()
            
    if view_prompt in "Yy":
        viewRecord()



def editRecord():
    viewRecord()

    if len(record_list) != 0:
        system("cls")
    
        print("=" * 30)
        print("\n       EDITING A RECORD\n")
        print("=" * 30, "\n\n")
        
        while True:
            try:
                rec_num = int(input("\033[1A\033[K Enter record number: "))

                if rec_num > len(record_list) or rec_num <= 0:
                    errorMessage()
                else:
                    break
                
            except:
                errorMessage()

        print("\n" + "=" * 30, "\n")
        name_input = nameInput()
        age_input = ageInput()
        gender_input = genderInput()
        address_input = addressInput()
        
        new_person = Person(name_input, age_input, gender_input, address_input)
        new_record = new_person.name | new_person.age | new_person.gender | new_person.address
        
        record_list[rec_num - 1] = new_record

        system("cls")
    
        print("=" * 30)
        print("\n SUCCESSFULLY EDITED RECORD\n")
        print("=" * 30, "\n\n")
        
        while True:
            view_prompt = input("\033[1A\033[K View the records? [Y/N]: ")
            
            if view_prompt.upper() in "YN" and len(view_prompt) == 1:
                break
            else:
                errorMessage()
                
        if view_prompt in "Yy":
            viewRecord()
            
            

def viewRecord():
    system("cls")
    
    print("=" * 30)
    print("\n        RECORD DATABSE\n")
    print("=" * 30)

    if len(record_list) == 0:
        print("\n        WOW SUCH EMPTY\n")
        print("=" * 30, "\n")
    else:
        count = 1
        
        for rec in record_list:
            print(f"\n          RECORD # {count}")
            
            for data in rec:
                print(f" {data}: {rec[data]}")
                
            count += 1
            
        print("\n" + "=" * 30, "\n")

    system("pause")

def deleteRecord():
    viewRecord()

    if len(record_list) != 0:
        system("cls")
    
        print("=" * 30)
        print("\n       DELETING A RECORD\n")
        print("=" * 30, "\n\n")
        
        while True:
            try:
                rec_num = int(input("\033[1A\033[K Enter record number: "))

                if rec_num > len(record_list) or rec_num <= 0:
                    errorMessage()
                else:
                    break
                
            except:
                errorMessage()

        del record_list[rec_num - 1]

        system("cls")
    
        print("=" * 30)
        print("\n SUCCESSFULLY DELETED RECORD\n")
        print("=" * 30, "\n\n")
        
        while True:
            view_prompt = input("\033[1A\033[K View the records? [Y/N]: ")
            
            if view_prompt.upper() in "YN" and len(view_prompt) == 1:
                break
            else:
                errorMessage()
                
        if view_prompt in "Yy":
            viewRecord()



def nameInput():
    name_input = input(" Enter name: ")

    return name_input.capitalize()



def ageInput():
    print()
    
    while True:
        try:
            age_input = int(input("\033[1A\033[K Enter age: "))

            if age_input < 0:
                errorMessage()
            else:
                break
        except:
            errorMessage()
            
    return age_input



def genderInput():
    choices = ['m', 'male', 'f', 'female']
    male_choice = ['m', 'male']
    
    print()
    
    while True:
        gender_input = input("\033[1A\033[K Enter gender: ")

        if gender_input.lower() in choices:
            break
        else:
            errorMessage()

    if gender_input.lower() in male_choice:
        student_gender_input = 'Male'
    else:
        student_gender_input = 'Female'

    return student_gender_input



def addressInput():
    address_input = input(" Enter address: ")

    return address_input.capitalize()



def exitProgram():
    system("cls")
    
    print("=" * 30)
    print("\n       EXITING PROGAM\n")
    print("=" * 30, "\n\n")
    
    while True:
        exit_prompt = input("\033[1A\033[K Are you sure? [Y/N]: ")

        if exit_prompt.upper() in "YN" and len(exit_prompt) == 1:
            break
        else:
            errorMessage()

    if exit_prompt in "yY":
        print("\n" + "=" * 30, "\n")
        quit("      THANK YOU FOR USING\n THE RECORD MANAGEMENT SYSTEM\n")
    elif exit_prompt in "nN":
        pass



def errorMessage():
    sleep(0.5)
    print("\033[1A\033[K        INVALID INPUT")
    sleep(1.25)


 
main()