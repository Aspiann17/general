block:str = "="*60

def intput(text:str="Choose: "):
    while True:
        try:
            return int(input(text))
        except ValueError:
            print("Input tidak valid.")

def strput(text:str,option:list[str]):
    """ Option value is lower """
    while True:
        tmp = input(text)
        if tmp.lower() in option:
            return tmp
        print("Input tidak valid.")

def boolput(text:str,option:list[str]=["yes","y"]):
    tmp = input(text)
    if tmp.strip().lower() in option:
        return True
    return False

def textbox(text:str,end:str="=",pipe:bool=False,lenght=60):
    print(f"{block}\n| {text:^56} |")
    if pipe:
        print("|",end="")
    print(end*lenght,end="")
    if pipe:
        print("|",end="")
    print()

def menu(text:str,item:list):
    textbox(text,"-",pipe=True,lenght=58)

    for i,j in enumerate(item):
        print(f"| {i+1} | {j:<52} |")

    print(block)

if __name__ == "__main__":
    ...