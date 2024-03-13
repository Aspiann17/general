from util import intput

def main():

    jam, menit = (intput(f"Masukkan {text}: ") for text in ("jam", "menit"))

    if (jam >= 5 and jam <= 12):
        waktu = "Subuh"
    elif (jam >= 12 and jam <= 15):
        waktu = "Dzuhur"
    elif (jam >= 15 and jam <= 18):
        waktu = "Ashr"
    elif (jam >= 18 and jam <= 19):
        waktu = "Maghrib"
    elif (jam >= 19 and jam <= 5):
        waktu = "Isya"
    else:
        waktu = "Hadeh"
    
    print(waktu)
        


    # Subuh   -> 05:10
    # Dzuhur  -> 12:30
    # Ashr    -> 15:35
    # Maghrib -> 18:30
    # Isya    -> 19:40

if __name__ == "__main__":
    try:
        main()
    except KeyboardInterrupt:
        print("Program Stopped.")