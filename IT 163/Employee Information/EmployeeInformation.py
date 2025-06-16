class Employee:
    def __init__(self, name, office, position, salary):
        self.name = name
        self.office = office
        self.position = position
        self.salary = salary
        
    def display(self):
        print(f"""
Name: {self.name}
Office: {self.office}
Position: {self.position}
Salary: PHP {self.salary: .0f}""")
        
Employee1 = Employee("Michael A. Ochengco", "IT Department", "Junior Web Developer", 25000)
Employee2 = Employee("Kurt I. Alegarbes", "Engineering Department", "Intern", 5000)

Employee1.display()
Employee2.display()