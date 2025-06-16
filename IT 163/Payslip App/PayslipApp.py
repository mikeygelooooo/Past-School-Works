from os import system



def main():
    
    # MAIN SCREEN
    
    print("=" * 30)
    print("\n         PAYSLIP APP\n")
    print("=" * 30)
    print("\n      INFORMATION INPUT\n")
    print("=" * 30)
    
    # INFORMATION INPUT SECTION
    
    name_input = input("\n Enter name: ") # Employee Name
        
    while True: # Hours Rendered
        try:
            hours_input = float(input("\n Enter Hours Rendered: "))
            break
        except:
            ErrorScreen()
    
    while True: # Loan Amount
        try:
            loan_input = float(input("\n Enter Loan: "))
            break
        except:
            ErrorScreen()
        
    while True: # Insurance Amount
        try:
            insurance_input = float(input("\n Enter Insurance: "))
            break
        except:
            ErrorScreen()
            
    # CALCULATION SECTION
    
    gross_salary_input = GrossSalary(hours_input) # Gross Salary
    
    tax_input = gross_salary_input * 0.12 # Tax Amount
    
    salary_deductions_input = SalaryDeductions(tax_input, loan_input, insurance_input) # Salary deduction Amount
    
    net_salary_input = NetSalary(gross_salary_input, salary_deductions_input) # Net Salary
    
    # FINAL OUTPUT SECTION
    
    system("cls")
    
    print("=" * 30)
    print("\n         PAYSLIP APP\n")
    print("=" * 30)
    print("\n   EMPLOYEE PAYSLIP DETAILS\n")
    print("=" * 30)
    
    print(f"\n NAME: {name_input}")
    print(f" HOURS RENDERED: {hours_input: .0f}")
    
    print(f"\n GROSS SALARY: PHP {gross_salary_input: .2f}")
    
    print(f"\n TAX: PHP {tax_input: .2f}")
    print(f" LOAN: PHP {loan_input: .2f}")
    print(f" INSURANCE: PHP {insurance_input: .2f}")
    
    print(f"\n TOTAL DEDUCTIONS: PHP {salary_deductions_input: .2f}")
    
    print(f"\n NET SALARY: PHP {net_salary_input: .2f}\n")
    
    print("=" * 30)



def GrossSalary(hours): # Gross Salary Calculation
    rate = 500
    
    gross_salary = rate * hours
    return gross_salary



def SalaryDeductions(tax, loan, insurance): # Salary Deduction Calculation
    salary_deduction = tax + loan + insurance
    
    return salary_deduction



def NetSalary(gs, deductions): # Net Salary Calculation
    net_salary = gs - deductions
    
    return net_salary



def ErrorScreen():
    print("\n" + "=" * 30)
    print("\n         ERROR INPUT")
    print("\n" + "=" * 30)
            
            
            
main() # Call to Run Program