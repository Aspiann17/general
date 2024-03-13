from util import intput

def main():
    if debug:
        tinggi, berat = 200,50 # 12.5
    else:
        tinggi = intput("Masukkan tinggi badan (cm): ")
        berat  = intput("Masukkan berat badan (kg): ")

    print("Kondisi fisik: ", end="")

    bmi = berat / ((tinggi / 100) ** 2)

    if bmi > 0 and bmi < 18.5:
        print("Kurus")
    elif bmi >= 18.5 and bmi <= 24.9:
        print("Ideal")
    elif bmi > 25:
        print("Gemuk")
    else:
        print("Tidak normal")

    if debug:
        print(f"BMI: {bmi}")

if __name__ == "__main__":
    debug = False

    # Belum di uji
    main()



# https://www.rsmurniteguh.com/id/tools/kalkulator_bmi