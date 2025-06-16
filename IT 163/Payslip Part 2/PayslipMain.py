from GrossSalary import grossSalary
from SalaryDeductions import salaryDeductions
from NetSalary import netSalary



def main():
    print("PAYSLIP APP")
    
    # INFORMATION INPUT SECTION
    
    name_input = input("Enter name: ") # Employee Name
        
    while True: # Hours Rendered
        try:
            hours_input = float(input("Enter Hours Rendered: "))
            break
        except:
            ErrorScreen()
    
    while True: # Loan Amount
        try:
            loan_input = float(input("Enter Loan: "))
            break
        except:
            ErrorScreen()
        
    while True: # Insurance Amount
        try:
            insurance_input = float(input("Enter Insurance: "))
            break
        except:
            ErrorScreen()
            
    # CALCULATION SECTION
    
    gross_salary_input = grossSalary(hours_input) # Gross Salary
    
    tax_input = gross_salary_input * 0.12 # Tax Amount
    
    salary_deductions_input = salaryDeductions(tax_input, loan_input, insurance_input) # Salary deduction Amount
    
    net_salary_input = netSalary(gross_salary_input, salary_deductions_input) # Net Salary
    
    # FINAL OUTPUT SECTION
    
    print("\nEMPLOYEE PAYSLIP DETAILS")
    
    print(f"NAME: {name_input}")
    print(f"HOURS RENDERED: {hours_input: .0f}")
    
    print(f"\nGROSS SALARY: PHP {gross_salary_input: .2f}")
    
    print(f"\nTAX: PHP {tax_input: .2f}")
    print(f"LOAN: PHP {loan_input: .2f}")
    print(f"INSURANCE: PHP {insurance_input: .2f}")
    
    print(f"\nTOTAL DEDUCTIONS: PHP {salary_deductions_input: .2f}")
    
    print(f"\nNET SALARY: PHP {net_salary_input: .2f}")
           
            
            
def ErrorScreen():
    print("\nERROR INPUT\n")
    
main()