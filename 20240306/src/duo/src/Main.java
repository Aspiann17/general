import java.util.Scanner;
class Main {
    public static void main(String[] args) {
        boolean debug = true;
        
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

        input.close();
    }
}

// Contributor
// Muhammad Nazwan Ali