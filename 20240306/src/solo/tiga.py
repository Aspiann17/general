from util import boolput, intput

def main():
    ktp  = boolput("Apakah sudah memiliki KTP? (y/n): ",["y","yes"])

    if ktp:
        usia = intput("Masukkan usia: ")

    print(f"Kamu {'boleh' if ktp and usia >= 17 else 'belum boleh'} memiliki SIM")

if __name__ == "__main__":
    main()