from util import boolput, intput

def main():
    ktp:bool = boolput("Apakah sudah memiliki KTP? (y/n): ",["y","yes"])

    if ktp:
        usia:int = intput("Masukkan usia: ")

    print(f"Kamu {'boleh' if ktp and usia >= 17 else 'belum boleh'} memiliki SIM")

if __name__ == "__main__":
    try:
        main()
    except KeyboardInterrupt:
        print("\nProgram Stoped.")