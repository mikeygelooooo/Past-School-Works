from random import randint
from time import sleep
from os import system

# This is a Non-Preemtive Priotity Scheduling Program
class NonPreemptivePriorityScheduling:

    processList = []
    process_Timing = {}
    # Function to get the user input for processes
    def User_Input(self, Num_Process):
        for IDprocess in range(1, Num_Process + 1):
            tempList = []
            
            # Prompt for arrival time, burst time, and priority level
            arrivalTime = int(input(f"\nP{IDprocess} Arrival Time: "))
            burstTime = int(input(f"P{IDprocess} Burst Time: "))
            Priority = int(input(f"P{IDprocess} Priotiy lvl: "))
            
            tempList = [f"P{IDprocess}", arrivalTime, burstTime, Priority]
            
            self.processList.append(tempList)
    # Function that generates random input for processes
    def Random_Input(self, Num_Process, Max_Burst):
        half = Num_Process // 2
        randomizer_limit = Num_Process + half
        
        for IDprocess in range(1, Num_Process + 1):
            tempList = []

            while True:
                arrivalTime = randint(0, randomizer_limit)
                if [_process for _process in self.processList if _process[1] == arrivalTime]:
                    pass
                else:   
                    break

            burstTime = randint(1, Max_Burst)
            Priority = randint(1, Num_Process)
            
            tempList = [f"P{IDprocess}", arrivalTime, burstTime, Priority]

            self.processList.append(tempList)
        
        return self.processList

    # Execution of the Algorithm
    def Execute(self, processList):
        currentTime = 0
        ProcessComplete = []
        MemoryQueue = []
        
        print("\n\n--------Gantt Chart Simulation--------") # Simulation or displaying of process of the algorithm
        while len(ProcessComplete) < len(self.processList):
            for process in self.processList:
                if process[1] <= currentTime and process not in ProcessComplete and process not in MemoryQueue:
                    MemoryQueue.append(process)

            # Executed if there is no Process in the moment
            if not MemoryQueue:
                sleep(1)
                currentTime += 1
                continue

            MemoryQueue.sort(key=lambda x: (x[3], x[1]))  # Sort by priority and arrival time
            
            current_process = MemoryQueue.pop(0) # pops the first elemnt stored in the memory queue
            ProcessComplete.append(current_process)
            self.process_Timing[current_process[0]] = (currentTime, currentTime+current_process[2])
            print(f"{current_process[0]} : {currentTime} - {currentTime+current_process[2]}")
            currentTime += current_process[2]

        totalWT = 0
        totalTT = 0

        for process in self.processList:
            turnarroundTime = currentTime - process[1]
            waitingTime = turnarroundTime - process[2]

            totalWT += waitingTime
            totalTT += turnarroundTime

        WT = totalWT / len(self.processList) # Waiting time
        TT = totalTT / len(self.processList) # Turnaround TIme


# Main Function of the program
def mainFunction():
    The_User = NonPreemptivePriorityScheduling()

    Number_of_process = int(input("Number of process: "))
    print("\n\t[ 1 ] User Input ->")
    print("\t[ 2 ] random INput->")
    UR = int(input("\nUser or Random Input? >>  "))

    if UR == 1:
        The_User.User_Input(Number_of_process)
    elif UR == 2:
        The_User.Random_Input(Number_of_process, 10)
        
    The_User.Execute(The_User.processList)