from datetime import datetime

class Waktu:
    def __init__(self,obj:datetime) -> None:
        self.obj       = obj
        self.jam  :int = obj.hour
        self.menit:int = obj.minute
    
    def __str__(self) -> str:
        return str(self.obj)

def main():

    # while True:
    #     try:
    #         uinput:str = input("Masukkan jam (hh:mm): ")

    #         if uinput.strip() == "":
    #             waktu = Waktu(datetime.now())
    #         else:
    #             waktu = Waktu(datetime.strptime(uinput,"%H:%M"))
    #         break
    #     except ValueError:
    #         print("Input tidak valid.")
    
    waktu = Waktu(datetime.strptime("13:10","%H:%M"))
    bagian = waktu
    
    if (waktu.jam >= 5 and waktu.menit >= 0) and (waktu.jam <= 12 and waktu.menit <= 25):
        bagian = "Subuh"
    elif (waktu.jam >= 12 and waktu.menit >= 25) and (waktu.jam <= 15 and waktu.menit <= 35):
        bagian = "Dzuhur"
    elif (waktu.jam >= 15 and waktu.menit >= 35) and (waktu.jam <= 18 and waktu.menit <= 30):
        bagian = "Ashr"
    elif (waktu.jam >= 18 and waktu.menit >= 30):
        bagian = "Maghrib"

    print(bagian)
        
if __name__ == "__main__":
    main()