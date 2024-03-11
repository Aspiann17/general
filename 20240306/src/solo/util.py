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

def textbox(text:str,end:bool=True):
    print(block)
    print(f"| {text:^56} |")
    if end:
        print(block)

def menu(text:str,item:list[str]):
    textbox(text,False)
    print(f"|{'-'*58}|")

    for i,j in enumerate(item):
        print(f"| {i+1} | {j:<52} |")    

    print(block)

if __name__ == "__main__":
    ...