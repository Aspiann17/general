from util import intput

def main():
    if debug:
        tinggi, berat = 150, 60 # 26.6
    else:
        tinggi = intput("Masukkan tinggi badan (cm): ")
        berat  = intput("Masukkan berat badan (kg): ")

    bmi = berat / ((tinggi / 100) ** 2)

    if debug:
        print(f"Tinggi: {tinggi}\nBerat: {berat}\nBMI : {bmi}")

    print("Fisik: ", end="")

    if bmi < 18.5:
        print("Kurus")
    elif bmi >= 18.5 and bmi <= 24.9:
        print("Ideal")
    elif bmi >= 25 and bmi <= 29.9:
        print("Gemuk")
    elif bmi >= 30:
        print("Obesitas")
    elif bmi < 0:
        print("Alien")
    else:
        print("Tidak manuk")

if __name__ == "__main__":
    debug = False
    main()

# Source: https://www.siloamhospitals.com/informasi-siloam/artikel/cara-menghitung-bmi
# Kurang dari 18,5 berarti berat badan kurang (underweight).
# Antara 18,5 - 24,9 berarti berat badan normal
# Antara 25-29,9 berarti berat badan berlebih (overweight).
# Di atas 30 berarti obesitas