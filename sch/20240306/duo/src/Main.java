import java.util.Scanner;
class Main {
    public static void main(String[] args) {
        boolean debug = false;
        
        Scanner input = new Scanner(System.in);
        double berat, tinggi, bmi;

        System.out.print("Masukkan Berat Badan (Kg): ");
        berat = input.nextInt();
        System.out.print("Masukkan Tinggi Badan (cm): ");
        tinggi = input.nextInt();

        bmi = berat / Math.pow((tinggi / 100), 2);

        if (debug) {
            System.out.printf("BMI: %f%n",bmi);
        }

        System.out.print("Kondisi Fisik: ");

        if (bmi >= 25 && bmi <= 29.9) {
            System.out.println("Gemuk");
        } else if (bmi >= 18.5 && bmi <= 24.9) {
            System.out.println("Ideal");
        } else if (bmi < 18.5) {
            System.out.println("Kurus");
        } else if (bmi >= 30) {
            System.out.println("Obesitas");
        } else {
            System.out.println("Tidak terdefinisi");
        }

        input.close();
    }
}

// Contributor
// Muhammad Nazwan Ali

// Source: https://www.siloamhospitals.com/informasi-siloam/artikel/cara-menghitung-bmi
// Kurang dari 18,5 berarti berat badan kurang (underweight).
// Antara 18,5 - 24,9 berarti berat badan normal
// Antara 25-29,9 berarti berat badan berlebih (overweight).
// Di atas 30 berarti obesitas